<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use App\Entity\RecommandationCustom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationCustom>
 *
 * @method RecommandationCustom|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationCustom|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationCustom[]    findAll()
 * @method RecommandationCustom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationCustomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationCustom::class);
    }

    public function findByCategoryWithQuestions(Category $category, Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('rc')
            ->select('rc, q, r')
            ->leftJoin('rc.question', 'q')
            ->leftJoin('rc.recommandation', 'r')
            ->where('q.category = :category')
            ->andWhere('rc.collectivite = :collectivite')
            ->setParameter('category', $category)
            ->setParameter('collectivite', $collectivite)
            ->groupBy('q.id')
            ->orderBy('q.sortOrder', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function delete($collectivite, $question)
    {
        $qb = $this->createQueryBuilder('rc')
            ->delete()
            ->where('rc.collectivite = :collectivite')
            ->andWhere('rc.question = :question')
            ->setParameter('collectivite', $collectivite)
            ->setParameter('question', $question)
        ;

        return $qb->getQuery()->getResult();
    }
}
