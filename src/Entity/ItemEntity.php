<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ORM\Table(
 *     name="items",
 *     schema="public",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="items_code_key",columns={"code"})
 *     }
 * )
 */
class ItemEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     */
    private int $code;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     */
    private int $weight;
    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $usage;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantityMoskva;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantitySanktPeterburg;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantitySamara;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantitySaratov;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantityKazani;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantityNovosibirsk;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantityChelyabinsk;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $quantityDelovyyeLiniiChelyabinsk;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceMoskva;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceSanktPeterburg;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceSamara;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceSaratov;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceKazani;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceNovosibirsk;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
    private int $priceChelyabinsk;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true, "default": 0})
     */
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
