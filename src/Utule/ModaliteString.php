<?php
namespace App\Utule;

use Symfony\Component\Config\Definition\Exception\Exception;


/*
*Convertion Json date and mont to String for  Contrat
*/
class ModaliteString{
    private $formatNull="";
    private $toWords;
    private $devise ="FCFA\n";

    public function __construct(NumberToWords $toWords){
        $this->toWords = $toWords;
    }
           
    // Get datas Echeancier (Modalite de paiement) toString  form Contrat
    public function modStringSix($dataSc){   
        if(empty($dataSc->premierE)||empty($dataSc->premierMont)){
            throw new Exception("veuillez saisir le premier echeancier ");  
        }else{
            $premierE = "01e Echéancier :".$dataSc->premierE." ".$dataSc->premierMont.
            " ".$this->toWords ->inWords($dataSc->premierMont) .$this->devise ;
        }

        if(empty($dataSc->deuxiemeE)||empty($dataSc->deuxiemeMont)){
            $deuxiemeE = $this->formatNull; 
        }else{
            $deuxiemeE = "02e Echéancier :".$dataSc->deuxiemeE." ".$dataSc->deuxiemeMont.
            " ".$this->toWords->inWords($dataSc->deuxiemeMont) .$this->devise ;
        }

        if(empty($dataSc->troisiemeE)||empty($dataSc->troisiemeMont) ){
            $troisiemeE = $this->formatNull; 
        }else{
            $troisiemeE = "03e Echéancier :".$dataSc->troisiemeE.
            " ".$dataSc->troisiemeMont." ".$this->toWords->inWords($dataSc->troisiemeMont) .$this->devise ;
        }

        if(empty($dataSc->quatriemeE)||empty($dataSc->quatriemeMont)){
            $quatriemeE = $this->formatNull; 
        }else{
            $quatriemeE = "04e Echéancier :".$dataSc->quatriemeE." ".$dataSc->quatriemeMont.
            " ".$this->toWords->inWords($dataSc->quatriemeMont) .$this->devise ;
        }

        if(empty($dataSc->cinquiemeE)||empty($dataSc->cinquiemeMont) ){
            $cinquiemeE=$this->formatNull; 
        }else{
            $cinquiemeE = "04e Echéancier :".$dataSc->cinquiemeE." ".$dataSc->cinquiemeMont.
            " ".$this->toWords->inWords($dataSc->cinquiemeMont) .$this->devise ; 
        }
        
        if(empty($dataSc->sixiemeE)||empty($dataSc->sixiemeMont)){
            $sixiemeE=$this->formatNull; 
        }else{
            $sixiemeE = "06e Echéancier :".$dataSc->sixiemeE." ".$dataSc->sixiemeMont.
            " ".$this->toWords->inWords($dataSc->sixiemeMont) .$this->devise ;  
        }
        if(empty($dataSc->septiemeE)||empty($dataSc->septiemeMont)){
            $septiemeE=$this->formatNull; 
        }else{
            $septiemeE = "07e Echéancier :".$dataSc->septiemeE." ".$dataSc->septiemeMont.
            " ".$this->toWords->inWords($dataSc->septiemeMont) .$this->devise ;    
        }
        if(empty($dataSc->huitiemeE)||empty($dataSc->huitiemeMont) ){
            $huitiemeE=$this->formatNull; 
        }else{
            $huitiemeE = "08e Echéancier :".$dataSc->huitiemeE." ".$dataSc->huitiemeMont.
            " ".$this->toWords->inWords($dataSc->huitiemeMont) .$this->devise ;  
        }
        if(empty($dataSc->neuviemeE)||empty($dataSc->neuviemeMont) ){
            $neuviemeE=$this->formatNull; 
        }else{
            $neuviemeE = "09e Echéancier :".$dataSc->neuviemeE
            ." ".$dataSc->neuviemeMont." ".$this->toWords->inWords($dataSc->neuviemeMont ) .$this->devise ; 
        }
        if(empty($dataSc->dixiemeE)||empty($dataSc->dixiemeMont) ){
            $dixiemeE=$this->formatNull; 
        }else{
            $dixiemeE = "10e Echéancier :".$dataSc->dixiemeE
            ." ".$dataSc->dixiemeMont." ".$this->toWords->inWords($dataSc->dixiemeMont) .$this->devise ;   
        }
        if(empty($dataSc->onziemeE)||empty($dataSc->onziemeMont) ){
            $onziemeE=$this->formatNull; 
        }else{
            $onziemeE = "11e Echéancier :".$dataSc->onziemeE
            ." ".$dataSc->onziemeMont." ".$this->toWords->inWords($dataSc->onziemeMont ) .$this->devise ;   
        }
        if(empty($dataSc->douziemeE)||empty($dataSc->douziemeMont) ){
            $douziemeE=$this->formatNull; 
        }else{
            $douziemeE = "12e Echéancier :".$dataSc->douziemeE
            ." ".$dataSc->douziemeMont." ".$this->toWords->inWords($dataSc->douziemeMont) .$this->devise ;  
        }
        return ['premierE'=>$premierE,'deuxiemeE'=>$deuxiemeE,'troisiemeE'=>$troisiemeE,
                'quatriemeE'=>$quatriemeE,'cinquiemeE'=>$cinquiemeE,'sixiemeE'=>$sixiemeE,
                'septiemeE'=>$septiemeE,'huitiemeE'=>$huitiemeE,'neuviemeE'=>$neuviemeE,
                'dixiemeE'=>$dixiemeE,'onziemeE'=>$onziemeE,'douziemeE'=>$douziemeE,
        ];
    }
}