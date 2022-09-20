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
    private ?float $prix1 = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix2 = null;

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

    public function getPrix1(): ?float
    {
        return $this->prix1;
    }

    public function setPrix1(?float $prix1): self
    {
        $this->prix1 = $prix1;

        return $this;
    }

    public function getPrix2(): ?float
    {
        return $this->prix2;
    }

    public function setPrix2(?float $prix2): self
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
