<?php

namespace App\Repository;

use App\Entity\RecommandationLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationLevel>
 *
 * @method RecommandationLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationLevel[]    findAll()
 * @method RecommandationLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationLevel::class);
    }

    public function save(RecommandationLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecommandationLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
