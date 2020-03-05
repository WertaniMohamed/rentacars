<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $serial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $prod_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gearbox;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fiscalPower;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Model", inversedBy="cars")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fuel", inversedBy="cars")
     */
    private $fuel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BodyType", inversedBy="cars")
     */
    private $bodyType;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): self
    {
        $this->serial = $serial;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getProdYear(): ?\DateTimeInterface
    {
        return $this->prod_year;
    }

    public function setProdYear(?\DateTimeInterface $prod_year): self
    {
        $this->prod_year = $prod_year;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(?string $gearbox): self
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getFiscalPower(): ?int
    {
        return $this->fiscalPower;
    }

    public function setFiscalPower(?int $fiscalPower): self
    {
        $this->fiscalPower = $fiscalPower;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getFuel(): ?Fuel
    {
        return $this->fuel;
    }

    public function setFuel(?Fuel $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getBodyType(): ?BodyType
    {
        return $this->bodyType;
    }

    public function setBodyType(?BodyType $bodyType): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

}
