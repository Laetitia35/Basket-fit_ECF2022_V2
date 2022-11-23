<?php

namespace App\Entity;

use App\Repository\FranchiseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: FranchiseRepository::class)]

class Franchise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Logo = null;

    #[ORM\Column]
    private ?bool $Actif = null;

    #[ORM\OneToOne(inversedBy: 'franchise', cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'franchise', targetEntity: FranchisePermission::class, orphanRemoval: true)]
    private Collection $franchisePermissions;

    public function __construct()
    {
        $this->franchisePermissions = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getLogo()
    {
        return $this->Logo;
    }

    public function setLogo($Logo): self
    {
        $this->Logo = $Logo;

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


    public function __toString()
    {
        return $this->Name;
    }

    /**
     * @return Collection<int, FranchisePermission>
     */
    public function getFranchisePermissions(): Collection
    {
        return $this->franchisePermissions;
    }

    public function addFranchisePermission(FranchisePermission $franchisePermission): self
    {
        if (!$this->franchisePermissions->contains($franchisePermission)) {
            $this->franchisePermissions->add($franchisePermission);
            $franchisePermission->setFranchise($this);
        }

        return $this;
    }

    public function removeFranchisePermission(FranchisePermission $franchisePermission): self
    {
        if ($this->franchisePermissions->removeElement($franchisePermission)) {
            // set the owning side to null (unless already changed)
            if ($franchisePermission->getFranchise() === $this) {
                $franchisePermission->setFranchise(null);
            }
        }

        return $this;
    }

}

