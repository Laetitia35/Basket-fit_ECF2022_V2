<?php

namespace App\Entity;

use App\Repository\FranchisePermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FranchisePermissionRepository::class)]
class FranchisePermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $Actif = null;

    
    #[ORM\ManyToOne(inversedBy: 'Franchise')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Franchise $franchise = null;

    
    #[ORM\ManyToOne(inversedBy: 'Permission')]
    private ?Permission $permission = null;

    #[ORM\OneToMany(mappedBy: 'franchisePermission', targetEntity: Structure::class)]
    private Collection $structure;


    public function __construct($franchise, $permission)
    {
        $this->Franchise_Permission = new ArrayCollection();
        $this->Franchise = $franchise;
        $this->Permission = $permission;
        $this->structure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFranchise(): ?Franchise
    {
        return $this->franchise;
    }

    public function setFranchise(?Franchise $franchise): self
    {
        $this->franchise = $franchise;

        return $this;
    }

    public function getPermission(): ?Permission
    {
        return $this->permission;
    }

    public function setPermission(?Permission $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructure(): Collection
    {
        return $this->structure;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structure->contains($structure)) {
            $this->structure->add($structure);
            $structure->setFranchisePermission($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structure->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getFranchisePermission() === $this) {
                $structure->setFranchisePermission(null);
            }
        }

        return $this;
    }

   
}
