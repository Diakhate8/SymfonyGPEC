<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EcheancierRepository")
 */
class Echeancier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"post:read", "post:write"})
     */
    private $nbrEcheanciers;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $premierE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $deuxiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $troisiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $quatriemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $cinquiemeE;

     /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $sixiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $septiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $huitiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $neuviemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $dixiemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $onziemeE;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $douziemeE;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"post:read", "post:write"})
     */
    private $premierMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $deuxiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $troisiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $quatriemeMont;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $cinquiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $sixiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $septiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $huitiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $neuviemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $dixiemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $onziemeMont;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"post:read", "post:write"})
     */
    private $douziemeMont;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrEcheanciers(): ?int
    {
        return $this->nbrEcheanciers;
    }

    public function setNbrEcheanciers(int $nbrEcheanciers): self
    {
        $this->nbrEcheanciers = $nbrEcheanciers;

        return $this;
    }

    public function getPremierE(): ?\DateTimeInterface
    {
        return $this->premierE;
    }

    public function setPremierE(?\DateTimeInterface $premierE): self
    {
        $this->premierE = $premierE;

        return $this;
    }

    public function getDeuxiemeE(): ?\DateTimeInterface
    {
        return $this->deuxiemeE;
    }

    public function setDeuxiemeE(?\DateTimeInterface $deuxiemeE): self
    {
        $this->deuxiemeE = $deuxiemeE;

        return $this;
    }

    public function getTroisiemeE(): ?\DateTimeInterface
    {
        return $this->troisiemeE;
    }

    public function setTroisiemeE(?\DateTimeInterface $troisiemeE): self
    {
        $this->troisiemeE = $troisiemeE;

        return $this;
    }

    public function getQuatriemeE(): ?\DateTimeInterface
    {
        return $this->quatriemeE;
    }

    public function setQuatriemeE(?\DateTimeInterface $quatriemeE): self
    {
        $this->quatriemeE = $quatriemeE;

        return $this;
    }

    public function getCinquiemeE(): ?\DateTimeInterface
    {
        return $this->cinquiemeE;
    }

    public function setCinquiemeE(?\DateTimeInterface $cinquiemeE): self
    {
        $this->cinquiemeE = $cinquiemeE;

        return $this;
    }

    public function getSixiemeE(): ?\DateTimeInterface
    {
        return $this->sixiemeE;
    }

    public function setSixiemeE(?\DateTimeInterface $sixiemeE): self
    {
        $this->sixiemeE = $sixiemeE;

        return $this;
    }

    public function getSeptiemeE(): ?\DateTimeInterface
    {
        return $this->septiemeE;
    }

    public function setSeptiemeE(?\DateTimeInterface $septiemeE): self
    {
        $this->septiemeE = $septiemeE;

        return $this;
    }

    public function getHuitiemeE(): ?\DateTimeInterface
    {
        return $this->huitiemeE;
    }

    public function setHuitiemeE(?\DateTimeInterface $huitiemeE): self
    {
        $this->huitiemeE = $huitiemeE;

        return $this;
    }

    public function getNeuviemeE(): ?\DateTimeInterface
    {
        return $this->neuviemeE;
    }

    public function setNeuviemeE(?\DateTimeInterface $neuviemeE): self
    {
        $this->neuviemeE = $neuviemeE;

        return $this;
    }

    public function getDixiemeE(): ?\DateTimeInterface
    {
        return $this->dixiemeE;
    }

    public function setDixiemeE(?\DateTimeInterface $dixiemeE): self
    {
        $this->dixiemeE = $dixiemeE;

        return $this;
    }

    public function getOnziemeE(): ?\DateTimeInterface
    {
        return $this->onziemeE;
    }

    public function setOnziemeE(?\DateTimeInterface $onziemeE): self
    {
        $this->onziemeE = $onziemeE;

        return $this;
    }

    public function getDouziemeE(): ?\DateTimeInterface
    {
        return $this->douziemeE;
    }

    public function setDouziemeE(?\DateTimeInterface $douziemeE): self
    {
        $this->douziemeE = $douziemeE;

        return $this;
    }
    
    public function getPremierMont(): ?string
    {
        return $this->premierMont;
    }

    public function setPremierMont(string $premierMont): self
    {
        $this->premierMont = $premierMont;

        return $this;
    }

    public function getDeuxiemeMont(): ?string
    {
        return $this->deuxiemeMont;
    }

    public function setDeuxiemeMont(?string $deuxiemeMont): self
    {
        $this->deuxiemeMont = $deuxiemeMont;

        return $this;
    }

    public function getTroisiemeMont(): ?string
    {
        return $this->troisiemeMont;
    }

    public function setTroisiemeMont(?string $troisiemeMont): self
    {
        $this->troisiemeMont = $troisiemeMont;

        return $this;
    }

    public function getQuatriemeMont(): ?string
    {
        return $this->quatriemeMont;
    }

    public function setQuatriemeMont(?string $quatriemeMont): self
    {
        $this->quatriemeMont = $quatriemeMont;

        return $this;
    }

    public function getCinquiemeMont(): ?int
    {
        return $this->cinquiemeMont;
    }

    public function setCinquiemeMont(?int $cinquiemeMont): self
    {
        $this->cinquiemeMont = $cinquiemeMont;

        return $this;
    }

    public function getSixiemeMont(): ?string
    {
        return $this->sixiemeMont;
    }

    public function setSixiemeMont(?string $sixiemeMont): self
    {
        $this->sixiemeMont = $sixiemeMont;

        return $this;
    }

    public function getSeptiemeMont(): ?string
    {
        return $this->septiemeMont;
    }

    public function setSeptiemeMont(?string $septiemeMont): self
    {
        $this->septiemeMont = $septiemeMont;

        return $this;
    }

    public function getHuitiemeMont(): ?string
    {
        return $this->huitiemeMont;
    }

    public function setHuitiemeMont(?string $huitiemeMont): self
    {
        $this->huitiemeMont = $huitiemeMont;

        return $this;
    }

    public function getNeuviemeMont(): ?string
    {
        return $this->neuviemeMont;
    }

    public function setNeuviemeMont(?string $neuviemeMont): self
    {
        $this->neuviemeMont = $neuviemeMont;

        return $this;
    }

    public function getDixiemeMont(): ?string
    {
        return $this->dixiemeMont;
    }

    public function setDixiemeMont(?string $dixiemeMont): self
    {
        $this->dixiemeMont = $dixiemeMont;

        return $this;
    }

    public function getOnziemeMont(): ?string
    {
        return $this->onziemeMont;
    }

    public function setOnziemeMont(?string $onziemeMont): self
    {
        $this->onziemeMont = $onziemeMont;

        return $this;
    }

    public function getDouziemeMont(): ?string
    {
        return $this->douziemeMont;
    }

    public function setDouziemeMont(?string $douziemeMont): self
    {
        $this->douziemeMont = $douziemeMont;

        return $this;
    }

    
}
