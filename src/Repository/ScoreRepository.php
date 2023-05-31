<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Collectivite;
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

    /**
     * Retourne le score d'une collectivité pour une catégorie
     *
     * @param Category $category
     * @param Collectivite $collectivite
     * @return array
     */
    public function findScoreForCategory(Category $category, Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
        FROM reponse
        JOIN question ON question.Id = reponse.IdQuestion
        JOIN categorie ON categorie.Id = question.IdCategorie
        JOIN utilisateurReponse ON utilisateurReponse.IdReponse = reponse.Id
        WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
        AND utilisateurReponse.IdReponse = reponse.Id
        AND categorie.Id = :CategorieId
        */
        $qb = $this->createQueryBuilder('s');
        $qb->select('SUM(a.ponderation) as score, COUNT(a.ponderation) as nb')
        ->from(Answer::class, 'a')
        ->join('a.question', 'q')
        ->join('q.category', 'c')
        ->join('a.collectiviteAnswers', 'ca')
        ->where('ca.collectivite = :collectivite')
        ->andWhere('ca.answer = a')
        ->andWhere('c = :category')
        ->setParameter('collectivite', $collectivite)
        ->setParameter('category', $category)
        ;
        return $qb->getQuery()->getScalarResult();
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

//    /**
//     * @return Score[] Returns an array of Score objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Score
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
