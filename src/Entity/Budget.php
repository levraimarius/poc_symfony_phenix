<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetRepository::class)]
class Budget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $initialValue;

    #[ORM\Column(type: 'float', nullable: true)]
    private $consumedValue;

    #[ORM\Column(type: 'float', nullable: true)]
    private $remaining;

    #[ORM\Column(type: 'float', nullable: true)]
    private $landing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitialValue(): ?float
    {
        return $this->initialValue;
    }

    public function setInitialValue(float $initialValue): self
    {
        $this->initialValue = $initialValue;

        return $this;
    }

    public function getConsumedValue(): ?float
    {
        return $this->consumedValue;
    }

    public function setConsumedValue(?float $consumedValue): self
    {
        $this->consumedValue = $consumedValue;

        return $this;
    }

    public function getRemaining(): ?float
    {
        return $this->remaining;
    }

    public function setRemaining(?float $remaining): self
    {
        $this->remaining = $remaining;

        return $this;
    }

    public function getLanding(): ?float
    {
        return $this->landing;
    }

    public function setLanding(?float $landing): self
    {
        $this->landing = $landing;

        return $this;
    }
}
