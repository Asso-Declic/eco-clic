<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\CollectiviteStatus;
use App\Entity\Question;
use App\Entity\Recommandation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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
    
    public function countTotalsPerCategories(Collectivite $collectivite)
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
        
        /* Le résultat de celle-ci est très proche de la précédente
        C'est celle qui est fait en QB
        select count(distinct(recommandation.id)), category.*
        from category
        left JOIN question on question.category_id = category.id
        left JOIN recommandation ON question.id = recommandation.question_id
        left JOIN answer on answer.question_id = question.id
        left join collectivite_answer on answer.id = collectivite_answer.answer_id
        where collectivite_answer.collectivite_id = '404'
        group by category.id
        order by category.sort_order
        */
        // $qb = $this->getEntityManager()->createQueryBuilder();
        // $qb->from(Category::class, 'c')
        // ->select('count(distinct(r.id)) as nb_recommandation, c.id as id')
        // ->innerJoin('c.questions', 'q')
        // ->innerJoin('q.recommandations', 'r')
        // ->innerJoin('q.answers', 'a')
        // ->innerJoin('a.collectiviteAnswers', 'ca')
        // ->where('ca.collectivite = :collectivite')
        // ->setParameter('collectivite', $collectivite)
        // ->groupBy('c.id')
        // ->orderBy('c.sortOrder')
        // ;

        // return $qb->getQuery()->getScalarResult();


        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('nb_recommandation', 'nb_recommandation');
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('ordre', 'ordre');
        

        $q = $this->getEntityManager()->createNativeQuery("
        SELECT t.id, count(t.name) as nb_recommandation, sort_order as ordre FROM (SELECT id as reco, categ as id, name, sort_order FROM ((SELECT recommandation.id, category.id as categ, category.name, category.sort_order
            FROM `recommandation`
            INNER JOIN collectivite    
            INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
            INNER JOIN answer ON collectivite_answer.answer_id = answer.id
		    INNER JOIN question ON question.id = answer.question_id 
            INNER JOIN category ON question.category_id = category.id
            INNER JOIN recommandation_answer ON recommandation_answer.answer_id = answer.id
                
            WHERE collectivite.id = :CollectiviteId
            AND collectivite_answer.collectivite_id  = :CollectiviteId2
            AND answer.question_id = recommandation.question_id   
            AND recommandation_answer.recommandation_id = recommandation.id
            AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0)
            ORDER BY recommandation.title)) as tmp 
            WHERE tmp.id NOT IN (SELECT id FROM (
                SELECT recommandation.id 
                FROM `recommandation` 
                INNER JOIN answer on answer.question_id  = recommandation.question_id 
                INNER JOIN question ON question.id = answer.question_id 
                WHERE answer.type = 'input'
                )as tmp2
                )
                
                UNION
                
                (SELECT recommandation.id, category.id as categ, category.name, category.sort_order
            FROM `recommandation`
            INNER JOIN recommandation_custom ON recommandation.id = recommandation_custom.recommandation_id
            INNER JOIN collectivite 
            INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
            INNER JOIN answer ON collectivite_answer.answer_id = answer.id
		    INNER JOIN question ON question.id = answer.question_id
            INNER JOIN category ON question.category_id = category.id
                 
            WHERE collectivite.id = :CollectiviteId3
            AND collectivite_answer.collectivite_id  = :CollectiviteId4
            AND answer.question_id = recommandation.question_id  
            AND recommandation_custom.collectivite_id = :CollectiviteId5
            AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0))) as t GROUP BY name
            ", $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CollectiviteId2', $collectivite->getId());
        $q->setParameter('CollectiviteId3', $collectivite->getId());
        $q->setParameter('CollectiviteId4', $collectivite->getId());
        $q->setParameter('CollectiviteId5', $collectivite->getId());

        return $q->getScalarResult();
    }

    public function createQbForCollectivite(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->select('r.id, r.title, r.body, c.name as category_name, c.id as category_id, c.image as category_image, l.id as level_id, l.label as level_label, l.color as level_color, s.id as status_id, s.label as status_label, t.id as theme_id, t.label as theme_label, q.question as question, q.levelTwo as level_two')
            ->leftJoin('r.level', 'l')
            ->leftJoin(CollectiviteStatus::class, 'cs', 'WITH', 'cs.recommandation = r and cs.collectivite = :collectivite')
            ->leftJoin('cs.status', 's')
            ->leftJoin('r.question', 'q')
            ->leftJoin('q.category', 'c')
            ->leftJoin('q.theme', 't')
            ->leftJoin('q.answers', 'a')
            ->leftJoin('a.collectiviteAnswers', 'ca')
            ->where('ca.collectivite = :collectivite')
            ->setParameter('collectivite', $collectivite)
            ->orderBy('r.title', 'ASC');

        if ($collectivite->isLevelTwo() == false) {
            $qb->andWhere('q.levelTwo = false');
        }

        return $qb;
    }

    public function findAnswersByQuestion(Question $question, Collectivite $collectivite)
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('body', 'body');
        $rsm->addScalarResult('r', 'r');
        $rsm->addScalarResult('type', 'type');

        $q = $this->getEntityManager()->createNativeQuery("
            SELECT answer.id, answer.body, collectivite_answer.body as r, 'reponse' as type
                FROM `collectivite_answer`
                INNER JOIN answer ON answer.id = collectivite_answer.answer_id
                WHERE answer.question_id = :IdQuestion
                AND collectivite_answer.collectivite_id = :CollectiviteId
            UNION
            SELECT recommandation.id, body, ' ' as r, 'reco' as type
    		    FROM recommandation
    		    WHERE question_id = :IdQuestion2
            UNION
            SELECT recommandation_custom.recommandation_id, recommandation.body, ' ' as r, 'selectedReco' as type
    		    FROM recommandation_custom
                INNER JOIN recommandation ON recommandation.id = recommandation_custom.recommandation_id
    		    WHERE recommandation_custom.question_id = :IdQuestion3
                AND recommandation_custom.collectivite_id = :CollectiviteId2
            UNION
            SELECT recommandation_perso.id, recommandation_perso.body, ' ' as r, 'perso' as type
                FROM recommandation_perso
                WHERE recommandation_perso.question_id = :IdQuestion4
                AND recommandation_perso.collectivite_id = :CollectiviteId3", $rsm);

        $q->setParameter('IdQuestion', $question->getId());
        $q->setParameter('IdQuestion2', $question->getId());
        $q->setParameter('IdQuestion3', $question->getId());
        $q->setParameter('IdQuestion4', $question->getId());
        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CollectiviteId2', $collectivite->getId());
        $q->setParameter('CollectiviteId3', $collectivite->getId());

        return $q->getScalarResult();
    }

    public function findAllForCollectivite(Collectivite $collectivite)
    {
        return $this->createQbForCollectivite($collectivite)->getQuery()->getResult();
    }

    public function findByCategory(Category $category, Collectivite $collectivite)
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('question_id', 'question_id');
        $rsm->addScalarResult('title', 'title');
        $rsm->addScalarResult('body', 'body');
        $rsm->addScalarResult('name', 'name');
        $rsm->addScalarResult('NiveauLabel', 'NiveauLabel');
        $rsm->addScalarResult('NiveauCouleur', 'NiveauCouleur');
        $rsm->addScalarResult('level_two', 'level_two');
        $rsm->addScalarResult('sort_order', 'sort_order');
        

        $q = $this->getEntityManager()->createNativeQuery(
        "SELECT * FROM ((SELECT recommandation.id, recommandation.question_id, recommandation.title, recommandation.body, category.name, recommandation_level.label as NiveauLabel, recommandation_level.color as NiveauCouleur, question.level_two, question.sort_order
            FROM `recommandation`
            INNER JOIN collectivite    
            INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
            INNER JOIN answer ON collectivite_answer.answer_id = answer.id
		    INNER JOIN question ON question.id = answer.question_id 
            INNER JOIN category ON question.category_id = category.id
            INNER JOIN recommandation_level ON recommandation.level_id  = recommandation_level.id
            INNER JOIN recommandation_answer ON recommandation_answer.answer_id = answer.id
                
            WHERE question.category_id = :id
            AND collectivite.id = :CollectiviteId
            AND collectivite_answer.collectivite_id  = :CollectiviteId2
            AND answer.question_id = recommandation.question_id   
            AND recommandation_answer.recommandation_id = recommandation.id
            AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0)
            ORDER BY recommandation.title )) as tmp 
            WHERE tmp.id NOT IN (SELECT id FROM (
                SELECT recommandation.id 
                FROM `recommandation` 
                INNER JOIN answer on answer.question_id  = recommandation.question_id 
                INNER JOIN question ON question.id = answer.question_id 
                WHERE answer.type = 'input'
                AND question.category_id = :id2)as tmp2
                GROUP BY title)
                
                UNION
                
                (SELECT recommandation.id, recommandation.question_id, recommandation.title, recommandation.body, category.name, recommandation_level.label as NiveauLabel, recommandation_level.color as NiveauCouleur, question.level_two, question.sort_order
            FROM `recommandation`
            INNER JOIN recommandation_custom ON recommandation.id = recommandation_custom.recommandation_id
            INNER JOIN collectivite 
            INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
            INNER JOIN answer ON collectivite_answer.answer_id = answer.id
		    INNER JOIN question ON question.id = answer.question_id
            INNER JOIN category ON question.category_id = category.id
            INNER JOIN recommandation_level ON recommandation.level_id = recommandation_level.id
                 
            WHERE question.category_id = :id3
            AND collectivite.id = :CollectiviteId3
            AND collectivite_answer.collectivite_id  = :CollectiviteId4
            AND answer.question_id = recommandation.question_id  
            AND recommandation_custom.collectivite_id = :CollectiviteId5
            AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0))

            UNION

            SELECT
                recommandation_perso.id,
                recommandation_perso.question_id,
                recommandation_perso.title,
                recommandation_perso.body,
                category.name,
                recommandation_level.label AS NiveauLabel,
                recommandation_level.color AS NiveauCouleur,
                question.level_two,
                question.sort_order
            FROM recommandation_perso
            INNER JOIN question ON recommandation_perso.question_id = question.id
            INNER JOIN category ON question.category_id = category.id
            INNER JOIN recommandation_level ON recommandation_perso.level_id = recommandation_level.id
            WHERE recommandation_perso.collectivite_id = :CollectiviteId6
            AND question.category_id = :id4
            AND (
                    (SELECT level_two FROM collectivite WHERE id = :CollectiviteId7) = 0 AND question.level_two = 0
                    OR (SELECT level_two FROM collectivite WHERE id = :CollectiviteId8) = 1 AND (question.level_two = 0 OR question.level_two = 1)
                )
            ORDER BY sort_order
            ", $rsm);

        $q->setParameter('id', $category->getId());
        $q->setParameter('id2', $category->getId());
        $q->setParameter('id3', $category->getId());
        $q->setParameter('id4', $category->getId());
        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CollectiviteId2', $collectivite->getId());
        $q->setParameter('CollectiviteId3', $collectivite->getId());
        $q->setParameter('CollectiviteId4', $collectivite->getId());
        $q->setParameter('CollectiviteId5', $collectivite->getId());
        $q->setParameter('CollectiviteId6', $collectivite->getId());
        $q->setParameter('CollectiviteId7', $collectivite->getId());
        $q->setParameter('CollectiviteId8', $collectivite->getId());

        $reco = $q->getScalarResult();

        for ($i=0; $i < count($q->getScalarResult()); $i++) {

            $rsm = new ResultSetMapping();
            $rsm->addScalarResult('status_id', 'status_id');
            $rsm->addScalarResult('status_label', 'status_label');

            $a = $this->getEntityManager()->createNativeQuery(
            "SELECT collectivite_status.status_id, recommandation_status.label as status_label
            FROM collectivite_status
            INNER JOIN recommandation_status ON collectivite_status.status_id = recommandation_status.Id
            WHERE collectivite_status.recommandation_id = :RecoId
            AND collectivite_status.collectivite_id = :CollectiviteId6", $rsm);

            $a->setParameter('RecoId', $q->getScalarResult()[$i]["id"]);
            $a->setParameter('CollectiviteId6', $collectivite->getId());

            $b = $this->getEntityManager()->createNativeQuery(
            "SELECT recommandation_perso.status_id, recommandation_status.label as status_label
            FROM recommandation_perso
            INNER JOIN recommandation_status ON recommandation_perso.status_id = recommandation_status.Id
            WHERE recommandation_perso.id = :RecoId2
            AND recommandation_perso.collectivite_id = :CollectiviteId7", $rsm);

            $b->setParameter('RecoId2', $q->getScalarResult()[$i]["id"]);
            $b->setParameter('CollectiviteId7', $collectivite->getId());
            
            if (count($a->getScalarResult()) > 0) {
                $reco[$i] += $a->getScalarResult()[0];
                $reco[$i] += array("perso" => "0");
            } elseif (count($b->getScalarResult()) > 0) {
                $reco[$i] += $b->getScalarResult()[0];
                $reco[$i] += array("perso" => "1");
            } else {
                $reco[$i] += array("status_id" => "4", "status_label" => "À définir", "perso" => "0");
            }

        }
        return $reco;
    }

    public function findRecommandationsPersoByCategory(Category $category)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('q, r, c, a')
            ->innerJoin('r.question', 'q')
            ->innerJoin('q.category', 'c')
            ->innerJoin('q.answers', 'a')
            ->where('a.type = :type')
            ->andWhere('q.category = :category')
            ->setParameter('type', Answer::TYPE_INPUT)
            ->setParameter('category', $category)
            ->groupBy('q');

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

    public function downloadRecommandations(Collectivite $collectivite)
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('Categorie', 'Categorie');
        $rsm->addScalarResult('Theme', 'Theme');
        $rsm->addScalarResult('Question', 'Question');
        $rsm->addScalarResult('Reponse', 'Reponse');
        $rsm->addScalarResult('Recommandation', 'Recommandation');
        $rsm->addScalarResult('NiveauLabel', 'NiveauLabel');
        // $rsm->addScalarResult('Ordre', 'Ordre');
        // $rsm->addScalarResult('Ordre2', 'Ordre2');

        $q = $this->getEntityManager()->createNativeQuery("SELECT * FROM ((SELECT recommandation.id, category.name as Categorie, theme.label as Theme, recommandation.title as Question, IF(collectivite_answer.body = '', answer.body, collectivite_answer.body) as Reponse, recommandation.body as Recommandation, recommandation_level.label as NiveauLabel, category.sort_order as Ordre, question.sort_order as Ordre2
        FROM `recommandation`
        INNER JOIN collectivite   
        INNER JOIN theme
        INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
        INNER JOIN answer ON collectivite_answer.answer_id = answer.id
        INNER JOIN question ON question.id = answer.question_id 
        INNER JOIN category ON question.category_id = category.id
        INNER JOIN recommandation_level ON recommandation.level_id  = recommandation_level.id
        INNER JOIN recommandation_answer ON recommandation_answer.answer_id = answer.id
        LEFT JOIN collectivite_status ON recommandation.id = collectivite_status.recommandation_id
        LEFT JOIN recommandation_status ON collectivite_status.status_id = recommandation_status.Id
                        
        WHERE collectivite.id = :CollectiviteId
        AND collectivite_answer.collectivite_id  = :CollectiviteId2
        AND answer.question_id = recommandation.question_id 
        AND question.theme_id = theme.id
        AND recommandation_answer.recommandation_id = recommandation.id
        AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0)
        ORDER BY recommandation.title)) as tmp 
        WHERE tmp.id NOT IN (SELECT id FROM (
            SELECT recommandation.id 
            FROM `recommandation` 
            INNER JOIN answer on answer.question_id  = recommandation.question_id 
            INNER JOIN question ON question.id = answer.question_id 
            WHERE answer.type = 'input'
            )as tmp2
            GROUP BY Question)
            
            UNION
            
            (SELECT recommandation.id, category.name as Categorie, theme.label as Theme, recommandation.title as Question, IF(collectivite_answer.body = '', answer.body, collectivite_answer.body) as Reponse, recommandation.body as Recommandation, recommandation_level.label as NiveauLabel, category.sort_order as Ordre, question.sort_order as Ordre2
        FROM `recommandation`
        INNER JOIN recommandation_custom ON recommandation.id = recommandation_custom.recommandation_id
        INNER JOIN collectivite 
        INNER JOIN theme
        INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
        INNER JOIN answer ON collectivite_answer.answer_id = answer.id
        INNER JOIN question ON question.id = answer.question_id
        INNER JOIN category ON question.category_id = category.id
        INNER JOIN recommandation_level ON recommandation.level_id = recommandation_level.id
        LEFT JOIN collectivite_status ON recommandation.id = collectivite_status.recommandation_id
        LEFT JOIN recommandation_status ON collectivite_status.status_id = recommandation_status.Id
             
        WHERE collectivite.id = :CollectiviteId3
        AND collectivite_answer.collectivite_id  = :CollectiviteId4
        AND answer.question_id = recommandation.question_id  
        AND question.theme_id = theme.id
        AND recommandation_custom.collectivite_id = :CollectiviteId5
        AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0))
        ORDER BY Ordre, Ordre2", $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CollectiviteId2', $collectivite->getId());
        $q->setParameter('CollectiviteId3', $collectivite->getId());
        $q->setParameter('CollectiviteId4', $collectivite->getId());
        $q->setParameter('CollectiviteId5', $collectivite->getId());

        return $q->getScalarResult();
    }

    public function totalsRecommandationsByCollectivite(Collectivite $collectivite)
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('body', 'body');
        $rsm->addScalarResult('category_id', 'category_id');
        $rsm->addScalarResult('category_image', 'category_image');
        $rsm->addScalarResult('category_name', 'category_name');
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('level_color', 'level_color');
        $rsm->addScalarResult('level_id', 'level_id');
        $rsm->addScalarResult('level_label', 'level_label');
        $rsm->addScalarResult('level_two', 'level_two');
        $rsm->addScalarResult('question', 'question');
        $rsm->addScalarResult('theme_id', 'theme_id');
        $rsm->addScalarResult('theme_label', 'theme_label');
        $rsm->addScalarResult('title', 'title');

        $q = $this->getEntityManager()->createNativeQuery("SELECT * FROM ((SELECT recommandation.body, category.id  as category_id, category.image as category_image, category.name as category_name, recommandation.id, recommandation_level.color as level_color, recommandation.level_id, recommandation_level.label as level_label, question.level_two, recommandation.title as question, theme.id as theme_id, theme.label as theme_label, recommandation.title
        FROM `recommandation`
        INNER JOIN collectivite   
        INNER JOIN theme
        INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
        INNER JOIN answer ON collectivite_answer.answer_id = answer.id
        INNER JOIN question ON question.id = answer.question_id 
        INNER JOIN category ON question.category_id = category.id
        INNER JOIN recommandation_level ON recommandation.level_id  = recommandation_level.id
        INNER JOIN recommandation_answer ON recommandation_answer.answer_id = answer.id
                        
        WHERE collectivite.id = :CollectiviteId
        AND collectivite_answer.collectivite_id  = :CollectiviteId2
        AND answer.question_id = recommandation.question_id 
        AND question.theme_id = theme.id
        AND recommandation_answer.recommandation_id = recommandation.id
        AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0)
        ORDER BY recommandation.title)) as tmp 
        WHERE tmp.id NOT IN (SELECT id FROM (
            SELECT recommandation.id 
            FROM `recommandation` 
            INNER JOIN answer on answer.question_id  = recommandation.question_id 
            INNER JOIN question ON question.id = answer.question_id 
            WHERE answer.type = 'input'
            )as tmp2
            GROUP BY Question)
            
            UNION
            
            (SELECT recommandation.body, category.id  as category_id, category.image as category_image, category.name as category_name, recommandation.id, recommandation_level.color as level_color, recommandation.level_id, recommandation_level.label as level_label, question.level_two, recommandation.title as question, theme.id as theme_id, theme.label as theme_label, recommandation.title
        FROM `recommandation`
        INNER JOIN recommandation_custom ON recommandation.id = recommandation_custom.recommandation_id
        INNER JOIN collectivite 
        INNER JOIN theme
        INNER JOIN collectivite_answer ON collectivite.id  = collectivite_answer.collectivite_id
        INNER JOIN answer ON collectivite_answer.answer_id = answer.id
        INNER JOIN question ON question.id = answer.question_id
        INNER JOIN category ON question.category_id = category.id
        INNER JOIN recommandation_level ON recommandation.level_id = recommandation_level.id
             
        WHERE collectivite.id = :CollectiviteId3
        AND collectivite_answer.collectivite_id  = :CollectiviteId4
        AND answer.question_id = recommandation.question_id  
        AND question.theme_id = theme.id
        AND recommandation_custom.collectivite_id = :CollectiviteId5
        AND IF(collectivite.level_two = 1, question.level_two = 0 OR question.level_two = 1, question.level_two = 0))", $rsm);

        $q->setParameter('CollectiviteId', $collectivite->getId());
        $q->setParameter('CollectiviteId2', $collectivite->getId());
        $q->setParameter('CollectiviteId3', $collectivite->getId());
        $q->setParameter('CollectiviteId4', $collectivite->getId());
        $q->setParameter('CollectiviteId5', $collectivite->getId());

        $reco = $q->getScalarResult();

        for ($i=0; $i < count($q->getScalarResult()); $i++) {

            $rsm = new ResultSetMapping();
            $rsm->addScalarResult('status_id', 'status_id');
            $rsm->addScalarResult('status_label', 'status_label');

            $a = $this->getEntityManager()->createNativeQuery(
            "SELECT collectivite_status.status_id, recommandation_status.label as status_label
            FROM collectivite_status
            INNER JOIN recommandation_status ON collectivite_status.status_id = recommandation_status.Id
            WHERE collectivite_status.recommandation_id = :RecoId
            AND collectivite_status.collectivite_id = :CollectiviteId6", $rsm);

            $a->setParameter('RecoId', $q->getScalarResult()[$i]["id"]);
            $a->setParameter('CollectiviteId6', $collectivite->getId());
            
            if (count($a->getScalarResult()) > 0) {
                $reco[$i] += $a->getScalarResult()[0];
            } else {
                $reco[$i] += array("status_id" => "4", "status_label" => "À définir");
            }

        }
        return $reco;
    }
}
