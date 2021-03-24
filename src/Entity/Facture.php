<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez entrez lenumero de facture")
     * @Groups({"post:read", "post:write"})
     */
    private $numFacture;

     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="entrez la reference du contrat")
     */
    private $reference;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank(message="Veuillez entrez lacompte")
     * @Groups({"post:read", "post:write"})
     */
    private $acompte;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank(message="Veuillez entrez le montant a verser")
     * @Groups({"post:read", "post:write"})
     */
    private $montAVerser;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank(message="Veuillez entrez le montant verse")
     * @Groups({"post:read", "post:write"})
     */
    private $montVerse;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank(message="Veuillez entrez le montant restant a payer")
     * @Groups({"post:read", "post:write"})
     */
    private $resteAPayer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="facture", orphanRemoval=true)
     * @Groups({"post:read", "post:write"})
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat", inversedBy="factures")
     */
    private $contrat;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumFacture(): ?string
    {
        return $this->numFacture;
    }

    public function setNumFacture(string $numFacture): self
    {
        $this->numFacture = $numFacture;

        return $this;
    }
    
    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the value of acompte
     */ 
    public function getAcompte()
    {
        return $this->acompte;
    }

    /**
     * Set the value of acompte
     *
     * @return  self
     */ 
    public function setAcompte($acompte)
    {
        $this->acompte = $acompte;

        return $this;
    }

    /**
     * Get the value of montAVerser
     */ 
    public function getMontAVerser()
    {
        return $this->montAVerser;
    }

    /**
     * Set the value of montAVerser
     *
     * @return  self
     */ 
    public function setMontAVerser($montAVerser)
    {
        $this->montAVerser = $montAVerser;

        return $this;
    }

    /**
     * Get the value of montVerse
     */ 
    public function getMontVerse()
    {
        return $this->montVerse;
    }

    /**
     * Set the value of montVerse
     *
     * @return  self
     */ 
    public function setMontVerse($montVerse)
    {
        $this->montVerse = $montVerse;

        return $this;
    }

    /**
     * Get the value of resteAPayer
     */ 
    public function getResteAPayer()
    {
        return $this->resteAPayer;
    }

    /**
     * Set the value of resteAPayer
     *
     * @return  self
     */ 
    public function setResteAPayer($resteAPayer)
    {
        $this->resteAPayer = $resteAPayer;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setFacture($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getFacture() === $this) {
                $commande->setFacture(null);
            }
        }

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    
}
