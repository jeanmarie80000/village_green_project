<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_rubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $code_rubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_rubrique = null;

    public function getId(): ?int
    {
        return $this->id_rubrique;
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
}
