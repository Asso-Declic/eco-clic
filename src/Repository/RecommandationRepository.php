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
    
    public function findAllForCollectivite(Collectivite $collectivite)
    {
        return $this->createQbForCollectivite($collectivite)->getQuery()->getResult();
    }

    public function findByCategory(Category $category, Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT recommandation.Id, recommandation.Titre, recommandation.Text, categorie.Nom, ref_NiveauReco.Label as NiveauLabel, ref_NiveauReco.Couleur as NiveauCouleur, utilisateurStatut.StatutCode as StatutId, ref_StatutReco.Label as StatutLabel
        FROM `recommandation`
        INNER JOIN categorie ON recommandation.IdCategorie = categorie.Id
        INNER JOIN utilisateurReponse ON recommandation.IdQuestion = utilisateurReponse.IdQuestion
        INNER JOIN reponse ON utilisateurReponse.IdReponse = reponse.Id
        INNER JOIN question ON question.Id = reponse.IdQuestion
        INNER JOIN ref_NiveauReco ON recommandation.NiveauReco = ref_NiveauReco.Id
        INNER JOIN utilisateurStatut ON recommandation.Id = utilisateurStatut.RecommandationId
        INNER JOIN ref_StatutReco ON utilisateurStatut.StatutCode = ref_StatutReco.Id
        WHERE recommandation.IdCategorie = :id
        AND utilisateurReponse.CollectiviteId = :CollectiviteId
        AND IF(question.Id = '96bb7d32-432e-11ed-af88-040300000000', reponse.Ponderation = 1, reponse.Ponderation = 0)"
        */
        $qb = $this->createQbForCollectivite($collectivite)
            ->andWhere('q.category = :category')
            ->setParameter('category', $category);

        return $qb->getQuery()->getResult();
    }

    public function findFiltersPrio(Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT recommandation.Id as 'recommandationId', recommandation.Titre, recommandation.Text, question.Question,theme.Id as themeId, theme.Theme, categorie.Id as categorieId, categorie.Nom as 'Categorie', categorie.Img as Img, ref_NiveauReco.Label as NiveauLabel, ref_NiveauReco.Id as NiveauId, ref_NiveauReco.Couleur as NiveauCouleur, utilisateurStatut.StatutCode as StatutId, ref_StatutReco.Label as StatutLabel
        FROM `recommandation`
        INNER JOIN question
        INNER JOIN theme
        INNER JOIN categorie
        INNER JOIN ref_NiveauReco ON recommandation.NiveauReco = ref_NiveauReco.Id
        INNER JOIN utilisateurStatut ON recommandation.Id = utilisateurStatut.RecommandationId
        INNER JOIN ref_StatutReco ON utilisateurStatut.StatutCode = ref_StatutReco.Id
        INNER JOIN utilisateurReponse ON recommandation.IdQuestion = utilisateurReponse.IdQuestion
        INNER JOIN reponse ON utilisateurReponse.IdQuestion = reponse.IdQuestion
        WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
        AND utilisateurReponse.IdReponse = reponse.Id
        AND reponse.Text = 'Non'
        AND recommandation.IdQuestion = question.Id
        AND question.IdTheme = theme.Id
        AND question.IdCategorie = categorie.Id

        -- AND ref_NiveauReco.Id IN ()
        -- AND ref_StatutReco.Id IN ()
        -- AND categorie.Id IN ()

        Order by categorie.Ordre
        */

        $qb = $this->createQueryBuilder('r');
        $qb->select('r.id as recommandationId, r.title, r.body, q.question, t.id as themeId, t.label as themeName, c.id as categoryId, c.name as categoryName, c.image as categoryImg, l.label as levelLabel, l.id as levelId, l.color as levelColor, s.id as statusId, s.label as statusLabel')
        ->innerJoin('r.question', 'q')
        ->innerJoin('q.theme', 't')
        ->innerJoin('q.category', 'c')
        ->innerJoin('r.level', 'l')
        ->innerJoin('r.status', 's')
        ->innerJoin('q.answers', 'a')
        ->innerJoin('a.collectiviteAnswers', 'ca')
        ->where('ca.collectivite = :collectivite')
        ->setParameter('collectivite', $collectivite)
        ->andWhere('a.body = :answerBody')
        ->setParameter('answerBody', 'Non')
        ->orderBy('c.sortOrder', 'ASC')
        ;
        
        return $qb->getQuery()->getResult();

            
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

    public function createQbForCollectivite(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->select('r.id, r.title, r.body, c.name as category_name, c.id as category_id, c.image as category_image, l.id as level_id, l.label as level_label, l.color as level_color, s.id as status_id, s.label as status_label, t.id as theme_id, t.label as theme_label, q.question as question')
            ->innerJoin('r.level', 'l')
            ->innerJoin('r.status', 's')
            ->innerJoin('r.question', 'q')
            ->innerJoin('q.category', 'c')
            ->innerJoin('q.theme', 't')
            ->innerJoin('q.answers', 'a')
            ->innerJoin('a.collectiviteAnswers', 'ca')
            ->where('ca.collectivite = :collectivite')
            ->setParameter('collectivite', $collectivite)
            ->orderBy('r.title', 'ASC');

        return $qb;
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
}
