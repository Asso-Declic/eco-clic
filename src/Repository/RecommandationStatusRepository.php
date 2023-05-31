<?php

namespace App\Repository;

use App\Entity\RecommandationStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationStatus>
 *
 * @method RecommandationStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationStatus[]    findAll()
 * @method RecommandationStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationStatus::class);
    }

    public function save(RecommandationStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecommandationStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
