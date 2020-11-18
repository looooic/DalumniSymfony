<?php

namespace App\Entity;

use App\Repository\ActuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActuRepository::class)
 */
class Actu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreactu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoactu;

    /**
     * @ORM\Column(type="text")
     */
    private $messageactu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateactu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreactu(): ?string
    {
        return $this->titreactu;
    }

    public function setTitreactu(string $titreactu): self
    {
        $this->titreactu = $titreactu;

        return $this;
    }

    public function getPhotoactu(): ?string
    {
        return $this->photoactu;
    }

    public function setPhotoactu(?string $photoactu): self
    {
        $this->photoactu = $photoactu;

        return $this;
    }

    public function getMessageactu(): ?string
    {
        return $this->messageactu;
    }

    public function setMessageactu(string $messageactu): self
    {
        $this->messageactu = $messageactu;

        return $this;
    }

    public function getDateactu(): ?\DateTimeInterface
    {
        return $this->dateactu;
    }

    public function setDateactu(\DateTimeInterface $dateactu): self
    {
        $this->dateactu = $dateactu;

        return $this;
    }
}
