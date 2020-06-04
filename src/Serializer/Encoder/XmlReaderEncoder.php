<?php

namespace App\Serializer\Encoder;

use App\Factory\XmlReaderFactory;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class XmlReaderEncoder implements DecoderInterface
{
    const FORMAT = 'xml';

    private \XMLReader $reader;

    public function __construct(XmlReaderFactory $xmlReaderFactory)
    {
        $this->reader = $xmlReaderFactory->create();
    }

    public function __destruct()
    {
        $this->reader->close();
    }

    public function decode($data, $format, array $context = [])
    {
        $this->reader->open($data);

        return $this->reader;
    }

    public function supportsDecoding($format): bool
    {
        return self::FORMAT === $format;
    }
}
