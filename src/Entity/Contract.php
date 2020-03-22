<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractRepository")
 */
class Contract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractState", inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContractHistory", mappedBy="contract")
     */
    private $history;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContractOption")
     */
    private $options;

    /**
     * @ORM\Column(type="integer")
     */
    private $days;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $daysExtension;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $optionsAmount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractPlace", inversedBy="contracts")
     */
    private $placeDelivery;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractPlace", inversedBy="contracts")
     */
    private $placeRecovery;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDelivery;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotaleHt;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotaleTtc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="contracts")
     */
    private $clients;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $carDaysAmount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amountTotaleTtcAfterDiscount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amountTotale;

    public function __construct()
    {
        $this->history = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getState(): ?ContractState
    {
        return $this->state;
    }

    public function setState(?ContractState $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|ContractHistory[]
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(ContractHistory $history): self
    {
        if (!$this->history->contains($history)) {
            $this->history[] = $history;
            $history->setContract($this);
        }

        return $this;
    }

    public function removeHistory(ContractHistory $history): self
    {
        if ($this->history->contains($history)) {
            $this->history->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getContract() === $this) {
                $history->setContract(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContractOption[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(ContractOption $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(ContractOption $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
        }

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getDaysExtension(): ?int
    {
        return $this->daysExtension;
    }

    public function setDaysExtension(?int $daysExtension): self
    {
        $this->daysExtension = $daysExtension;

        return $this;
    }

    public function getOptionsAmount(): ?float
    {
        return $this->optionsAmount;
    }

    public function setOptionsAmount(?float $optionsAmount): self
    {
        $this->optionsAmount = $optionsAmount;

        return $this;
    }

    public function getPlaceDelivery(): ?ContractPlace
    {
        return $this->placeDelivery;
    }

    public function setPlaceDelivery(?ContractPlace $placeDelivery): self
    {
        $this->placeDelivery = $placeDelivery;

        return $this;
    }

    public function getPlaceRecovery(): ?ContractPlace
    {
        return $this->placeRecovery;
    }

    public function setPlaceRecovery(?ContractPlace $placeRecovery): self
    {
        $this->placeRecovery = $placeRecovery;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->dateDelivery;
    }

    public function setDateDelivery(\DateTimeInterface $dateDelivery): self
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    public function getAmountTotaleHt(): ?float
    {
        return $this->amountTotaleHt;
    }

    public function setAmountTotaleHt(float $amountTotaleHt): self
    {
        $this->amountTotaleHt = $amountTotaleHt;

        return $this;
    }

    public function getAmountTotaleTtc(): ?float
    {
        return $this->amountTotaleTtc;
    }

    public function setAmountTotaleTtc(float $amountTotaleTtc): self
    {
        $this->amountTotaleTtc = $amountTotaleTtc;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(?int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
        }

        return $this;
    }

    public function getCarDaysAmount(): ?float
    {
        return $this->carDaysAmount;
    }

    public function setCarDaysAmount(?float $carDaysAmount): self
    {
        $this->carDaysAmount = $carDaysAmount;

        return $this;
    }

    public function getAmountTotaleTtcAfterDiscount(): ?float
    {
        return $this->amountTotaleTtcAfterDiscount;
    }

    public function setAmountTotaleTtcAfterDiscount(?float $amountTotaleTtcAfterDiscount): self
    {
        $this->amountTotaleTtcAfterDiscount = $amountTotaleTtcAfterDiscount;

        return $this;
    }

    public function getAmountTotale(): ?float
    {
        return $this->amountTotale;
    }

    public function setAmountTotale(?float $amountTotale): self
    {
        $this->amountTotale = $amountTotale;

        return $this;
    }
}
