<?php

namespace App\Application\DTOs\Offer;

class OfferDTO
{
    /**
     * @param int $id
     * @param string $mark
     * @param string $model
     * @param string $generation
     * @param int $year
     * @param int $run
     * @param string $color
     * @param string $body_type
     * @param string $engine_type
     * @param string $transmission
     * @param string $gear_type
     * @param int|null $generation_id
     */
    public function __construct(
        private readonly int     $id,
        private readonly string  $mark,
        private readonly string  $model,
        private readonly ?string $generation,
        private readonly int     $year,
        private readonly int     $run,
        private readonly ?string $color,
        private readonly ?string $body_type,
        private readonly ?string $engine_type,
        private readonly string  $transmission,
        private readonly ?string $gear_type,
        private readonly ?int    $generation_id
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getGeneration(): string|null
    {
        return $this->generation;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getRun(): int
    {
        return $this->run;
    }

    public function getColor(): string|null
    {
        return $this->color;
    }

    public function getBodyType(): string|null
    {
        return $this->body_type;
    }

    public function getEngineType(): string|null
    {
        return $this->engine_type;
    }

    public function getTransmission(): string
    {
        return $this->transmission;
    }

    public function getGearType(): string|null
    {
        return $this->gear_type;
    }

    public function getGenerationId(): int|null
    {
        return $this->generation_id;
    }
}
