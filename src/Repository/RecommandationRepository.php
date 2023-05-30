<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Recommandation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recommandation>
 *
 * @method Recommandation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recommandation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recommandation[]    findAll()
 * @method Recommandation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recommandation::class);
    }

    public function findTotalsPerCategories(Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT IFNULL((SELECT COUNT(recommandation.Id)
                        FROM recommandation
                        JOIN question ON question.Id = recommandation.IdQuestion
                        JOIN reponse ON reponse.IdQuestion = question.Id
                        JOIN utilisateurReponse ON utilisateurReponse.IdReponse = reponse.Id
                        WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
                        AND categorie.Id = recommandation.IdCategorie
                        AND IF(question.Id = '96bb7d32-432e-11ed-af88-040300000000', reponse.Ponderation = 1, reponse.Ponderation = 0)
                        GROUP BY categorie.Id
                        ORDER BY categorie.Ordre),0) as nbRecommandation
            FROM categorie
            ORDER BY categorie.Ordre
        */
        /* Version sans le IFNULL qui n'affiche pas les catégories sans recommandation
            SELECT COUNT(recommandation.id)
            FROM recommandation
            JOIN question ON question.id = recommandation.question_id
            JOIN category on question.category_id = category.id
            JOIN answer reponse ON reponse.question_id = question.id
            JOIN collectivite_answer utilisateurReponse ON utilisateurReponse.answer_id = reponse.id
            WHERE utilisateurReponse.collectivite_id = '404'
            AND category.id = question.category_id
            AND IF(question.id = '96bb7d32-432e-11ed-af88-040300000000', reponse.ponderation = 1, reponse.ponderation = 0)
            GROUP BY category.id
            ORDER BY category.sort_order
        */
        /* Tentative incomplète de faire la requête autrement
            select ca.* 
            from collectivite_answer as ca
            inner join answer as a on ca.answer_id = a.id
            inner join question as q on a.question_id = q.id
            inner join recommandation as r on r.question_id = q.id
            inner join category as c on q.category_id = c.id
            where ca.collectivite_id = '404'
        */
        /* Version sans l'id en dur sur une question
            SELECT IFNULL((SELECT COUNT(recommandation.id)
                FROM recommandation
                JOIN question ON question.id = recommandation.question_id
                JOIN answer reponse ON reponse.question_id = question.id
                JOIN collectivite_answer utilisateurReponse ON utilisateurReponse.answer_id = reponse.id
                WHERE utilisateurReponse.collectivite_id = '404'
                AND category.id = question.category_id
                GROUP BY category.id
                ORDER BY category.sort_order),0) as nbRecommandation, category.id
            FROM category
            ORDER BY category.sort_order
        */
        /* Le résultat de celle-ci est très proche de la précédente
        C'est celle qui est fait en QB
        select count(distinct(recommandation.id)), category.*
        from category
        left JOIN question on question.category_id = category.id
        left JOIN recommandation ON question.id = recommandation.question_id
        left JOIN answer on answer.question_id = question.id
        left join collectivite_answer on answer.id = collectivite_answer.answer_id
        where collectivite_answer.collectivite_id = '404' or collectivite_answer.collectivite_id is null
        group by category.id
        order by category.sort_order
        */
        $qb = $this->createQueryBuilder('rec');
        $qb->from(Category::class, 'c')
        ->select('count(distinct(r.id)) as nb_recommandation, c.id as id')
        ->leftJoin('c.questions', 'q')
        ->leftJoin('q.recommandations', 'r')
        ->leftJoin('q.answers', 'a')
        ->leftJoin('a.collectiviteAnswers', 'ca')
        ->where('ca.collectivite = :collectivite')
        ->orWhere('ca.collectivite is null')
        ->setParameter('collectivite', $collectivite)
        ->groupBy('c.id')
        ->orderBy('c.sortOrder')
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function save(Recommandation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recommandation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Recommandation[] Returns an array of Recommandation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recommandation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
