<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $descri = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_create = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $price_pt = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sousrubrique $sousrubrique = null;

    #[ORM\OneToMany(mappedBy: 'id_product', targetEntity: BanquePhoto::class)]
    private Collection $banquePhotos;

    public function __construct()
    {
        $this->banquePhotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescri(): ?string
    {
        return $this->descri;
    }

    public function setDescri(string $descri): self
    {
        $this->descri = $descri;

        return $this;
    }
    
    public function getPricePt(): ?string
    {
        return $this->price_pt;
    }
    
    public function setPricePt(string $price_pt): self
    {
        $this->price_pt = $price_pt;
        
        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

        return $this;
    }
    
    public function getSousrubrique(): ?Sousrubrique
    {
        return $this->sousrubrique;
    }

    public function setSousrubrique(?Sousrubrique $sousrubrique): self
    {
        $this->sousrubrique = $sousrubrique;

        return $this;
    }

    /**
     * @return Collection<int, BanquePhoto>
     */
    public function getBanquePhotos(): Collection
    {
        return $this->banquePhotos;
    }

    public function addBanquePhoto(BanquePhoto $banquePhoto): self
    {
        if (!$this->banquePhotos->contains($banquePhoto)) {
            $this->banquePhotos->add($banquePhoto);
            $banquePhoto->setIdProduct($this);
        }

        return $this;
    }

    public function removeBanquePhoto(BanquePhoto $banquePhoto): self
    {
        if ($this->banquePhotos->removeElement($banquePhoto)) {
            // set the owning side to null (unless already changed)
            if ($banquePhoto->getIdProduct() === $this) {
                $banquePhoto->setIdProduct(null);
            }
        }

        return $this;
    }

    

}
