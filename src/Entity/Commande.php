<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write", "get:vente", "get:contrat"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"post:read", "post:write", "get:vente","get:contrat"})
     * @Assert\NotBlank(message="Entrez la designation de l'article")
     */
    private $designation;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"post:read", "post:write", "get:vente","get:contrat"})
     * @Assert\NotBlank(message="Entrez le prix unitaire")
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write", "get:vente","get:contrat"})
     * @Assert\NotBlank(message="Entrez le nombre d'articles")
     */
    private $nombre;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"post:read", "post:write", "get:vente","get:contrat"})
     */
    private $prixTotal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Facture", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrat;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(string $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(string $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

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
