<?php

namespace App\Repository;

use App\Entity\CollectiviteType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CollectiviteType>
 *
 * @method CollectiviteType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectiviteType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectiviteType[]    findAll()
 * @method CollectiviteType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectiviteTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectiviteType::class);
    }

    public function save(CollectiviteType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CollectiviteType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
