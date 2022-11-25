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

    
    #[ORM\ManyToOne(inversedBy: 'franchises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Franchise $franchise = null;

    #[ORM\OneToMany(mappedBy: 'franchisePermission', targetEntity: Structure::class)]
    private Collection $structures;

    #[ORM\ManyToMany(targetEntity: Permission::class)]
    private Collection $permissions;


    public function __construct()
    {
        $this->structures = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        
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

   
    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setFranchisePermission($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getFranchisePermission() === $this) {
                $structure->setFranchisePermission(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
            return $this->Name;
        
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
