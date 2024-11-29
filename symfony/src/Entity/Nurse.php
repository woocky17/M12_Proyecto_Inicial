<?php

namespace App\Entity;

use App\Repository\NurseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NurseRepository::class)]
class Nurse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null; // Cambiado a int

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $gmail = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    public function getId(): ?int // Cambiado a int
    {
        return $this->id; // Asegúrate de que se refiere a la propiedad correcta
    }

    public function setId(int $id): static
    {
        $this->id = $id; // Cambiado a id

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name; // Cambiado a name
    }

    public function setName(string $name): static
    {
        $this->name = $name; // Cambiado a name

        return $this;
    }

    public function getGmail(): ?string
    {
        return $this->gmail; // Cambiado a gmail
    }

    public function setGmail(string $gmail): static
    {
        $this->gmail = $gmail; // Cambiado a gmail

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password; // Cambiado a password
    }

    public function setPassword(string $password): static
    {
        $this->password = $password; // Cambiado a password

        return $this;
    }
}
