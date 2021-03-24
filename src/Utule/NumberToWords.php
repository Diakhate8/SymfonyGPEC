<?php

namespace App\Utule;

use App\Repository\CompteRepository;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;

class NumberToWords{
    private  $locale = 'fr-FR';
    
    public function inWords($number){
        $in_words="";
        if($number!= null){
            $this->fmt = numfmt_create($this->locale, NumberFormatter::SPELLOUT);
            $in_words = numfmt_format($this->fmt, $number); 

        }else{
            // return null
            $in_words ="";
        }
        return $in_words;

    }

}

?>