<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_rubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_rubrique = null;

    #[ORM\OneToMany(mappedBy: 'rubrique', targetEntity: Sousrubrique::class)]
    private Collection $sousrubriques;

    public function __construct()
    {
        $this->sousrubriques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeRubrique(): ?string
    {
        return $this->code_rubrique;
    }

    public function setCodeRubrique(string $code_rubrique): self
    {
        $this->code_rubrique = $code_rubrique;

        return $this;
    }

    public function getNomRubrique(): ?string
    {
        return $this->nom_rubrique;
    }

    public function setNomRubrique(string $nom_rubrique): self
    {
        $this->nom_rubrique = $nom_rubrique;

        return $this;
    }

    /**
     * @return Collection<int, Sousrubrique>
     */
    public function getSousrubriques(): Collection
    {
        return $this->sousrubriques;
    }

    public function addSousrubrique(Sousrubrique $sousrubrique): self
    {
        if (!$this->sousrubriques->contains($sousrubrique)) {
            $this->sousrubriques->add($sousrubrique);
            $sousrubrique->setRubrique($this);
        }

        return $this;
    }

    public function removeSousrubrique(Sousrubrique $sousrubrique): self
    {
        if ($this->sousrubriques->removeElement($sousrubrique)) {
            // set the owning side to null (unless already changed)
            if ($sousrubrique->getRubrique() === $this) {
                $sousrubrique->setRubrique(null);
            }
        }

        return $this;
    }
}
