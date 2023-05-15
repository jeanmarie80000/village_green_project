<?php

namespace App\Entity;

use App\Repository\SousrubriqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousrubriqueRepository::class)]
class Sousrubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_sousrubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $code_sousrubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_sousrubrique = null;

    public function getId(): ?int
    {
        return $this->id_sousrubrique;
    }

    public function getCodeSousrubrique(): ?string
    {
        return $this->code_sousrubrique;
    }

    public function setCodeSousrubrique(string $code_sousrubrique): self
    {
        $this->code_sousrubrique = $code_sousrubrique;

        return $this;
    }

    public function getNomSousrubrique(): ?string
    {
        return $this->nom_sousrubrique;
    }

    public function setNomSousrubrique(string $nom_sousrubrique): self
    {
        $this->nom_sousrubrique = $nom_sousrubrique;

        return $this;
    }
}
