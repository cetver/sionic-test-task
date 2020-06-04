<?php declare(strict_types=1);

namespace App\Dto;

/**
 * The "ImportDto" class
 */
final class OfferDto
{
    private string $classifier;
    private int $code;
    private int $price;
    private int $quantity;

    public function __construct(
        string $classifier,
        int $code,
        int $price,
        int $quantity
    )
    {
        $this->classifier = $classifier;
        $this->code = $code;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getClassifier(): string
    {
        return $this->classifier;
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
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}