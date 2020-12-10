<?php

namespace App\Entity;

use App\Repository\ActuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ActuRepository::class)
 * @Vich\Uploadable
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
     * @var File|null
     * @Vich\UploadableField(mapping="new_actu", fileNameProperty="photoactu")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="text")
     */
    private $messageactu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateactu;

    /**
     * @ORM\ManyToOne(targetEntity=Home::class, inversedBy="actus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $home;

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

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Actu
     */
    public function setImageFile(?File $imageFile): Actu
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getHome(): ?Home
    {
        return $this->home;
    }

    public function setHome(?Home $home): self
    {
        $this->home = $home;

        return $this;
    }
}
