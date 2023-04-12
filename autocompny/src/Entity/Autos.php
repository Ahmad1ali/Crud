<?php

namespace App\Entity;

use App\Repository\AutosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutosRepository::class)]
class Autos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $gewicht = null;

    #[ORM\Column]
    private ?int $prijs = null;

    #[ORM\Column]
    private ?int $voorraad = null;

    #[ORM\Column(length: 255)]
    private ?string $kleur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGewicht(): ?int
    {
        return $this->gewicht;
    }

    public function setGewicht(int $gewicht): self
    {
        $this->gewicht = $gewicht;

        return $this;
    }

    public function getPrijs(): ?int
    {
        return $this->prijs;
    }

    public function setPrijs(int $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getVoorraad(): ?int
    {
        return $this->voorraad;
    }

    public function setVoorraad(int $voorraad): self
    {
        $this->voorraad = $voorraad;

        return $this;
    }

    public function getKleur(): ?string
    {
        return $this->kleur;
    }

    public function setKleur(string $kleur): self
    {
        $this->kleur = $kleur;

        return $this;
    }
}
