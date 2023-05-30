<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
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

    public function findByQuestion(Collectivite $collectivite, Question $question)
    {
        /* Requête d'origine
            SELECT utilisateurReponse.Id, utilisateurReponse.IdReponse, utilisateurReponse.InputText, utilisateurReponse.IdQuestion
            FROM `utilisateurReponse`
            WHERE utilisateurReponse.IdQuestion = :IdQuestion 
            AND utilisateurReponse.CollectiviteId = :CollectiviteId
        */
        $qb = $this->createQueryBuilder('ca')
        ->innerJoin('ca.answer', 'a')
        ->where('ca.collectivite = :collectivite')
        ->andWhere('a.question = :question')
        ->setParameter('collectivite', $collectivite)
        ->setParameter('question', $question)
        ;

        return $qb->getQuery()->getResult();
    }
    
    public function findProgression(Collectivite $collectivite)
    {
        /* Requête d'origine
            SELECT
                categorie.Id as CategorieId,
                utilisateurReponse.CollectiviteId as UtilisateurId,
                count(DISTINCT(utilisateurReponse.IdQuestion)) as NbRepondu
            FROM `utilisateurReponse` 
            INNER JOIN question
            INNER JOIN categorie
            WHERE utilisateurReponse.IdQuestion = question.Id
            AND question.IdCategorie = categorie.Id
            AND utilisateurReponse.CollectiviteId = :CollectiviteId
            GROUP BY categorie.Id
        */
        $qb = $this->createQueryBuilder('collectiviteAnswer');
        $qb->select('c.id category_id')
        ->addSelect($qb->expr()->countDistinct('c.id') . ' AS nb_repondu')
        ->from('App\Entity\Collectivite', 'coll')
        ->innerJoin('coll.collectiviteAnswers', 'ca')
        ->innerJoin('ca.answer', 'a')
        ->innerJoin('a.question', 'q')
        ->innerJoin('q.category', 'c')
        ->where('ca.collectivite = :collectivite')
        ->groupBy('c.id')
        ->setParameter('collectivite', $collectivite);
        return $qb->getQuery()->getScalarResult();
    }

    public function findProgressionByCategory(Category $category, Collectivite $collectivite)
    {
        /* Requête d'origine
            SELECT categorie.Id as CategorieId, utilisateurReponse.CollectiviteId as UtilisateurId, count(DISTINCT(utilisateurReponse.IdQuestion)) as NbRepondu
            FROM `utilisateurReponse` 
            INNER JOIN question
            INNER JOIN categorie
            WHERE utilisateurReponse.IdQuestion = question.Id
            AND question.IdCategorie = categorie.Id
            AND utilisateurReponse.CollectiviteId = :CollectiviteId
            AND categorie.Id = :CategId
            GROUP BY categorie.Id
        */
        $qb = $this->createQueryBuilder('ca');
        $qb->select('c.id category_id')
            ->addSelect($qb->expr()->countDistinct('c.id') . ' AS nb_repondu')
            ->innerJoin('ca.answer', 'a')
            ->innerJoin('a.question', 'q')
            ->innerJoin('q.category', 'c')
            ->where('ca.collectivite = :collectivite')
            ->andWhere('c = :category')
            ->setParameter('collectivite', $collectivite)
            ->setParameter('category', $category)
            ->groupBy('c.id') 
            ;
        return $qb->getQuery()->getScalarResult();
    }

    public function findScore(Collectivite $collectivite)
    {
        /* Requête d'origine
            SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
            FROM `reponse`, `utilisateurReponse` 
            WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
            AND utilisateurReponse.IdReponse = reponse.Id
        */
        $qb = $this->createQueryBuilder('ca')
        ->select('SUM(a.ponderation) AS score')
        ->addSelect('COUNT(a.ponderation) AS nb')
        ->innerJoin('ca.answer', 'a')
        ->where('ca.collectivite = :collectivite')
        ->setParameter('collectivite', $collectivite);
        return $qb->getQuery()->getResult();
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
