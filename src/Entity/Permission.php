<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
class Permission
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?bool $Actif = null;

    #[ORM\OneToMany(mappedBy: 'permission', targetEntity: FranchisePermission::class)]
    private Collection $permissions;

    #[ORM\ManyToMany(targetEntity: Structure::class, mappedBy: 'permissions')]
    private Collection $structures;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
        $this->structures = new ArrayCollection();
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

    public function isActif(): ?bool
    {
        return $this->Actif;
    }

    public function setActif(bool $Actif): self
    {
        $this->Actif = $Actif;

        return $this;
    }

    public function __toString()
    {
        return $this->Name;
    }

    /**
     * @return Collection<int, FranchisePermission>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(FranchisePermission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->setPermission($this);
        }

        return $this;
    }

    public function removePermission(FranchisePermission $permission): self
    {
        if ($this->permissions->removeElement($permission)) {
            // set the owning side to null (unless already changed)
            if ($permission->getPermission() === $this) {
                $permission->setPermission(null);
            }
        }

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
            $structure->addPermission($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            $structure->removePermission($this);
        }

        return $this;
    }

}
