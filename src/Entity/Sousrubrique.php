<?php

namespace App\Entity;

use App\Repository\SousrubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousrubriqueRepository::class)]
class Sousrubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_sousrubrique = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_sousrubrique = null;

    #[ORM\ManyToOne(inversedBy: 'sousrubriques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $rubrique = null;

    #[ORM\OneToMany(mappedBy: 'sousrubrique', targetEntity: Product::class)]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRubrique(): ?Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setSousrubrique($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getSousrubrique() === $this) {
                $product->setSousrubrique(null);
            }
        }

        return $this;
    }

}