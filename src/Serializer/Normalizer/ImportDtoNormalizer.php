<?php

namespace App\Serializer\Normalizer;

use App\Dto\ImportDto;
use App\Dto\InterchangeabilityDto;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class ImportDtoNormalizer implements ContextAwareDenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return $type === ImportDto::class;
    }

    /**
     * @inheritDoc
     * @return ImportDto[]|\Generator
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        /**
         * @var \XMLReader $data
         * @var \DOMElement $node
         * @var \DOMElement $interchangeabilityNode
         */
        $itemTag = 'Товар';
        while ($data->read()) {
            while ($data->localName === $itemTag) {
                $name = '';
                $code = 0;
                $weight = 0;
                $interchangeabilityVendor = '';
                $interchangeabilityModel = '';
                $interchangeabilityCategory = '';

                $node = $data->expand();

                $nameNode = $node->getElementsByTagName('Наименование')->item(0);
                if ($nameNode !== null) {
                    $name = $nameNode->nodeValue;
                }

                $codeNode = $node->getElementsByTagName('Код')->item(0);
                if ($codeNode !== null) {
                    $code = (int)$codeNode->nodeValue;
                }

                $weightNode = $node->getElementsByTagName('Вес')->item(0);
                if ($weightNode !== null) {
                    $weight = (int)$weightNode->nodeValue;
                }

                $interchangeabilityNode = $node->getElementsByTagName('Взаимозаменяемость')->item(0);
                if ($interchangeabilityNode !== null) {
                    $interchangeabilityNodeVendor = $interchangeabilityNode
                        ->getElementsByTagName('Марка')
                        ->item(0);
                    if ($interchangeabilityNodeVendor !== null) {
                        $interchangeabilityVendor = $interchangeabilityNodeVendor->nodeValue;
                    }

                    $interchangeabilityNodeModel = $interchangeabilityNode
                        ->getElementsByTagName('Модель')
                        ->item(0);
                    if ($interchangeabilityNodeModel !== null) {
                        $interchangeabilityModel = $interchangeabilityNodeModel->nodeValue;
                    }

                    $interchangeabilityNodeCategory = $interchangeabilityNode
                        ->getElementsByTagName('КатегорияТС')
                        ->item(0);
                    if ($interchangeabilityNodeCategory !== null) {
                        $interchangeabilityCategory = $interchangeabilityNodeCategory->nodeValue;
                    }
                }

                $interchangeabilityDto = new InterchangeabilityDto(
                    $interchangeabilityVendor,
                    $interchangeabilityModel,
                    $interchangeabilityCategory
                );

                yield new ImportDto($name, $code, $weight, $interchangeabilityDto);

                $data->next($itemTag);
            }
        }
    }
}
