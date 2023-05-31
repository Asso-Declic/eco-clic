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
        $qb = $this->createQueryBuilder('q')
            ->andWhere('q.parentAnswer = :answer')
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
