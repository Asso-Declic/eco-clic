<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
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
            ->select('rc, q')
            ->leftJoin('rc.questions', 'q')
            ->leftJoin('q.answers', 'a')
            ->leftJoin('a.collectiviteAnswers', 'ca')
            
            ->where('rc.category = :category')
            ->andWhere('c = :collectivite')
            ->setParameter('category', $category)
            ->setParameter('ca.collectivite', $collectivite)
            ->orderBy('rc.id', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
