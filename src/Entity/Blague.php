<?php

namespace App\Entity;

use App\Repository\BlagueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlagueRepository::class)]
class Blague
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['jokes'])]
    private ?int $id = null;

    #[Groups(['jokes'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'blagues')]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
