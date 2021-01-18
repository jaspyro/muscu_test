<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomOffre;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $descriptionOffre;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixOffre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageOffre;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $reduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomOffre(): ?string
    {
        return $this->nomOffre;
    }

    public function setNomOffre(string $nomOffre): self
    {
        $this->nomOffre = $nomOffre;

        return $this;
    }

    public function getDescriptionOffre(): ?string
    {
        return $this->descriptionOffre;
    }

    public function setDescriptionOffre(?string $descriptionOffre): self
    {
        $this->descriptionOffre = $descriptionOffre;

        return $this;
    }

    public function getPrixOffre(): ?float
    {
        return $this->PrixOffre;
    }

    public function setPrixOffre(float $PrixOffre): self
    {
        $this->PrixOffre = $PrixOffre;

        return $this;
    }

    public function getImageOffre(): ?string
    {
        return $this->imageOffre;
    }

    public function setImageOffre(?string $imageOffre): self
    {
        $this->imageOffre = $imageOffre;

        return $this;
    }

    public function getReduction(): ?float
    {
        return $this->reduction;
    }

    public function setReduction(?float $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getImageDescription(): ?string
    {
        return $this->imageDescription;
    }

    public function setImageDescription(?string $imageDescription): self
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }




}
