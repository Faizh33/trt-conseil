<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV7 as Uuid;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 100)]
    private ?string $cvName = null;

    #[ORM\OneToOne(inversedBy: 'candidate', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    public function setCvName(string $cvName): static
    {
        $this->cvName = $cvName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
