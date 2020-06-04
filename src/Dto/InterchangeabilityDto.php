<?php declare(strict_types=1);

namespace App\Dto;

/**
 * The "InterchangeabilityDto" class
 */
final class InterchangeabilityDto
{
    private string $vendor;
    private string $model;
    private string $category;

    public function __construct(string $vendor, string $model, string $category)
    {
        $this->vendor = $vendor;
        $this->model = $model;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}