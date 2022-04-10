<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $code;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private $team;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private $clientTeam;

    #[ORM\ManyToOne(targetEntity: Status::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $status;

    #[ORM\Column(type: 'datetime')]
    private $startedAt;

    #[ORM\Column(type: 'datetime')]
    private $endedAt;

    #[ORM\OneToOne(targetEntity: Budget::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $budget;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Highlight::class)]
    private $highlight;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Risk::class)]
    private $risks;

    #[ORM\Column(type: 'boolean')]
    private $isArchived;

    #[ORM\ManyToOne(targetEntity: Portfolio::class, inversedBy: 'projects')]
    private $portfolio;

    public function __construct()
    {
        $this->highlight = new ArrayCollection();
        $this->risks = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getClientTeam(): ?Team
    {
        return $this->clientTeam;
    }

    public function setClientTeam(?Team $clientTeam): self
    {
        $this->clientTeam = $clientTeam;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTime
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTime $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getBudget(): ?Budget
    {
        return $this->budget;
    }

    public function setBudget(Budget $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return Collection<int, Highlight>
     */
    public function getHighlight(): Collection
    {
        return $this->highlight;
    }

    public function addHighlight(Highlight $highlight): self
    {
        if (!$this->highlight->contains($highlight)) {
            $this->highlight[] = $highlight;
            $highlight->setProject($this);
        }

        return $this;
    }

    public function removeHighlight(Highlight $highlight): self
    {
        if ($this->highlight->removeElement($highlight)) {
            // set the owning side to null (unless already changed)
            if ($highlight->getProject() === $this) {
                $highlight->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Risk>
     */
    public function getRisks(): Collection
    {
        return $this->risks;
    }

    public function addRisk(Risk $risk): self
    {
        if (!$this->risks->contains($risk)) {
            $this->risks[] = $risk;
            $risk->setProject($this);
        }

        return $this;
    }

    public function removeRisk(Risk $risk): self
    {
        if ($this->risks->removeElement($risk)) {
            // set the owning side to null (unless already changed)
            if ($risk->getProject() === $this) {
                $risk->setProject(null);
            }
        }

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getPortfolio(): ?Portfolio
    {
        return $this->portfolio;
    }

    public function setPortfolio(?Portfolio $portfolio): self
    {
        $this->portfolio = $portfolio;

        return $this;
    }

}
