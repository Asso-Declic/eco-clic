<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    
    public function findInfos()
    {
        /* Requête d'origine
        SELECT categorie.Id, categorie.Nom, categorie.Img, COUNT(question.IdCategorie) as nbQuestion, 
                (
                    SELECT COUNT(recommandation.IdCategorie) FROM `recommandation` where recommandation.IdCategorie = categorie.Id
                ) as nbReco
        FROM `categorie`
        INNER JOIN `question`
        WHERE question.IdCategorie = categorie.Id 
        GROUP BY question.IdCategorie // C'était sûrement erroné non ?
        Order by categorie.Ordre
        */
        $qb = $this->createQueryBuilder('c')
        ->innerJoin('c.questions', 'q')
        ->addSelect('COUNT(q.id) as nbQuestion')
        ->groupBy('c.id')
        ->orderBy('c.sortOrder')
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function save(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Category[] Returns an array of Category objects
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

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
