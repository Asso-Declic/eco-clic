<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    /**
     * Retourne le nombre total de questions
     *
     * @return int
     */
    public function countAllQuestions(Collectivite $collectivite, ?Category $category = null)
    {
        // $qb = $this->createQueryBuilder('q')
        //     ->select('count(q.id)')
        //     ;

        // if ($collectivite->isLevelTwo() == false) {
        //     $qb->andWhere('q.levelTwo = 0');
        // }

        // if ($category !== null) {
        //     $qb->andWhere('q.category = :category')
        //         ->setParameter('category', $category)
        //         ;
        // }

        // return $qb->getQuery()->getSingleScalarResult();

        $reqLevel2 = "";
        $reqCateg = "";
        
        if ($collectivite->isLevelTwo() == false) {
            $reqLevel2 = "AND question.level_two = 0";
        }

        if ($category !== null) {
            $reqCateg = "AND question.category_id = $category";
        }

        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        

        $q = $this->getEntityManager()->createNativeQuery("SELECT question.id
            FROM question
            WHERE question.parent_answer_id IN (
                SELECT collectivite_answer.answer_id
                FROM collectivite_answer
                INNER JOIN question ON question.parent_answer_id = collectivite_answer.answer_id
                WHERE collectivite_answer.collectivite_id = :CollectiviteId 
                ". $reqCateg . " " . $reqLevel2 . ")
            UNION
            SELECT question.id
            FROM question
            WHERE question.parent_id IS NULL 
            ". $reqCateg . " " . $reqLevel2 . "
            UNION
            SELECT collectivite_answer.id 
            FROM `collectivite_answer` 
            INNER JOIN answer ON answer.id = collectivite_answer.answer_id
            INNER JOIN question ON answer.question_id = question.id
            WHERE collectivite_id = :CollectiviteId
            AND collectivite_answer.body != '' 
            ". $reqCateg . " " . $reqLevel2, $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());

        return count($q->getScalarResult());
    }

    /**
     * C'est un findBy avec le nom d'une catégorie et un tri par $sortOrder sur le thème puis sur la question
     *
     * @param Category $category
     * @return array
     */
    public function findByCategory(Category $category, bool $levelTwo): array
    {
        /* Requête d'origine
            SELECT question.Id, question.Question, question.Definition, theme.Theme, categorie.Nom as 'Categorie', question.Multiple, question.InfoComplementaire, question.Titre_definition, question.Ordre, question.IdParent, question.IdRepParent
            FROM `question` 
            INNER JOIN theme
            INNER JOIN categorie
            WHERE question.IdTheme = theme.Id
            AND question.IdCategorie = categorie.Id
            AND question.IdCategorie = :IdCateg
            ORDER BY theme.Ordre, question.Ordre
        */
        $qb = $this->createQueryBuilder('q')
            ->addSelect('c.name as category')
            ->addSelect('t.label as theme')
            ->addSelect('pq.id as parent_id')
            ->innerJoin('q.category', 'c')
            ->innerJoin('q.theme', 't')
            ->leftJoin('q.parent', 'pq')
            ->andWhere('q.category = :category')
            ->setParameter('category', $category)
            ->orderBy('t.sortOrder', 'ASC')
            ->addOrderBy('q.sortOrder', 'ASC')
            ;

        // Si le niveau 2 n'est pas activé, on ne retourne pas les questions de niveau 2
        if ($levelTwo == false) {
            $qb->andWhere('q.levelTwo = 0');
        }

        return $qb->getQuery()->getScalarResult();
    }

    public function countForOneCategory(Category $category, Collectivite $collectivite): int
    {
        // $qb = $this->createQueryBuilder('q')
        //     ->select('count(q.id) as nb_questions')
        //     ->andWhere('q.category = :category')
        //     ->setParameter('category', $category)
        //     ->groupBy('q.category')
        //     ;

        // if ($levelTwo == false) {
        //     $qb->andWhere('q.levelTwo = 0');
        // }    

        // $result = $qb->getQuery()->getOneOrNullResult();

        // if ($result === null) {
        //     return 0;
        // } else {
        //     return $result['nb_questions'];
        // }

        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('nbr_doublon', 'nbr_doublon');
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('short_title', 'short_title');
        $rsm->addScalarResult('body', 'body');
        $rsm->addScalarResult('details', 'details');
        $rsm->addScalarResult('question_id', 'question_id');
        $rsm->addScalarResult('title', 'title');
        $rsm->addScalarResult('level_id', 'level_id');
        $rsm->addScalarResult('status_id', 'status_id');
        

        $q = $this->getEntityManager()->createNativeQuery("SELECT * FROM (
            SELECT 0 AS nbr_doublon, recommandation.* 
            FROM `recommandation` 
            INNER JOIN answer on answer.question_id = recommandation.question_id
    		INNER JOIN question ON question.id = answer.question_id
            WHERE answer.type = 'input'
    		AND question.category_id = :CategorieId)as tmp
            WHERE tmp.question_id NOT IN (SELECT question_id FROM recommandation_custom
                INNER JOIN question ON recommandation_custom.question_id = question.id
                WHERE question.category_id = :CategorieId2
                AND recommandation_custom.collectivite_id = :CollectiviteId
                GROUP BY question.id)
            GROUP BY title", $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CategorieId', $category->getId());
        $q->setParameter('CategorieId2', $category->getId());

        return count($q->getScalarResult());
    }

    public function findByParentAnswer(Answer $answer): array
    {
        /* Requête d'origine
        SELECT question.Id, IF(question.IdRepParent = :ReponseId, 'Oui', 'Non') as Visible
        FROM `question`
        wHERE question.IdCategorie = :CategorieId
        AND question.IdParent = :QuestionId
        OR question.IdParent IN (
            SELECT Id FROM question where IdParent = :QuestionId2
            OR IdParent IN (SELECT Id FROM question where IdParent = :QuestionId3) 
            OR IdParent IN (SELECT Id FROM question where IdParent IN (SELECT Id FROM question where IdParent = :QuestionId4)) 
            OR IdParent IN (SELECT Id FROM question 
            where IdParent IN (SELECT Id FROM question where IdParent IN (SELECT Id FROM question where IdParent = :QuestionId5))) 
            OR IdParent IN (SELECT Id FROM question where IdParent IN (SELECT Id FROM question where IdParent = :QuestionId6)) 
            OR IdParent IN (SELECT Id FROM question where IdParent IN (SELECT Id FROM question 
            where IdParent IN (SELECT Id FROM question where IdParent IN (SELECT Id FROM question where IdParent = :QuestionId7))))
        )
        */
        // $qb = $this->createQueryBuilder('q')
        //     ->addSelect('IF(q.parentAnswer = a.id, \'Oui\', \'Non\') as Visible')
        //     ->innerJoin('q.answers', 'a')
        //     // ->where('q.category = :category')
        //     // ->setParameter('category', $answer->getQuestion()->getCategory())
        //     // ->andWhere('q.parent = :question')
        //     // ->setParameter('question', $answer->getQuestion())
        //     ->andWhere('q.parentAnswer = :answer')
        //     ->setParameter('answer', $answer)
        //     ->orWhere('q.parent IN (
        //         SELECT q2.id FROM App\Entity\Question q2 WHERE q2.parent = a.question
        //         OR q2.parent IN (SELECT q3.id FROM App\Entity\Question q3 WHERE q3.parent = a.question)
        //         OR q2.parent IN (SELECT q4.id FROM App\Entity\Question q4 WHERE q4.parent IN (SELECT q5.id FROM App\Entity\Question q5 WHERE q5.parent = a.question))
        //         OR q2.parent IN (SELECT q6.id FROM App\Entity\Question q6 WHERE q6.parent IN (SELECT q7.id FROM App\Entity\Question q7 WHERE q7.parent IN (SELECT q8.id FROM App\Entity\Question q8 WHERE q8.parent = a.question)))
        //         OR q2.parent IN (SELECT q9.id FROM App\Entity\Question q9 WHERE q9.parent IN (SELECT q10.id FROM App\Entity\Question q10 WHERE q10.parent = a.question))
        //         OR q2.parent IN (SELECT q11.id FROM App\Entity\Question q11 WHERE q11.parent IN (SELECT q12.id FROM App\Entity\Question q12 WHERE q12.parent IN (SELECT q13.id FROM App\Entity\Question q13 WHERE q13.parent IN (SELECT q14.id FROM App\Entity\Question q14 WHERE q14.parent = a.question))))
        //     )')
        //     ;

        // return dump($qb->getQuery()->getResult());

        $qb = $this->createQueryBuilder('q')
            // ->addSelect('IF(q.parentAnswer = a.id, \'Oui\', \'Non\') as Visible')
            // ->innerJoin('q.answers', 'a')
            ->where('q.parentAnswer = :answer')
            ->setParameter('answer', $answer)
            ;
        
        return $qb->getQuery()->getResult();
    }

    public function findByParentAnswer2(Answer $answer, Question $question,  Category $category): array
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('Visible', 'Visible');
        

        $q = $this->getEntityManager()->createNativeQuery("SELECT question.id, IF(question.parent_answer_id = :ReponseId, 'Oui', 'Non') as Visible
        FROM `question`
        WHERE question.category_id = :CategorieId
        AND question.parent_id = :QuestionId
        OR question.parent_id IN (
            SELECT id FROM question where parent_id = :QuestionId2
            OR parent_id IN (SELECT id FROM question where parent_id = :QuestionId3) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :QuestionId4)) 
            OR parent_id IN (SELECT id FROM question 
            where parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :QuestionId5))) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :QuestionId6)) 
            OR parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question 
            where parent_id IN (SELECT id FROM question where parent_id IN (SELECT id FROM question where parent_id = :QuestionId7)))))", $rsm);

        $q->setParameter('CategorieId', $category->getId());
        $q->setParameter('ReponseId', $answer->getId());
        $q->setParameter('QuestionId', $question->getId());
        $q->setParameter('QuestionId2', $question->getId());
        $q->setParameter('QuestionId3', $question->getId());
        $q->setParameter('QuestionId4', $question->getId());
        $q->setParameter('QuestionId5', $question->getId());
        $q->setParameter('QuestionId6', $question->getId());
        $q->setParameter('QuestionId7', $question->getId());

        return $q->getScalarResult();
    }

    public function save(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
