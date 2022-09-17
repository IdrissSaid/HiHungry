<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatsRepository::class)]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix2 = null;

    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix1(): ?int
    {
        return $this->prix1;
    }

    public function setPrix1(?int $prix1): self
    {
        $this->prix1 = $prix1;

        return $this;
    }

    public function getPrix2(): ?int
    {
        return $this->prix2;
    }

    public function setPrix2(?int $prix2): self
    {
        $this->prix2 = $prix2;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
