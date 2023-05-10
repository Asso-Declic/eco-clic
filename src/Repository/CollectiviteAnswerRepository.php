<?php

namespace App\Repository;

use App\Entity\CollectiviteAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CollectiviteAnswer>
 *
 * @method CollectiviteAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectiviteAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectiviteAnswer[]    findAll()
 * @method CollectiviteAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectiviteAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectiviteAnswer::class);
    }

    public function save(CollectiviteAnswer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CollectiviteAnswer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CollectiviteAnswer[] Returns an array of CollectiviteAnswer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CollectiviteAnswer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
