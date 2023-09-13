<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 200)]
  private ?string $title = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $content = null;

  #[ORM\Column]
  private ?bool $visible = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $dateCreated = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): static
  {
    $this->title = $title;

    return $this;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): static
  {
    $this->content = $content;

    return $this;
  }

  public function isVisible(): ?bool
  {
    return $this->visible;
  }

  public function setVisible(bool $visible): static
  {
    $this->visible = $visible;

    return $this;
  }

  public function getDateCreated(): ?\DateTimeInterface
  {
    return $this->dateCreated;
  }

  public function setDateCreated(\DateTimeInterface $dateCreated): static
  {
    $this->dateCreated = $dateCreated;

    return $this;
  }
}
