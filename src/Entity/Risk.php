<?php

namespace App\Entity;

use App\Repository\RiskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RiskRepository::class)]
class Risk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'date')]
    private $identificationDate;

    #[ORM\Column(type: 'date')]
    private $resolutionDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $severity;

    #[ORM\Column(type: 'float')]
    private $probability;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'risks')]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private $project;

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

    public function getIdentificationDate(): ?\DateTimeInterface
    {
        return $this->identificationDate;
    }

    public function setIdentificationDate(\DateTimeInterface $identificationDate): self
    {
        $this->identificationDate = $identificationDate;

        return $this;
    }

    public function getResolutionDate(): ?\DateTimeInterface
    {
        return $this->resolutionDate;
    }

    public function setResolutionDate(\DateTimeInterface $resolutionDate): self
    {
        $this->resolutionDate = $resolutionDate;

        return $this;
    }

    public function getSeverity(): ?string
    {
        return $this->severity;
    }

    public function setSeverity(string $severity): self
    {
        $this->severity = $severity;

        return $this;
    }

    public function getProbability(): ?float
    {
        return $this->probability;
    }

    public function setProbability(float $probability): self
    {
        $this->probability = $probability;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
