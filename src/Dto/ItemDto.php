<?php declare(strict_types=1);

namespace App\Dto;

/**
 * The "ImportDto" class
 */
final class ItemDto
{
    private string $name;
    private int $code;
    private int $weight;
    private string $usage;
    private int $quantityMoskva;
    private int $quantitySanktPeterburg;
    private int $quantitySamara;
    private int $quantitySaratov;
    private int $quantityKazani;
    private int $quantityNovosibirsk;
    private int $quantityChelyabinsk;
    private int $quantityDelovyyeLiniiChelyabinsk;
    private int $priceMoskva;
    private int $priceSanktPeterburg;
    private int $priceSamara;
    private int $priceSaratov;
    private int $priceKazani;
    private int $priceNovosibirsk;
    private int $priceChelyabinsk;
    private int $priceDelovyyeLiniiChelyabinsk;

    public function __construct(
        string $name,
        int $code,
        int $weight,
        string $usage,
        int $quantityMoskva,
        int $quantitySanktPeterburg,
        int $quantitySamara,
        int $quantitySaratov,
        int $quantityKazani,
        int $quantityNovosibirsk,
        int $quantityChelyabinsk,
        int $quantityDelovyyeLiniiChelyabinsk,
        int $priceMoskva,
        int $priceSanktPeterburg,
        int $priceSamara,
        int $priceSaratov,
        int $priceKazani,
        int $priceNovosibirsk,
        int $priceChelyabinsk,
        int $priceDelovyyeLiniiChelyabinsk
    )
    {
        $this->name = $name;
        $this->code = $code;
        $this->weight = $weight;
        $this->usage = $usage;
        $this->quantityMoskva = $quantityMoskva;
        $this->quantitySanktPeterburg = $quantitySanktPeterburg;
        $this->quantitySamara = $quantitySamara;
        $this->quantitySaratov = $quantitySaratov;
        $this->quantityKazani = $quantityKazani;
        $this->quantityNovosibirsk = $quantityNovosibirsk;
        $this->quantityChelyabinsk = $quantityChelyabinsk;
        $this->quantityDelovyyeLiniiChelyabinsk = $quantityDelovyyeLiniiChelyabinsk;
        $this->priceMoskva = $priceMoskva;
        $this->priceSanktPeterburg = $priceSanktPeterburg;
        $this->priceSamara = $priceSamara;
        $this->priceSaratov = $priceSaratov;
        $this->priceKazani = $priceKazani;
        $this->priceNovosibirsk = $priceNovosibirsk;
        $this->priceChelyabinsk = $priceChelyabinsk;
        $this->priceDelovyyeLiniiChelyabinsk = $priceDelovyyeLiniiChelyabinsk;
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
     * @return string
     */
    public function getUsage(): string
    {
        return $this->usage;
    }

    /**
     * @return int
     */
    public function getQuantityMoskva(): int
    {
        return $this->quantityMoskva;
    }

    /**
     * @return int
     */
    public function getQuantitySanktPeterburg(): int
    {
        return $this->quantitySanktPeterburg;
    }

    /**
     * @return int
     */
    public function getQuantitySamara(): int
    {
        return $this->quantitySamara;
    }

    /**
     * @return int
     */
    public function getQuantitySaratov(): int
    {
        return $this->quantitySaratov;
    }

    /**
     * @return int
     */
    public function getQuantityKazani(): int
    {
        return $this->quantityKazani;
    }

    /**
     * @return int
     */
    public function getQuantityNovosibirsk(): int
    {
        return $this->quantityNovosibirsk;
    }

    /**
     * @return int
     */
    public function getQuantityChelyabinsk(): int
    {
        return $this->quantityChelyabinsk;
    }

    /**
     * @return int
     */
    public function getQuantityDelovyyeLiniiChelyabinsk(): int
    {
        return $this->quantityDelovyyeLiniiChelyabinsk;
    }

    /**
     * @return int
     */
    public function getPriceMoskva(): int
    {
        return $this->priceMoskva;
    }

    /**
     * @return int
     */
    public function getPriceSanktPeterburg(): int
    {
        return $this->priceSanktPeterburg;
    }

    /**
     * @return int
     */
    public function getPriceSamara(): int
    {
        return $this->priceSamara;
    }

    /**
     * @return int
     */
    public function getPriceSaratov(): int
    {
        return $this->priceSaratov;
    }

    /**
     * @return int
     */
    public function getPriceKazani(): int
    {
        return $this->priceKazani;
    }

    /**
     * @return int
     */
    public function getPriceNovosibirsk(): int
    {
        return $this->priceNovosibirsk;
    }

    /**
     * @return int
     */
    public function getPriceChelyabinsk(): int
    {
        return $this->priceChelyabinsk;
    }

    /**
     * @return int
     */
    public function getPriceDelovyyeLiniiChelyabinsk(): int
    {
        return $this->priceDelovyyeLiniiChelyabinsk;
    }
}