<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $cvName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $userId = null;

    public function getId(): ?int
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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
