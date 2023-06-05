<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    public function countAllQuestions()
    {
        $qb = $this->createQueryBuilder('q')
            ->select('count(q.id)')
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * C'est un findBy avec le nom d'une catégorie et un tri par $sortOrder sur le thème puis sur la question
     *
     * @param Category $category
     * @return array
     */
    public function findByCategory(Category $category): array
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

        return $qb->getQuery()->getScalarResult();
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
        //     // ->setParameter('category', $answer->getQuestion()->getCategory()) // TODO : Vérifier que c'est nécessaire
        //     // ->andWhere('q.parent = :question') // TODO : Vérifier que c'est nécessaire
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
            ->Where('q.parentAnswer = :answer')
            ->setParameter('answer', $answer)
            ;
        
        return $qb->getQuery()->getResult();
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
