<?php
namespace App\Utule;
/**
 * Format string date to date time interface
 */
class FormatedDate{
    private $date ;

    public function formaterDate($date1){
        $this->date = \DateTime::createFromFormat('Y-m-d',$date1);
        return $this->date;
    }
 
   


}














?>
