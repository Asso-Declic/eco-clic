<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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

    public function deleteWithChildrenAnswers(Collectivite $collectivite, Question $question)
    {
        /* Requête d'origine
        DELETE FROM `utilisateurReponse` 
        WHERE IdQuestion = :IdQuestion 
        AND CollectiviteId = :CollectiviteId 
        OR IdQuestion IN (
            SELECT Id FROM question where IdParent = :IdQuestion3
            OR IdParent = (SELECT Id FROM question where IdParent = :IdQuestion4) 
            OR IdParent = (SELECT Id FROM question where IdParent = (SELECT Id FROM question where IdParent = :IdQuestion5)) 
            OR IdParent = (SELECT Id FROM question 
            where IdParent = (SELECT Id FROM question where IdParent = (SELECT Id FROM question where IdParent = :IdQuestion6))) 
            OR IdParent = (SELECT Id FROM question where IdParent = (SELECT Id FROM question where IdParent = :IdQuestion7)) 
            OR IdParent = (SELECT Id FROM question where IdParent = (SELECT Id FROM question 
            where IdParent = (SELECT Id FROM question where IdParent = (SELECT Id FROM question where IdParent = :IdQuestion8))))
        ) 
        AND CollectiviteId = :CollectiviteId2
        */
        $rsm = new ResultSetMapping();
        $qb = $this->getEntityManager()->createNativeQuery("
        DELETE ca.*
        FROM collectivite_answer As ca
        INNER JOIN answer ON answer.id = ca.answer_id
        WHERE (answer.question_id = :question_id 
        OR answer.question_id IN (
            SELECT id FROM question where parent_id = :question_id
            OR parent_id = (SELECT id FROM question where parent_id = :question_id) 
            OR parent_id = (SELECT id FROM question where parent_id = (SELECT id FROM question where parent_id = :question_id)) 
            OR parent_id = (SELECT id FROM question 
            where parent_id = (SELECT id FROM question where parent_id = (SELECT id FROM question where parent_id = :question_id))) 
            OR parent_id = (SELECT id FROM question where parent_id = (SELECT id FROM question where parent_id = :question_id)) 
            OR parent_id = (SELECT id FROM question where parent_id = (SELECT id FROM question 
            where parent_id = (SELECT id FROM question where parent_id = (SELECT id FROM question where parent_id = :question_id))))
        ))
        AND collectivite_id = :collectivite_id", $rsm)
        ->setParameter('question_id', $question->getId())
        ->setParameter('collectivite_id', $collectivite->getId())
        ;

        return $qb->getResult();

        /* Inspiration pour une optimisation de la requête
        WITH RECURSIVE answer_hierarchy AS (
        -- Anchor member: Select the answer you want to delete and its direct children
        SELECT answer_id, parent_id
        FROM answers
        WHERE answer_id = :answerId -- Replace :answerId with the ID of the answer you want to delete

        UNION ALL

        -- Recursive member: Select the children of the previous level
        SELECT a.answer_id, a.parent_id
        FROM answers a
        JOIN answer_hierarchy h ON a.parent_id = h.answer_id
        )
        DELETE FROM answers
        WHERE answer_id IN (
        SELECT answer_id
        FROM answer_hierarchy
        );
        */
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
        ->addSelect('a')
        ->innerJoin('ca.answer', 'a')
        ->where('ca.collectivite = :collectivite')
        ->andWhere('a.question = :question')
        ->setParameter('collectivite', $collectivite)
        ->setParameter('question', $question)
        ;

        return $qb->getQuery()->getResult();
    }
    
    public function findCollectiviteProgression(Collectivite $collectivite)
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
        ->addSelect($qb->expr()->countDistinct('ca.id') . ' AS nb_repondu')
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

    public function findCollectiviteProgressionByCategory(Category $category, Collectivite $collectivite)
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
            ->addSelect($qb->expr()->countDistinct('ca.id') . ' AS nb_repondu')
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

    /**
     * Retourne le score d'une collectivité
     *
     * @param Collectivite $collectivite
     * @return array
     */
    public function findCurrentScore(Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
        FROM `reponse`, `utilisateurReponse` 
        WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
        AND utilisateurReponse.IdReponse = reponse.Id
        */
        $qb = $this->createQueryBuilder('ca');
        $qb->select('SUM(a.ponderation) as score, COUNT(a.ponderation) as nb')
        ->innerJoin('ca.answer', 'a')
        ->where('ca.collectivite = :collectivite')
        ->setParameter('collectivite', $collectivite)
        ;

        return $qb->getQuery()->getScalarResult()[0];
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
        return $qb->getQuery()->getSingleResult();
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
}
