<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 * 
 * @ORM\Table(name="module",uniqueConstraints={
 * @ORM\UniqueConstraint(name="name_unique", columns={"name"})})
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $temperature;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $uptime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dataSent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayTemperature;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayUptime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayDataSent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="moduleHistory", cascade={"persist"}, orphanRemoval=true)
     */
    private $histories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
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
        $this->createHistory('Nom', $this->name, $name);
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->createHistory('Description', $this->description, $description);
        $this->description = $description;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->createHistory('Actif', (int)$this->active, (int)$active);
        $this->active = $active;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(?int $temperature): self
    {
        $this->createHistory('Température', (int)$this->temperature, (int)$temperature);
        $this->temperature = $temperature;

        return $this;
    }

    public function getUptime(): ?int
    {
        return $this->uptime;
    }

    public function setUptime(?int $uptime): self
    {
        $this->createHistory('Durée de fonctionnement', (int)$this->uptime, (int)$uptime);
        $this->uptime = $uptime;

        return $this;
    }

    public function getDataSent(): ?int
    {
        return $this->dataSent;
    }

    public function setDataSent(?int $dataSent): self
    {
        $this->createHistory('Données envoyées', (int)$this->dataSent, (int)$dataSent);
        $this->dataSent = $dataSent;

        return $this;
    }

    public function getDisplayActive(): ?bool
    {
        return $this->displayActive;
    }

    public function setDisplayActive(bool $displayActive): self
    {
        $this->displayActive = $displayActive;

        return $this;
    }

    public function getDisplayTemperature(): ?bool
    {
        return $this->displayTemperature;
    }

    public function setDisplayTemperature(bool $displayTemperature): self
    {
        $this->displayTemperature = $displayTemperature;

        return $this;
    }

    public function getDisplayUptime(): ?bool
    {
        return $this->displayUptime;
    }

    public function setDisplayUptime(bool $displayUptime): self
    {
        $this->displayUptime = $displayUptime;

        return $this;
    }

    public function getDisplayDataSent(): ?bool
    {
        return $this->displayDataSent;
    }

    public function setDisplayDataSent(bool $displayDataSent): self
    {
        $this->displayDataSent = $displayDataSent;

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories[] = $history;
            $history->setModuleHistory($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->contains($history)) {
            $this->histories->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getModuleHistory() === $this) {
                $history->setModuleHistory(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function createHistory($property, $oldValue, $newValue)
    {
        $history = new History();
        $history->setProperty($property);
        $history->setOldValue($oldValue);
        $history->setNewValue($newValue);

        $this->addHistory($history);

        return $this;
    }
}
