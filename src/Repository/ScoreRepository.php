<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\OPSN;
use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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

    public function findGroupAverage(array $collectiviteIds, $fieldName = 'moyenne')
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('moyenne', $fieldName);
        $rsm->addScalarResult('scored_at', 'scoredAt');

        $q = $this->getEntityManager()->createNativeQuery('
            SELECT CAST(AVG(score) as UNSIGNED) as moyenne, DATE(scored_at) as scored_at
            FROM score
            WHERE collectivite_id IN (:collectiviteIds)
            AND category_id IS NULL
            GROUP BY scored_at
            ', $rsm)
            ->setParameter('collectiviteIds', $collectiviteIds)
            ;
        
        return $q->getScalarResult();
    }

    public function findHistory(Collectivite $collectivite, ?Category $category = null)
    {
        $qb = $this->createQueryBuilder('s')
        ->select('s.score as score', 'DATE(s.scoredAt) as scoredAt',)
        ->where('s.collectivite = :collectivite')
        ->setParameter('collectivite', $collectivite)
        ->orderBy('s.scoredAt', 'ASC')
        ;

        if ($category != null) {
            $qb->andWhere('s.category = :category')
            ->setParameter('category', $category);
        } else {
            $qb->andWhere('s.category IS NULL');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Le calcul de la moyenne doit se faire sur les derniers scores enregistrés pour chaque collectivité.
     * Doctrine ne permet pas de faire une requête imbriquée en DQL, il faut donc passer par une requête native.
     * Attention, la moyenne ne prend pas en compte les collectivités qui n'ont pas encore de score.
     *
     * @param OPSN $opsn
     * @return string|null
     */
    public function findOpsnAverage(OPSN $opsn): ?string
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('moyenne', 'moyenne');

        $q = $this->getEntityManager()->createNativeQuery('
            SELECT avg(s1.score) as moyenne
            FROM score s1
            INNER JOIN (
                SELECT collectivite_id, MAX(scored_at) AS max_scored_at
                FROM score
                GROUP BY collectivite_id
            ) s2 ON s1.collectivite_id = s2.collectivite_id AND s1.scored_at = s2.max_scored_at
            INNER JOIN collectivite c ON c.id = s1.collectivite_id
            WHERE c.opsn_id = :opsn
            ', $rsm)
            ->setParameter('opsn', $opsn->getId())
            ;
        
        return $q->getSingleScalarResult() ?? '0';
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
