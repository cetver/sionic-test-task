<?php

namespace App\Serializer\Normalizer;

use App\Dto\OfferDto;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class OfferDtoNormalizer implements ContextAwareDenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return $type === OfferDto::class;
    }

    /**
     * @inheritDoc
     * @return OfferDto[]|\Generator
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        /**
         * @var \XMLReader $data
         * @var \DOMElement $node
         * @var \DOMElement $interchangeabilityNode
         */
        $classifier = '';
        while ($data->read()) {
            if ($data->localName === 'Классификатор') {
                $node = $data->expand();
                $classifierNode = $node->getElementsByTagName('Наименование')->item(0);
                if ($classifierNode !== null) {
                    preg_match('/\((.*)\)/', $classifierNode->nodeValue, $matches);
                    $classifier = $matches[1];
                    break;
                }
            }
        }

        $offerTag = 'Предложение';
        while ($data->read()) {
            while ($data->localName === $offerTag) {
                $code = 0;
                $price = 0;
                $quantity = 0;

                $node = $data->expand();

                $codeNode = $node->getElementsByTagName('Код')->item(0);
                if ($codeNode !== null) {
                    $code = (int)$codeNode->nodeValue;
                }

                $priceNode = $node->getElementsByTagName('ЦенаЗаЕдиницу')->item(0);
                if ($priceNode !== null) {
                    $price = (int)$priceNode->nodeValue;
                }

                $quantityNode = $node->getElementsByTagName('Количество')->item(0);
                if ($quantityNode !== null) {
                    $quantity = (int)$quantityNode->nodeValue;
                }

                yield new OfferDto($classifier, $code, $price, $quantity);

                $data->next($offerTag);
            }
        }
    }
}
