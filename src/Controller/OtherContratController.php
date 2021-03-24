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
    public function addOtherContrat( Request $request,ClientRepository $clientRipo, EntityManagerInterface $em,Modalites $modals,
    FormatedDate $formDate,NumberToWords $toWords,ModaliteString $modS, ValidatorInterface $validator ,SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser();
        // dd($userOnline);ok
        $jsonRecu = $request->getContent();  $donneeRecu = json_decode($jsonRecu);
        $day = new \DateTime(); $jour =$day->format('d/m/Y');//dateTimeToString
        $br="\n"; $montAVerser=0; $mesArticles=" "; $prodsPreambule="\n";
        // dd($donneeRecu);

        // Get Datas Client If Existe
        if(isset($donneeRecu->client)){
            $dataC=$donneeRecu->client;  
            if(isset($dataC->numero)){
                $numeroC = $dataC->numero;
                $entityClient = $clientRipo->findOneBy(array('numClient' => $numeroC));
            }elseif(isset($dataC->cni)){
                $cniC = $dataC->cni;
                $entityClient = $clientRipo->findOneBy(array('cni' => $cniC));
            }else{
                throw new Exception("Vous n'avez pas encore de contrat ");
            }
        }else{
            throw new Exception("veuillez saisir les informations du client à rechercher", 500);         
        }
       
        if($entityClient){            
            $facture = new Facture(); $ref=rand(10,9999999)."$numeroC";
                       
             // Enregistrement des produits
            if(isset($donneeRecu->articles)){
                // Recuperation des articles
                 $articles = $donneeRecu->articles; 
                // Enregistrement  facture
                 if(isset($donneeRecu->facture)){
                     // Get datas facture
                     $datasFacture=$donneeRecu->facture;
                     $libele = $datasFacture->libele;  $acompte = $datasFacture->acompte;        
                     $nbrEcheanciers= $datasFacture->nbrEcheanciers;
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
                             ->setFacture($facture);
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
                        ->setMontAVerser($montAVerser)
                        ->setAcompte($acompte)
                        ->setMontVerse($acompte)
                        ->setResteAPayer($restAPayer);
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
                // dd($entityEcheancier);                       
            
            $em->persist($entityEcheancier);
                   
            //Enregistrement du contrat                
            $contrat = new Contrat();
            // recuperation des donnees du contrat proformat
            $contratRepo=$this->getDoctrine()->getRepository(Contrat::class);
            $entityContrat = $contratRepo->findOneBy(array("reference"=>"bokokomarket"));
            // Old contrat
            $numberContrat=$entityClient->getNumClient();
            $contratRepo=$this->getDoctrine()->getRepository(Contrat::class);
            $oldContrat = $contratRepo->findOneBy(array("numContrat"=>"$numberContrat"));
            // dd($oldContrat);
            // Ajout new contrat        
            $contrat = new Contrat();
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
            $contrat->setPreambule($entityContrat->getPreambule()."<br/>".$prodsPreambule);
            // Objet du contrat                
            $contrat->setArticle1($entityContrat->getArticle1().$mesArticles.
                "moyennant paiement de la somme totale de ".$toWords->inWords($montAVerser)." ($montAVerser) F CFA");        
            // Mise a disposition            
            $contrat->setArticle2($entityContrat->getArticle2());
            // dd($contrat);
            // Modalites de paiement            
            $scContrat=$modS->modStringSix($dataSc);/*convertion date to string */
            $contrat->setArticle3($entityContrat->getArticle3()."
                <br/>Le client versera un acompte de ".$toWords->inWords($acompte).
                "($acompte) FCFA à la date de livraison Le montant restant, à savoir les ".$toWords->inWords($restAPayer).
                "($restAPayer) F CFA sera versé en $nbrEcheanciers échéanciers<br/>".
                    "<br>". $scContrat['premierE'].
                    "<br>". $scContrat['deuxiemeE'].
                    "<br>". $scContrat['troisiemeE']. 
                    "<br>". $scContrat['quatriemeE']. 
                    "<br>". $scContrat['cinquiemeE']. 
                    "<br>". $scContrat['sixiemeE'] .
                    "<br>". $scContrat['septiemeE'].
                    "<br>". $scContrat['huitiemeE']. 
                    "<br>". $scContrat['neuviemeE']. 
                    "<br>". $scContrat['dixiemeE']. 
                    "<br>". $scContrat['onziemeE'].
                    "<br>". $scContrat['douziemeE'].

                "<br/>Le premier paiement prendra effet le $dataSc->premierE Le vendeur déclare accepter les moyens de paiement suivant :\nVirement bancaire\nDépôt direct en espèces\nPaiement électronique transfert d’argent (Wari, Orange money,Wave ,Wafacash, Cofina, Moneygram), les frais de transferts sont à la charge du client.\nPaiement à l’agence"
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
            "<br/>Fait à Dakar le $jour, en deux exemplaires, chaque partie reconnaissant avoir reçu le tien.
            <br /> Signature précédée de la mention « lu et approuvé »");

                //    dd($contrat);
            $em->persist($contrat); $em->flush();

            $dataContrat=$serializerInt->serialize($contrat,'json');
            return new Response($dataContrat, 201,['content-Type'=> 'application/json']);
           
           
        }else{
            throw new Exception("Pas de client trouver");
        }   





       
    }
            
      
    






}
