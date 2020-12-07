<?php

namespace App\Entity;

use App\Repository\HomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeRepository::class)
 */
class Home
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Actu::class, mappedBy="home")
     */
    private $actus;

    public function __construct()
    {
        $this->actus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Actu[]
     */
    public function getActus(): Collection
    {
        return $this->actus;
    }

    public function addActu(Actu $actu): self
    {
        if (!$this->actus->contains($actu)) {
            $this->actus[] = $actu;
            $actu->setHome($this);
        }

        return $this;
    }

    public function removeActu(Actu $actu): self
    {
        if ($this->actus->removeElement($actu)) {
            // set the owning side to null (unless already changed)
            if ($actu->getHome() === $this) {
                $actu->setHome(null);
            }
        }

        return $this;
    }
}
