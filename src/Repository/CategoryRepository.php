<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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
    
    public function findFilters()
    {
        /* Requte d'origine
        SELECT categorie.Id, categorie.Nom, null as IdCategorie, Ordre from categorie
        UNION
        Select theme.Id, theme.Theme, theme.IdCategorie, null from theme
        WHERE theme.Id != '0'
        order by Ordre
        */
        // $rsm = new ResultSetMapping();
        // $query = $this->getEntityManager()->createNativeQuery('
        //     SELECT category.id, category.name, null AS category_id, sort_order from category
        //     UNION
        //     SELECT theme.id, theme.label, theme.category_id, null from theme
        //     WHERE theme.id != \'0\'
        //     ORDER BY sort_order', $rsm);

        // return dd($query->getScalarResult());
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, t')
        ->leftJoin('c.themes', 't')
        ->orderBy('c.sortOrder, t.sortOrder')
        ;

        return $qb->getQuery()->getResult();
    }

    public function findInfos(Collectivite $collectivite)
    {
        /* Requête d'origine
        "SELECT category.id, category.name, category.image, category.description, category.sort_order, category.level_two, COUNT(question.category_id) as nb_question, 
            (
                SELECT COUNT(recommandation.question_id) 
                FROM `recommandation` 
                INNER JOIN question ON question.id = recommandation.question_id
                WHERE question.category_id = category.id
            ) as nbReco
        FROM `category`
        INNER JOIN `question`
        WHERE question.category_id = category.id
        AND question.parent_id IS NULL
        GROUP BY question.category_id
        ORDER BY category.sort_order"
        */
        $qb = $this->createQueryBuilder('c');
        $qb->innerJoin('c.questions', 'q')
        // Ces select sont des patchs pour avoir des noms de champs bien propres en JSON
        ->select('c.id as id')
        ->addSelect('c.name as name')
        ->addSelect('c.image as image')
        ->addSelect('c.description as description')
        ->addSelect('c.sortOrder as sort_order')
        ->addSelect('c.levelTwo as level_two')
        ->addSelect('(
            SELECT COUNT(question.category)
            FROM App\Entity\Recommandation recommandation
            INNER JOIN recommandation.question question
            WHERE question.category = c
            ) as nbReco')
        ->addSelect('COUNT(q.category) as nb_question')
        ->where('q.category = c.id')
        ->andWhere('q.parent IS NULL')
        ->groupBy('q.category')
        ->orderBy('c.sortOrder')
        ;

        if ($collectivite->isLevelTwo() == false) {
            $qb->andWhere('q.levelTwo = 0');
        }

        return $qb->getQuery()->getScalarResult();
    }

    /**
     * Il s'agit d'une optimisation qui permet de récupérer les questions en même temps que les catégories
     *
     * @return Category[]
     */
    public function findWithQuestions()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, q')
        ->leftJoin('c.questions', 'q')
        ->orderBy('c.sortOrder, q.sortOrder')
        ;

        return $qb->getQuery()->getResult();
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

    public function countAllQuestionsByCategory(Collectivite $collectivite)
    {

        $reqLevel2 = "";

        if ($collectivite->isLevelTwo() == false) {
            $reqLevel2 = "AND question.level_two = 0";
        }

        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('nb_question', 'nb_question');
        $rsm->addScalarResult('name', 'name');
        $rsm->addScalarResult('sort_order', 'sort_order');

        $q = $this->getEntityManager()->createNativeQuery("SELECT COUNT(t.id)  as nb_question, name, sort_order FROM (
            SELECT question.id, category.name, category.sort_order
            FROM category, question
            WHERE question.parent_answer_id IN (
                SELECT collectivite_answer.answer_id
                FROM collectivite_answer
                INNER JOIN question ON question.parent_answer_id = collectivite_answer.answer_id
                WHERE collectivite_answer.collectivite_id = :CollectiviteId
                AND question.category_id = category.id 
                ". $reqLevel2 ."
            )
            UNION
            SELECT question.id, category.name, category.sort_order
                FROM category, question
                WHERE question.parent_id IS NULL
                AND question.category_id = category.id 
                ". $reqLevel2 ."
            UNION
            SELECT collectivite_answer.id, category.name, category.sort_order
                FROM category, `collectivite_answer` 
                INNER JOIN question ON question.parent_answer_id = collectivite_answer.answer_id
                WHERE collectivite_id = :CollectiviteId 
                AND body != ''
                AND question.category_id = category.id 
                ". $reqLevel2 ."
        ) as t
        GROUP by name
        ORDER BY sort_order", $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());

        return $q->getScalarResult();
    }
}
