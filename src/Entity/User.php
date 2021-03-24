<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *     itemOperations={
 *          "get"={ "access_control"="is_granted('CAN_POST', object)",

 *              "normalization_context"={"groups"={"user:read", "user:item:get"}},
 *          },
 *          "put"={
 *              "access_control"="is_granted('CAN_POST', object)",
 *              "access_control_message"="Accés non autorisé"
 *          },
 *          "delete"={"access_control"="is_granted('CAN_POST',object)"}
 *     },
 *     collectionOperations={
 *          "get"={"security"="is_granted('ROLE_ADMIN_SYSTEM')"},
 *          "post"={"access_control"="is_granted('CAN_POST',object)"}
 *     }
 * )
 * @UniqueEntity(fields={"email"}, message="Cette mail est déjà enregistrée")
 * @UniqueEntity(fields = {"username"},message ="ce pseudo est  déjà utulisé") 
 * @UniqueEntity(fields = {"telephone"},message ="un client est deja enregistré sur ce numero de telephone") 
 */
class User implements UserInterface 
{

     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank(message="entrez username")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255 )
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank(message="entrez votre password")
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"post:read", "post:write"})
     * @Assert\Email(
     *     message = "The email is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer", unique=true)
     * @Groups({"post:read", "post:write"})
     * @Assert\Regex("/^(78||77||76||70)[0-9]{7}$/")
     * @Assert\NotBlank(message="entrez votre telephone")
     * 
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank
     */
    private $role;

    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"post:read", "post:write"})
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="userCreateur")
     */
    private $contrats;

  
    public function __construct()
    {
        $this->isActive = true;
        $this->contrats = new ArrayCollection();
       
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
    
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_.... 
        return $this->roles = [strtoupper($this->getRole()->getLibelle())];
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        return true;
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
            $contrat->setUserCreateur($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getUserCreateur() === $this) {
                $contrat->setUserCreateur(null);
            }
        }

        return $this;
    }




    

}
