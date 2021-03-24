<?php
namespace App\Utule;

use App\Utule\FormatedDate;
use Symfony\Component\Config\Definition\Exception\Exception;

/*
*Convertion Json date to dateTime interface for BD
*/
class Modalites{

    public function formaterDate($date1){
        $this->date = \DateTime::createFromFormat('Y-m-d',$date1);
        return $this->date;
    }

    public function modalite($dataSc){
        $format= 'Y-m-d';
        if(empty($dataSc->premierE)|| empty($dataSc->premierMont)){
            throw new Exception("Entrez saisir le premier echeancier ");  
        }else{
            $premierE = $this->formaterDate($dataSc->premierE) ;$premierMont = $dataSc->premierMont;
        }
        // dd($dataSc->premierE." ".$dataSc->premierMont);

        if(empty($dataSc->deuxiemeE)|| empty($dataSc->deuxiemeMont)){
            $deuxiemeE = null; $deuxiemeMont = null;
        }else{
             $deuxiemeE = $this->formaterDate($dataSc->deuxiemeE); $deuxiemeMont = $dataSc->deuxiemeMont;
        }
        if(empty($dataSc->troisiemeE)|| empty($dataSc->troisiemeMont)){
            $troisiemeE = null; $troisiemeMont = null;
        }else{
            $troisiemeE = \DateTime::createFromFormat($format,$dataSc->troisiemeE);$troisiemeMont = $dataSc->troisiemeMont;
        }
        if(empty($dataSc->quatriemeE)|| empty($dataSc->quatriemeMont)){
            $quatriemeE = null; $quatriemeMont = null;
        }else{
            $quatriemeE = \DateTime::createFromFormat($format,$dataSc->quatriemeE);$quatriemeMont = $dataSc->quatriemeMont;
        }      
        if(empty($dataSc->cinquiemeE) || empty($dataSc->cinquiemeMont)){
            $cinquiemeE=null; $cinquiemeMont = null;
        }else{
            $cinquiemeE = \DateTime::createFromFormat($format,$dataSc->cinquiemeE);$cinquiemeMont = $dataSc->cinquiemeMont;    
        }
        if(empty($dataSc->sixiemeE) || empty($dataSc->sixiemeMont)){
            $sixiemeE=null; $sixiemeMont = null;
        }else{
            $sixiemeE = \DateTime::createFromFormat($format,$dataSc->sixiemeE);$sixiemeMont = $dataSc->sixiemeMont;    
        }
        if(empty($dataSc->septiemeE) || empty($dataSc->septiemeMont)){
            $septiemeE=null; $septiemeMont = null;
        }else{
            $septiemeE= \DateTime::createFromFormat($format,$dataSc->septiemeE);$septiemeMont = $dataSc->septiemeMont;    
        }
        if(empty($dataSc->huitiemeE) || empty($dataSc->huitiemeMont)){
            $huitiemeE=null; $huitiemeMont = null;
        }else{
            $huitiemeE = \DateTime::createFromFormat($format,$dataSc->huitiemeE);$huitiemeMont = $dataSc->huitiemeMont;    
        }
        if(empty($dataSc->neuviemeE) || empty($dataSc->neuviemeMont)){
            $neuviemeE=null; $neuviemeMont = null;
        }else{
            $neuviemeE = \DateTime::createFromFormat($format,$dataSc->neuviemeE);$neuviemeMont = $dataSc->neuviemeMont;    
        }
        if(empty($dataSc->dixiemeE) || empty($dataSc->dixiemeMont)){
            $dixiemeE=null; $dixiemeMont = null;
        }else{
            $dixiemeE = \DateTime::createFromFormat($format,$dataSc->dixiemeE);$dixiemeMont = $dataSc->dixiemeMont;    
        }
        if(empty($dataSc->onziemeE) || empty($dataSc->onziemeMont)){
            $onziemeE=null; $onziemeMont = null;
        }else{
            $onziemeE = \DateTime::createFromFormat($format,$dataSc->onziemeE);$onziemeMont = $dataSc->onziemeMont;    
        }
        if(empty($dataSc->douziemeE) || empty($dataSc->douziemeMont)){
            $douziemeE=null; $douziemeMont = null;
        }else{
            $douziemeE = \DateTime::createFromFormat($format,$dataSc->douziemeE);$douziemeMont = $dataSc->douziemeMont;    
        }
        return ['premierE'=>$premierE,'premierMont' =>$premierMont,'deuxiemeE'=>$deuxiemeE,
        'deuxiemeMont'=>$deuxiemeMont,'troisiemeE'=>$troisiemeE,'troisiemeMont'=>$troisiemeMont,
        'quatriemeE'=>$quatriemeE,'quatriemeMont'=>$quatriemeMont,'cinquiemeE'=>$cinquiemeE,
        'cinquiemeMont'=>$cinquiemeMont,'sixiemeE'=>$sixiemeE,'sixiemeMont'=>$sixiemeMont,
        'septiemeE'=>$septiemeE,'septiemeMont'=>$septiemeMont,'huitiemeE'=>$huitiemeE,
        'huitiemeMont'=>$huitiemeMont,'neuviemeE'=>$neuviemeE,'neuviemeMont'=>$neuviemeMont,
        'dixiemeE'=>$dixiemeE,'dixiemeMont'=>$dixiemeMont,'onziemeE'=>$onziemeE,
        'onziemeMont'=>$onziemeMont,'douziemeE'=>$douziemeE,'douziemeMont'=>$douziemeMont];

    }
    
}
