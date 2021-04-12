<?php

namespace App\Controller;

use ErrorException;
use App\Entity\Client;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Commande;
use App\Entity\Personne;
use App\Utule\Modalites;
use App\Entity\Echeancier;
use App\Utule\FormatedDate;
use App\Utule\NumberToWords;
use App\Utule\ModaliteString;
use Doctrine\DBAL\DBALException;
use PhpParser\Node\Stmt\TryCatch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/api")
 */
class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    public function index()
    {
        return $this->render('contrat/index.html.twig', [
            'controller_name' => 'ContratController',
        ]);
    }


    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=403,
     * message=" Access refuser ")
     * @Route("/addcontrat", name="contrat.add", methods={"Post"})
     */
    public function addContrat(Request $request, EntityManagerInterface $em,Modalites $modals,
    FormatedDate $formDate,ModaliteString $modS,NumberToWords $toWords,ValidatorInterface $validator, SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser(); $jsonOutput='application/json' ;
        // dd($userOnline);ok
        $jsonRecu = $request->getContent();
        $donneeRecu = json_decode($jsonRecu); 
        $day = new \DateTime(); $jour =$day->format('d/m/Y'); $articles=[];$contrat = new Contrat();
        $devise = "FCFA"; $br="\n"; $montAVerser=0; $mesArticles=" ";$prodsPreambule="";
                   // print_r($toWords->inWords($number));die();ok
        try{
            if(isset($donneeRecu->client)){
                $dataC=$donneeRecu->client;  
            }else{
                throw new Exception("Veuillez saisir les informations du client", 1);         
            }
            // // Set Datas Client        
            $client = new Client();       
            $client->setNumClient($dataC->numero)
                    ->setPrenom($dataC->prenom)
                    ->setNom($dataC->nom)
                    ->setDateNaiss($formDate->formaterDate($dataC->dateNaiss))
                    ->setLieuNaiss($dataC->lieuNaiss)
                    ->setCni($dataC->cni)
                    ->setDateDCni($formDate->formaterDate($dataC->dateDCni))
                    ->setDateECni($formDate->formaterDate($dataC->dateECni))
                    ->setDomicile($dataC->domicile)
                    ->setTelephone($dataC->telephone);
            $em->persist($client);
            $errorsC=$validator->validate($client)  ;
            if(count($errorsC)>0){
                return new Response($errorsC, 500,['content-Type'=> $jsonOutput]);
            }
        }catch(NotEncodableValueException $nEVE){
            return $this->json([
                'status'=> 401,
                'message'=> $nEVE->getMessage()
            ], 400);
        }
            // dd($client);ok
            // Get Datas Subroge
            if(isset($donneeRecu->subroge)){
                $dataS=$donneeRecu->subroge;
                 // dd($dataS);ok
                $prenomS= $dataS->prenom; $nomS = $dataS->nom;
                $lieuNaissS = $dataS->lieuNaiss; $telephoneS = $dataS->telephone;
                $cniS = $dataS->cni; $domicileS = $dataS->domicile;
                $dateNaissS = $dataS->dateNaiss;
                $dateDCniS = $dataS->dateDCni;
                $dateECniS = $dataS->dateECni;
            }else{
                throw new Exception("Veuillez saisir les information du subroge", 500);      
            }

            // Get datas Produits and facture            
            $facture = new Facture(); $ref=rand(10,9999999)."$dataC->numero";            
            // Get datas commande
            if(isset($donneeRecu->articles)){
                     // Get datas article
                $articles= $donneeRecu->articles; 
                    // Get datas facture
                if(isset($donneeRecu->facture)){
                    // Get datas facture
                    $datasFacture=$donneeRecu->facture; $adresse = $datasFacture->adresse; 
                    $datasFacture->libele ;  $acompte = $datasFacture->acompte;        
                    $nbrEcheanciers= $datasFacture->nbrEcheanciers;
                }else{
                    throw new Exception("Veuillez saisir les informations de la facture", 500);      
                }
                // dd($datasFacture);

                // Get and Set datas Commande[{}]
                for($i=0;$i<count($articles);$i++){
                    $commande=new Commande();
                    $commande->setDesignation($articles[$i]->article)
                            ->setPrixUnitaire($articles[$i]->prixU)
                            ->setNombre($articles[$i]->nbr)
                            ->setPrixTotal($articles[$i]->prixU*$articles[$i]->nbr)
                            ->setFacture($facture)
                            ->setContrat($contrat);;
                    $em->persist($commande); 

                    $errorsCom=$validator->validate($commande)  ;
                    if(count($errorsCom)>0){
                        return new Response($errorsCom, 500,['content-Type'=> $jsonOutput]);
                    }
                    //nom et nombre
                    $mesArticles.=$toWords->inWords($articles[$i]->nbr)." ".$articles[$i]->article." ,"; 
                    // articles texte avec retour a la ligne
                    $prodsPreambule.=$articles[$i]->article." \n";        
                     // prix total des articles           
                    $montAVerser+=$articles[$i]->prixU*$articles[$i]->nbr;         
                    $restAPayer=$montAVerser-$acompte;
                } 
                // Set datas facture
                $facture->setNumFacture($dataC->numero)
                        ->setReference($ref)
                        ->setAdresse($adresse)
                        ->setNomClient($dataC->prenom." ".$dataC->nom)
                        ->setNomSubroge($dataS->prenom." ".$dataS->nom)
                        ->setTelCient($dataC->telephone)
                        ->setTelSubroge($dataS->telephone)
                        ->setMontAVerser($montAVerser)
                        ->setAcompte($acompte)
                        ->setMontVerse($acompte)
                        ->setResteAPayer($restAPayer);
                $em->persist($facture);  
                 $errorsF=$validator->validate($facture)  ;
                    if(count($errorsF)>0){
                        return new Response($errorsF, 500,['content-Type'=> $jsonOutput]);
                    }
            //    dd($facture);ok
            }else{
                throw new Exception("Veuillez saisir les produits commandés", 500);      
            }
                               
            // Set datas Echeancier (Modalite de paiement) In Entity Echeancier
            $entityEcheancier= new Echeancier();
            // get data object echeanciers
            $dataSc=$donneeRecu->echeanciers;            
            // dd($echeanchiersRecu);ok
            $sc=$modals->modalite($dataSc);
            // dd($sc['premierE']." ".$sc['premierMont']);ok
            $entityEcheancier->setNbrEcheanciers($nbrEcheanciers)
                ->setPremierE($sc['premierE'])  ->setPremierMont($sc['premierMont'])
                ->setDeuxiemeE($sc['deuxiemeE']) ->setDeuxiemeMont($sc['deuxiemeMont'])
                ->setTroisiemeE($sc['troisiemeE']) ->setTroisiemeMont($sc['troisiemeMont'])
                ->setQuatriemeE($sc['quatriemeE'])->setQuatriemeMont($sc['quatriemeMont'])
                ->setCinquiemeE($sc['cinquiemeE'])->setCinquiemeMont($sc['cinquiemeMont'])
                ->setSixiemeE($sc['sixiemeE']) ->setSixiemeMont($sc['sixiemeMont'])
                ->setSeptiemeE($sc['septiemeE']) ->setSeptiemeMont($sc['septiemeMont'])
                ->setHuitiemeE($sc['huitiemeE']) ->setHuitiemeMont($sc['huitiemeMont'])
                ->setNeuviemeE($sc['neuviemeE']) ->setNeuviemeMont($sc['neuviemeMont'])
                ->setDixiemeE($sc['dixiemeE']) ->setDixiemeMont($sc['dixiemeMont'])
                ->setOnziemeE($sc['onziemeE'])->setOnziemeMont($sc['onziemeMont'])
                ->setDouziemeE($sc['douziemeE'])->setDouziemeMont($sc['douziemeMont']); 
                // dd($entityEcheancier);                       
            
            $em->persist($entityEcheancier);
            $errorsE=$validator->validate($entityEcheancier)  ;
            if(count($errorsE)>0){
                return new Response($errorsE, 500,['content-Type'=> $jsonOutput]);
            }
        // recuperation des donnees du contrat proformat
            $contratRepo=$this->getDoctrine()->getRepository(Contrat::class);
            $entityContrat = $contratRepo->findOneBy(array("reference"=>"bokokomarket"));
        // Ajout new contrat        
            $contrat->setClient($client)
                    ->setEcheancier($entityEcheancier)
                    ->setCreatedAt($day)
                    ->setUserCreateur($userOnline)
                    ->setReference($ref)
                    ->setNumContrat($dataC->numero);
        // Affectation
            $contrat->addFacture($facture);
            $facture->setContrat($contrat);
        // End affectation 
        // Infos client         
            $contrat->setLibele('CONTRAT DE VENTE DE BIEN '.$datasFacture->libele)
                    ->setIntitule($entityContrat->getIntitule().
                    "\nMonsieur(Madame) $dataC->prenom $dataC->nom né(e) le $dataC->dateNaiss à $dataC->lieuNaiss titulaire de la CNI(du Passeport) N° $dataC->cni, delivrée le $dataC->dateDCni valable jusqu'au $dataC->dateECni, et demeurant à $dataC->domicile; ci-après désigné(e) « Client/Acheteur » \nD’autres part" )
                    ->setArrete($entityContrat->getArrete());
            $contrat->setPreambule($entityContrat->getPreambule().
            "\n".$prodsPreambule);
        // Objet du contrat                
            $contrat->setArticle1($entityContrat->getArticle1().$mesArticles." moyennant paiement de la somme totale de ".$toWords->inWords($montAVerser)." ($montAVerser) F CFA");        
        // Mise a disposition            
            $contrat->setArticle2($entityContrat->getArticle2());
            // dd($contrat);
        // Modalites de paiement            
            $scContrat=$modS->modStringSix($dataSc);/*convertion date to string */
            $contrat->setArticle3("Le client versera un acompte de ".$toWords->inWords($acompte)." ($acompte) FCFA à la date de livraison Le montant restant, à savoir les ".$toWords->inWords($restAPayer).
            "($restAPayer) F CFA sera versé en $nbrEcheanciers échéanciers\n".
                $scContrat['premierE'].$scContrat['deuxiemeE'].$scContrat['troisiemeE'].
                $scContrat['quatriemeE'].$scContrat['cinquiemeE'].$scContrat['sixiemeE'].
                $scContrat['septiemeE'].$scContrat['huitiemeE'].$scContrat['neuviemeE'].
                $scContrat['dixiemeE'].$scContrat['onziemeE'].$scContrat['douziemeE'].

            "\nLe premier paiement prendra effet le $dataSc->premierE Le vendeur déclare accepter les moyens de paiement suivant :\nVirement bancaire\nDépôt direct en espèces\nPaiement électronique transfert d’argent (Wari, Orange money,Wave ,Wafacash, Cofina, Moneygram), les frais de transferts sont à la charge du client.<br>Paiement à l’agence"
            );
        // End Modalites de paiement  
            $contrat->setArticle4($entityContrat->getArticle4());
            $contrat->setArticle5($entityContrat->getArticle5());
        // Infos du garant
            $contrat->setArticle6($entityContrat->getArticle6().
            "\nEn cas de non-paiement Monsieur (Madame) $dataS->prenom $dataS->nom né(e) le $dataS->dateNaiss à $dataS->lieuNaiss, titulaire de la CNI (du Passeport) N0 $dataS->cni, en date du $dataS->dateDCni et valable jusqu’au $dataS->dateECni et demeurant à $dataS->domicile s’engage à se substituer au client pour payer ladite somme au principal et tous les frais et pénalités qui y sont greffés")
        //Obligation
                ->setArticle7($entityContrat->getArticle7())
                ->setArticle8($entityContrat->getArticle8())
                ->setArticle9($entityContrat->getArticle9())
                ->setArticle10($entityContrat->getArticle10().
                "\nFait à Dakar le $jour, en deux exemplaires, chaque partie reconnaissant avoir reçu le tien.
                \n Signature précédée de la mention « lu et approuvé »");
                //    dd($contrat);ok
        $em->persist($contrat);
        $errorsC=$validator->validate($contrat)  ;
        if(count($errorsC)>0){ return new Response($errorsC, 500,['content-Type'=> $jsonOutput]);}
        $em->flush();       
       
        // $dataCon=$normI->normalize($contrat,null,['groups'=>'get:contrat']);
        // $dataContrat=json_encode($dataCon); OR
        $dataContrat=$serializerInt->serialize($contrat,'json',['groups'=>'get:contrat']);

        // dd($dataContrat);
        //$tab1= $serializerInt->serialize($client,'json');
      //  $tab2= $serializerInt->serialize($facture,'json');
       //      $dataContrat = ($tab.$tab1.$tab2) ;
            // dd($dataContrat);
        return new Response($dataContrat, 201,['content-Type'=> $jsonOutput]);
    }
}
