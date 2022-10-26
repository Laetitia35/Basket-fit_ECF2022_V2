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

    #[ORM\ManyToMany(targetEntity: Franchise::class, inversedBy: 'permissions')]
    private Collection $Franchise;

    #[ORM\ManyToMany(targetEntity: Structure::class, mappedBy: 'Permission')]
    private Collection $structures;

    public function __construct()
    {
        $this->Franchise = new ArrayCollection();
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

    /**
     * @return Collection<int, Franchise>
     */
    public function getFranchise(): Collection
    {
        return $this->Franchise;
    }

    public function addFranchise(Franchise $franchise): self
    {
        if (!$this->Franchise->contains($franchise)) {
            $this->Franchise->add($franchise);
        }

        return $this;
    }

    public function removeFranchise(Franchise $franchise): self
    {
        $this->Franchise->removeElement($franchise);

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
