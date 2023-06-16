<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BanquePhotoRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: BanquePhotoRepository::class)]
#[ApiResource(
    normalizationContext: [ "groups" => ["read:product"]]
)]
class BanquePhoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToOne(inversedBy: 'banquePhotos')]
    private ?Product $id_product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->id_product;
    }

    public function setIdProduct(?Product $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }
}
