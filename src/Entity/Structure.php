<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Adress = null;

    #[ORM\Column(length: 5)]
    private ?string $CodePostal = null;

    #[ORM\Column(length: 10)]
    private ?string $PhoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?bool $Actif = null;

    #[ORM\OneToOne(inversedBy: 'structure', cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    private ?Franchise $Franchise = null;

    
    #[ORM\Column(length: 60)]
    private ?string $City = null;

    #[ORM\ManyToMany(targetEntity: Permission::class, inversedBy: 'structures')]
    private Collection $permissions;

    public function __toString() 
    {
        return $this->Name;
    }

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->Actif;
    }

    public function setActif(bool $Actif): self
    {
        $this->Actif = $Actif;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFranchise(): ?Franchise
    {
        return $this->Franchise;
    }

    public function setFranchise(?Franchise $Franchise): self
    {
        $this->Franchise = $Franchise;

        return $this;
    }

    

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    /**
     * @return Collection<int, Permission>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        $this->permissions->removeElement($permission);

        return $this;
    }
}
