<?php

namespace App\Repository;

use App\Entity\Answer;
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
            OR parent_id IN (SELECT id FROM question where parent_id = :question_id) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :question_id)) 
            OR parent_id IN (SELECT id FROM question 
            where parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :question_id))) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :question_id)) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question 
            where parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :question_id))))
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
    
    /**
     * Fournit un total de réponses pour chaque catégorie pour une collectivité
     *
     * @param Collectivite $collectivite
     * @return array
     */
    public function countAllByCategory(Collectivite $collectivite)
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
        $qb = $this->createQbCountCollectiviteAnswer($collectivite);
        return $qb->getQuery()->getScalarResult();
    }

    /**
     * Fournit un total de réponses pour une seule catégorie pour une collectivité
     *
     * @param Category $category
     * @param Collectivite $collectivite
     * @return array
     */
    public function countForOneCategory(Category $category, Collectivite $collectivite)
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
        $qb = $this->createQbCountCollectiviteAnswer($collectivite);
        $qb->setParameter('category', $category)
            ->andWhere('c = :category');
        return $qb->getQuery()->getScalarResult();
    }

    /**
     * Retourne le QueryBuilder de base permettant de calculer une progression par catégorie
     *
     * @param Collectivite $collectivite
     * @return QueryBuilder
     */
    public function createQbCountCollectiviteAnswer(Collectivite $collectivite)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('c.id category_id, c.name as category_name, c.image as category_image, c.levelTwo as category_level_two')
        ->addSelect($qb->expr()->count('ca.id') . ' AS nb_repondu')
        ->from(Category::class, 'c')
        ->leftJoin('c.questions', 'q')
        ->innerJoin('q.answers', 'a')
        ->innerJoin('a.collectiviteAnswers', 'ca')
        ->where('ca.collectivite = :collectivite')
        ->orderBy('c.sortOrder')
        ->groupBy('c.id')
        ->setParameter('collectivite', $collectivite);

        if ($collectivite->isLevelTwo() == false) {
            $qb->andWhere('q.levelTwo = 0');
        }

        return $qb;
    }

    /**
     * Retourne le score d'une collectivité
     *
     * @param Collectivite $collectivite
     * @return array
     */
    public function countScore(Collectivite $collectivite)
    {
        /* Requête d'origine
            SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
            FROM `reponse`, `utilisateurReponse` 
            WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
            AND utilisateurReponse.IdReponse = reponse.Id
        */
        $qb = $this->createQueryBuilder('ca')
        ->select('SUM(a.ponderation) AS score')
        // ->addSelect('SUM(a.ponderation) AS nb')
        ->innerJoin('ca.answer', 'a')
        ->where('ca.collectivite = :collectivite')
        ->setParameter('collectivite', $collectivite);

        $score= $qb->getQuery()->getSingleResult();
        
        $q = $this->getEntityManager()->createQueryBuilder()
        ->from(Answer::class, 'a')
        ->select('SUM(a.ponderation) AS nb')
        ->innerJoin('a.question', 'q')
        ;
        
        if ($collectivite->isLevelTwo() == false) {
            $q->andWhere('q.levelTwo = 0');
        }
        $nb = $q->getQuery()->getSingleResult();

        return ['score' => $score['score'], 'nb' => $nb['nb']];
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
