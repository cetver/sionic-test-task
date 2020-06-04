<?php declare(strict_types=1);

namespace App\Command;

use App\Dto\ImportDto;
use App\Dto\ItemDto;
use App\Dto\OfferDto;
use App\Entity\ItemEntity;
use App\Serializer\Encoder\XmlReaderEncoder;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\SerializerInterface;
use function iter\chunk;

class InsertDataCommand extends Command
{
    use LockableTrait;

    protected static $defaultName = 'app:insert-data';
    /**
     * @var Finder
     */
    private Finder $finder;
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(
        Finder $finder,
        SerializerInterface $serializer,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager
    )
    {
        $this->finder = $finder;
        $this->serializer = $serializer;
        $this->logger = $logger;
        $this->entityManager = $entityManager;
        parent::__construct(static::$defaultName);
    }

    protected function configure()
    {
        $this
            ->addArgument('basedir', InputArgument::OPTIONAL, '', 'var/data');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $this->logger->error('The command is already running in another process');

            return 1;
        }

        $baseDir = $input->getArgument('basedir');
        $data = [];

        $finder = $this->finder::create();
        $finder->files()->in($baseDir)->name('import*.xml');
        foreach ($finder as $file) {
            $this->logger->info("Processing the '$file' file");
            $importCollection = $this->serializer->deserialize(
                $file,
                ImportDto::class,
                XmlReaderEncoder::FORMAT
            );
            /** @var ImportDto[] $importCollection */
            foreach ($importCollection as $importDto) {
                $interchangeabilityDto = $importDto->getInterchangeabilityDto();
                $interchangeabilityArr = array_filter(
                    [
                        $interchangeabilityDto->getVendor(),
                        $interchangeabilityDto->getModel(),
                        $interchangeabilityDto->getCategory(),
                    ]
                );
                $code = $importDto->getCode();
                $data[$code] = [
                    'name' => $importDto->getName(),
                    'weight' => $importDto->getWeight(),
                    'usage' => implode('|', $interchangeabilityArr),
                ];
            }
        }

        $finder = $this->finder::create();
        $finder->files()->in($baseDir)->name('offers*.xml');
        foreach ($finder as $file) {
            $this->logger->info("Processing the '$file' file");
            $offerCollection = $this->serializer->deserialize(
                $file,
                OfferDto::class,
                XmlReaderEncoder::FORMAT
            );
            /** @var OfferDto[] $offerCollection */
            foreach ($offerCollection as $offerDto) {
                $code = $offerDto->getCode();
                $classifier = $offerDto->getClassifier();
                $data[$code]['quantities'][$classifier] = $offerDto->getQuantity();
                $data[$code]['prices'][$classifier] = $offerDto->getPrice();
            }
        }

        $itemCollection = new \ArrayIterator();
        foreach ($data as $code => $item) {
            $name = $item['name'];
            $weight = $item['weight'];
            $usage = $item['usage'];
            $quantityMoskva = $item['quantities']['Москва'] ?? 0;
            $quantitySanktPeterburg = $item['quantities']['Санкт-Петербург'] ?? 0;
            $quantitySamara = $item['quantities']['Самара'] ?? 0;
            $quantitySaratov = $item['quantities']['Саратов'] ?? 0;
            $quantityKazani = $item['quantities']['Казань'] ?? 0;
            $quantityNovosibirsk = $item['quantities']['Новосибирск'] ?? 0;
            $quantityChelyabinsk = $item['quantities']['Челябинск'] ?? 0;
            $quantityDelovyyeLiniiChelyabinsk = $item['quantities']['Деловые линии Челябинск'] ?? 0;
            $priceMoskva = $item['prices']['Москва'] ?? 0;
            $priceSanktPeterburg = $item['prices']['Санкт-Петербург'] ?? 0;
            $priceSamara = $item['prices']['Самара'] ?? 0;
            $priceSaratov = $item['prices']['Саратов'] ?? 0;
            $priceKazani = $item['prices']['Казань'] ?? 0;
            $priceNovosibirsk = $item['prices']['Новосибирск'] ?? 0;
            $priceChelyabinsk = $item['prices']['Челябинск'] ?? 0;
            $priceDelovyyeLiniiChelyabinsk = $item['prices']['Деловые линии Челябинск'] ?? 0;
            $itemDto = new ItemDto(
                $name,
                $code,
                $weight,
                $usage,
                $quantityMoskva,
                $quantitySanktPeterburg,
                $quantitySamara,
                $quantitySaratov,
                $quantityKazani,
                $quantityNovosibirsk,
                $quantityChelyabinsk,
                $quantityDelovyyeLiniiChelyabinsk,
                $priceMoskva,
                $priceSanktPeterburg,
                $priceSamara,
                $priceSaratov,
                $priceKazani,
                $priceNovosibirsk,
                $priceChelyabinsk,
                $priceDelovyyeLiniiChelyabinsk
            );
            $itemCollection->append($itemDto);
        }
        $this->logger->info("Attempt to insert '{$itemCollection->count()}' rows");

        $insertedRows = 0;
        $processedRows = 0;
        /** @var \App\Repository\ItemRepository $repository */
        $repository = $this->entityManager->getRepository(ItemEntity::class);
        foreach (chunk($itemCollection, 300) as $items) {
            $processedRows += count($items);
            $this->logger->info("Processing the '$processedRows' rows");
            $insertedRows += $repository->createFromItemDtoCollection($items);
        }
        $this->logger->info("Inserted '$insertedRows' rows");

        return 0;
    }
}
