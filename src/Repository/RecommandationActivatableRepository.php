<?php

namespace App\Repository;

use App\Entity\RecommandationActivatable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationActivatable>
 *
 * @method RecommandationActivatable|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationActivatable|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationActivatable[]    findAll()
 * @method RecommandationActivatable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationActivatableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationActivatable::class);
    }

//    /**
//     * @return RecommandationActivatable[] Returns an array of RecommandationActivatable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RecommandationActivatable
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
