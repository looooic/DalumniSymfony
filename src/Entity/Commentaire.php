<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecom;


    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="author",)
     *
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="user",)
     *
     */
    private $author;

    public function __construct()
    {
        $this->datecom = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDatecom(): ?\DateTimeInterface
    {
        return $this->datecom;
    }

    public function setDatecom(\DateTimeInterface $datecom): self
    {
        $this->datecom = $datecom;

        return $this;
    }


    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;
        return $this;
    }


    public function getAuthor(): ?Author
    {
        return $this->author;
    }


    public function setAuthor(?Author $author): self
    {
        $this->author = $author;
        return $this;
    }


}
