<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity(fields = {"numClient"},message ="un client est deja enregistré sur ce numero") 
 * @UniqueEntity(fields = {"cni"},message ="un client est deja enregistré sur ce cni") 
 * @UniqueEntity(fields = {"telephone"},message ="un client est deja enregistré sur ce numero de") 
 */
class Client 
{
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank(message="Entrez le numero du client")
     * @Groups({"post:read", "post:write"})
     */
    private $numClient;
 
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrez le prenom")
     * @Groups({"post:read", "post:write"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrez le nom")
     * @Groups({"post:read", "post:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillez entrez la date de naissance")
     * @Groups({"post:write"})
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrez le lieu de naissance")
     * @Groups({"post:write"})
     */
    private $lieuNaiss;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Entrez la piece didentite ou passeword du client")
     */
    private $cni;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDCni;

    /**
     * @ORM\Column(type="date")
     */
    private $dateECni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domicile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"post:read", "post:write"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="bigint", unique=true)
     * @Assert\NotBlank(message="entrez le numero de telephone")
     * @Groups({"post:read", "post:write"})
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="client")
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="userCreateur")
     * @Groups({"post:read", "post:write"})
     */
    private $contrat;

    
    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->contrat = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getLieuNaiss(): ?string
    {
        return $this->lieuNaiss;
    }

    public function setLieuNaiss(string $lieuNaiss): self
    {
        $this->lieuNaiss = $lieuNaiss;

        return $this;
    }

    public function getNumClient(): ?string
    {
        return $this->numClient;
    }

    public function setNumClient(string $numClient): self
    {
        $this->numClient = $numClient;

        return $this;
    }
    public function getDateDCni(): ?\DateTimeInterface
    {
        return $this->dateDCni;
    }

    public function setDateDCni(\DateTimeInterface $dateDCni): self
    {
        $this->dateDCni = $dateDCni;

        return $this;
    }

    public function getDateECni(): ?\DateTimeInterface
    {
        return $this->dateECni;
    }

    public function setDateECni(\DateTimeInterface $dateECni): self
    {
        $this->dateECni = $dateECni;

        return $this;
    }

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

    public function getDomicile(): ?string
    {
        return $this->domicile;
    }

    public function setDomicile(?string $domicile): self
    {
        $this->domicile = $domicile;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setClient($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getClient() === $this) {
                $contrat->setClient(null);
            }
        }

        return $this;
    }

   

   
   
}
