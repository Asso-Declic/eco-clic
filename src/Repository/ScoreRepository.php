<?php

namespace App\Repository;

use App\Entity\OPSN;
use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Score>
 *
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function findByCollectiviteForOpsn(OPSN $opsn)
    {
        $qb = $this->createQueryBuilder('s')
            ->innerJoin('s.collectivite', 'c')
            ->where('c.opsn = :opsn')
            ->orderBy('c.name', 'ASC')
            ->addOrderBy('s.scoredAt', 'DESC')
            ->groupBy('s.collectivite')
            ->setParameter('opsn', $opsn)
            ;
        
        return $qb->getQuery()->getResult();
    }

    public function save(Score $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Score $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
