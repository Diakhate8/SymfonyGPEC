<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


class ClientSearch 
{
    /**
     * @Assert\NotBlank(message="Entrez le numero du client")
     */
    private $numClient;

    
    /**
     * @Assert\NotBlank(message="Entrez la piece didentite ou passeword du client")
     */
    private $cni;


    /**
     * Get the value of cni
     */ 
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * Set the value of cni
     *
     * @return  self
     */ 
    public function setCni($cni)
    {
        $this->cni = $cni;

        return $this;
    }

    /**
     * Get the value of numClient
     */ 
    public function getNumClient()
    {
        return $this->numClient;
    }

    /**
     * Set the value of numClient
     *
     * @return  self
     */ 
    public function setNumClient($numClient)
    {
        $this->numClient = $numClient;

        return $this;
    }
}
