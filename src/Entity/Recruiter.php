<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV7 as Uuid;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]
class Recruiter
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 100)]
    private ?string $enterpriseName = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column]
    private ?int $postalCode = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\Column(length: 100)]
    private ?string $region = null;

    #[ORM\Column(length: 255)]
    private ?string $logoName = null;

    #[ORM\OneToMany(targetEntity: JobPosting::class, mappedBy: 'recruiter')]
    private Collection $jobPostings;

    #[ORM\OneToOne(inversedBy: 'recruiter', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->jobPostings = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getEnterpriseName(): ?string
    {
        return $this->enterpriseName;
    }

    public function setEnterpriseName(string $enterpriseName): static
    {
        $this->enterpriseName = $enterpriseName;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    public function setLogoName(string $logoName): static
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * @return Collection<int, JobPosting>
     */
    public function getJobPostings(): Collection
    {
        return $this->jobPostings;
    }

    public function addJobPosting(JobPosting $jobPosting): static
    {
        if (!$this->jobPostings->contains($jobPosting)) {
            $this->jobPostings->add($jobPosting);
            $jobPosting->setRecruiter($this);
        }

        return $this;
    }

    public function removeJobPosting(JobPosting $jobPosting): static
    {
        if ($this->jobPostings->removeElement($jobPosting)) {
            // set the owning side to null (unless already changed)
            if ($jobPosting->getRecruiter() === $this) {
                $jobPosting->setRecruiter(null);
            }
        }

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