<?php

namespace App\Repository;

use App\Entity\RecommandationPerso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationPerso>
 *
 * @method RecommandationPerso|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationPerso|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationPerso[]    findAll()
 * @method RecommandationPerso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationPersoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationPerso::class);
    }

//    /**
//     * @return RecommandationPerso[] Returns an array of RecommandationPerso objects
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

//    public function findOneBySomeField($value): ?RecommandationPerso
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function delete($collectivite, $question)
    {
        $qb = $this->createQueryBuilder('r')
            ->delete()
            ->where('r.Collectivite = :collectivite')
            ->andWhere('r.question = :question')
            ->setParameter('collectivite', $collectivite)
            ->setParameter('question', $question)
        ;

        return $qb->getQuery()->getResult();
    }
}
