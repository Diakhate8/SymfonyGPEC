<?php

namespace App\Controller;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Commande;
use App\Utule\Modalites;
use App\Entity\Echeancier;
use App\Utule\FormatedDate;
use App\Utule\NumberToWords;
use App\Utule\ModaliteString;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/api")
 */
class OtherContratController extends AbstractController
{
    /**
     * @Route("/other/contrat", name="other_contrat")
     */
    public function index()
    {
        return $this->render('other_contrat/index.html.twig', [
            'controller_name' => 'OtherContratController',
        ]);
    }

    /**
     * @Route("/contrat/other", name="othercontrat.add", methods={"Post"})
     */
    public function addOtherContrat(Request $request,ClientRepository $clientRipo, EntityManagerInterface $em,Modalites $modals,
    FormatedDate $formDate,NumberToWords $toWords,ModaliteString $modS, ValidatorInterface $validator ,SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser();
        // dd($userOnline);ok
        $jsonRecu = $request->getContent();  $donneeRecu = json_decode($jsonRecu);
        $day = new \DateTime(); $jour =$day->format('d/m/Y');//dateTimeToString
        $br="\n"; $montAVerser=0; $mesArticles=" "; $prodsPreambule="\n";

        // Get Datas Client If Existe
        if(!empty($donneeRecu->client)){
            $dataC=$donneeRecu->client;  
            $numeroC = $dataC->numero;
            $entityClient = $clientRipo->findOneBy(array('numClient' => $numeroC));
            if(!$entityClient){throw new Exception("Vous n'avez pas encore de contrat ");}
        }else{
            throw new Exception("veuillez saisir les informations du client ");         
        }
       
        if($entityClient){            
            $facture = new Facture(); $ref=rand(10,9999999)."$numeroC";$contrat = new Contrat();
                       
             // Enregistrement des produits
            if(isset($donneeRecu->articles)){
                // Recuperation des articles
                 $articles = $donneeRecu->articles; 
                // Enregistrement  facture
                 if(isset($donneeRecu->facture)){
                     // Get datas facture
                    $datasFacture=$donneeRecu->facture;  $adresse = $datasFacture->adresse;  
                    $libele = $datasFacture->libele;  $acompte = $datasFacture->acompte;        
                    $nbrEcheanciers = $datasFacture->nbrEcheanciers;
                    $numberContrat=$entityClient->getNumClient();
                    //recuperation id contrat
                    $contratRepo=$this->getDoctrine()->getRepository(Contrat::class);
                    $oldContrat = $contratRepo->findOneBy(array("numContrat"=>"$numberContrat"));
                    $idContrat=$oldContrat->getId();
                    //rechercher ancien facture
                    $factureRepo=$this->getDoctrine()->getRepository(Facture::class);
                    $oldFacture = $factureRepo->findOneBy(array('contrat' => $idContrat));
                // dd($oldFacture);
                    $nomSubroge = $oldFacture->getNomSubroge();$telSubroge = $oldFacture->getTelSubroge();
                 }else{
                     throw new Exception("Veuillez saisir les informations de la facture", 500);      
                 } 
                 
                 // Get and Set datas Commande[{}]
                for($i=0;$i<count($articles);$i++){
                     $commande=new Commande();
                     $commande->setDesignation($articles[$i]->article)
                             ->setPrixUnitaire($articles[$i]->prixU)
                             ->setNombre($articles[$i]->nbr)
                             ->setPrixTotal($articles[$i]->prixU*$articles[$i]->nbr)
                             ->setFacture($facture)
                             ->setContrat($contrat);
                     $em->persist($commande); 
                     //nom et nombre
                     $mesArticles.=$toWords->inWords($articles[$i]->nbr)." ".$articles[$i]->article." ,"; 
                     // articles texte avec retour a la ligne
                     $prodsPreambule.=$articles[$i]->article." \n";        
                      // prix total des articles           
                     $montAVerser+=$articles[$i]->prixU*$articles[$i]->nbr;         
                     $restAPayer=$montAVerser-$acompte;
                } 
                    // Set datas facture
                    $facture->setNumFacture($numeroC)
                    ->setReference($ref)
                    ->setNomClient($entityClient->getNom().' '.$entityClient->getPrenom())
                    ->setTelCient($entityClient->getTelephone())
                    ->setNomSubroge($nomSubroge)
                    ->setTelSubroge($telSubroge)
                    ->setMontAVerser($montAVerser)
                    ->setAcompte($acompte)
                    ->setMontVerse($acompte)
                    ->setResteAPayer($restAPayer)
                    ->setAdresse($adresse);
                    $em->persist($facture);  
                    // dd($facture);
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
            
            $em->persist($entityEcheancier);
                                //    dd($entityEcheancier);                       

            //Enregistrement du contrat                
            // recuperation des donnees du contrat proformat
            $entityContrat = $contratRepo->findOneBy(array("reference"=>"bokokomarket"));
            // Old contrat
            $numberContrat=$entityClient->getNumClient();
            $oldContrat = $contratRepo->findOneBy(array("numContrat"=>"$numberContrat"));
            // dd($oldContrat);

            // Ajout new contrat        
            $contrat->setClient($entityClient)
                    ->setEcheancier($entityEcheancier)
                    ->setCreatedAt($day)
                    ->setUserCreateur($userOnline)
                    ->setReference($ref)
                    ->setNumContrat($numeroC);
            // Affectation
            $contrat->addFacture($facture);
            $facture->setContrat($contrat);
            // End affectation 
            // Infos client         
            $contrat->setLibele('CONTRAT DE VENTE DE BIEN '.$libele)
                    ->setIntitule($oldContrat->getIntitule() )
                    ->setArrete($entityContrat->getArrete());
            $contrat->setPreambule($entityContrat->getPreambule()."\n".$prodsPreambule);
            // Objet du contrat                
            $contrat->setArticle1($entityContrat->getArticle1().$mesArticles."moyennant paiement de la somme totale de ".$toWords->inWords($montAVerser)." ($montAVerser) F CFA");        
            // Mise a disposition            
            $contrat->setArticle2($entityContrat->getArticle2());
            // dd($contrat);
            // Modalites de paiement            
            $scContrat=$modS->modStringSix($dataSc);/*convertion date to string */
            $contrat->setArticle3($entityContrat->getArticle3()."\nLe client versera un acompte de ".$toWords->inWords($acompte)."($acompte) FCFA à la date de livraison .
            Le montant restant, à savoir les ".$toWords->inWords($restAPayer)." ($restAPayer) F CFA sera versé en $nbrEcheanciers échéanciers\n".
                     $scContrat['premierE'].
                     $scContrat['deuxiemeE'].
                     $scContrat['troisiemeE']. 
                     $scContrat['quatriemeE']. 
                     $scContrat['cinquiemeE']. 
                     $scContrat['sixiemeE'] .
                     $scContrat['septiemeE'].
                     $scContrat['huitiemeE']. 
                     $scContrat['neuviemeE']. 
                     $scContrat['dixiemeE']. 
                     $scContrat['onziemeE'].
                     $scContrat['douziemeE'].

                "\nLe premier paiement prendra effet le $dataSc->premierE Le vendeur déclare accepter les moyens de paiement suivant :\nVirement bancaire\nDépôt direct en espèces\nPaiement électronique transfert d’argent (Wari, Orange money,Wave ,Wafacash, Cofina, Moneygram), les frais de transferts sont à la charge du client.\nPaiement à l’agence"
            );
            // End Modalites de paiement  
            $contrat->setArticle4($entityContrat->getArticle4());
            $contrat->setArticle5($entityContrat->getArticle5());
            // Infos du garant
            $contrat->setArticle6($oldContrat->getArticle6())
            //Obligation
                    ->setArticle7($entityContrat->getArticle7())
                    ->setArticle8($entityContrat->getArticle8())
                    ->setArticle9($entityContrat->getArticle9())
                    ->setArticle10($entityContrat->getArticle10().
                    "Fait à Dakar le $jour, en deux exemplaires, chaque partie reconnaissant avoir reçu le tien
                    Signature précédée de la mention « lu et approuvé »");

                //    dd($contrat);
            $em->persist($contrat); $em->flush();

          
        $dataContrat=$serializerInt->serialize($contrat,'json',['groups'=>'get:contrat']);

        return new Response($dataContrat, 201,['content-Type'=> 'application/json' ]);   
           
        }else{
            throw new Exception("Pas de client trouver");
        }   





       
    }
            
      
    



    






}
