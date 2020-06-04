<?php declare(strict_types=1);

namespace App\Factory;

/**
 * The "XmlReaderFactory" class
 */
class XmlReaderFactory 
{
    public function create(): \XMLReader
    {
        return new \XMLReader();
    }
}