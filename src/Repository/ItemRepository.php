<?php

namespace App\Repository;

use App\Dto\ItemDto;
use App\Entity\ItemEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
use function iter\filter;
use function iter\map;
use function iter\toArray;

/**
 * @method ItemEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemEntity[]    findAll()
 * @method ItemEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemEntity::class);
    }

    public function paginationQuery()
    {
        return $this->createQueryBuilder('i')
                    ->orderBy('i.id', 'DESC')
                    ->getQuery();
    }

    public function findExistingCodes(iterable $codes): array
    {
        $existingCodes = $this->getEntityManager()
                              ->getConnection()
                              ->executeQuery(
                                  'SELECT code FROM items WHERE code IN (:codes)',
                                  ['codes' => toArray($codes)],
                                  ['codes' => Connection::PARAM_INT_ARRAY]
                              )
                              ->fetchAll(\PDO::FETCH_COLUMN);

        return array_combine($existingCodes, $existingCodes);
    }

    public function createFromItemDtoCollection(iterable $collection): int
    {
        $insertedRows = 0;

        $codes = map(
            function (ItemDto $dto) {
                return $dto->getCode();
            },
            $collection
        );
        $existingCodes = $this->findExistingCodes($codes);
        /** @var ItemDto[] $itemsToInsert */
        $itemsToInsert = filter(
            function (ItemDto $dto) use ($existingCodes) {
                return !isset($existingCodes[$dto->getCode()]);
            },
            $collection
        );
        $entityManager = $this->getEntityManager();
        foreach ($itemsToInsert as $item) {
            $entity = new ItemEntity(
                $item->getName(),
                $item->getCode(),
                $item->getWeight(),
                $item->getUsage(),
                $item->getQuantityMoskva(),
                $item->getQuantitySanktPeterburg(),
                $item->getQuantitySamara(),
                $item->getQuantitySaratov(),
                $item->getQuantityKazani(),
                $item->getQuantityNovosibirsk(),
                $item->getQuantityChelyabinsk(),
                $item->getQuantityDelovyyeLiniiChelyabinsk(),
                $item->getPriceMoskva(),
                $item->getPriceSanktPeterburg(),
                $item->getPriceSamara(),
                $item->getPriceSaratov(),
                $item->getPriceKazani(),
                $item->getPriceNovosibirsk(),
                $item->getPriceChelyabinsk(),
                $item->getPriceDelovyyeLiniiChelyabinsk()
            );
            $entityManager->persist($entity);
            $insertedRows++;
        }
        $entityManager->flush();
        $entityManager->clear();

        return $insertedRows;
    }
}
