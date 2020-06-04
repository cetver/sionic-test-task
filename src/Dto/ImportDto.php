<?php declare(strict_types=1);

namespace App\Dto;

/**
 * The "ImportDto" class
 */
final class ImportDto
{
    private string $name;
    private int $code;
    private int $weight;
    /**
     * @var InterchangeabilityDto
     */
    private InterchangeabilityDto $interchangeabilityDto;

    public function __construct(
        string $name,
        int $code,
        int $weight,
        InterchangeabilityDto $interchangeabilityDto
    )
    {
        $this->name = $name;
        $this->code = $code;
        $this->weight = $weight;
        $this->interchangeabilityDto = $interchangeabilityDto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return InterchangeabilityDto
     */
    public function getInterchangeabilityDto(): InterchangeabilityDto
    {
        return $this->interchangeabilityDto;
    }
}