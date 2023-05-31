<?php

namespace App\Repository;

use App\Entity\Category;
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
        $qb = $this->createQueryBuilder('c');
        $qb->innerJoin('c.questions', 'q')
        // Ces select sont des patchs pour avoir des noms de champs bien propres en JSON
        ->select('c.id as id')
        ->addSelect('c.name as name')
        ->addSelect('c.image as image')
        ->addSelect('c.description as description')
        ->addSelect('c.sortOrder as sort_order')
        ->addSelect('(
            SELECT COUNT(recommandation.id)
            FROM App\Entity\Recommandation recommandation
            INNER JOIN recommandation.question question
            WHERE question.category = c
            ) as nbReco')

        ->addSelect('COUNT(q.id) as nb_question')
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
}
