<?php

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\CollectiviteAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Answer>
 *
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    /**
     * Retourne le score d'une collectivité pour une catégorie
     * TODO : Cette requête est ici car elle est `FROM Answer` mais le calcul se fait en fonction des CollectiviteAnswer. Il faudra la déplacer un jour
     *
     * @param Category $category
     * @param Collectivite $collectivite
     * @return array
     */
    public function countScoreForCategory(Category $category, Collectivite $collectivite)
    {
        /* Requête d'origine
        SELECT SUM(reponse.Ponderation) as score, COUNT(reponse.Ponderation) as nb
        FROM reponse
        JOIN question ON question.Id = reponse.IdQuestion
        JOIN categorie ON categorie.Id = question.IdCategorie
        JOIN utilisateurReponse ON utilisateurReponse.IdReponse = reponse.Id
        WHERE utilisateurReponse.CollectiviteId = :CollectiviteId
        AND utilisateurReponse.IdReponse = reponse.Id
        AND categorie.Id = :CategorieId
        */
        // $qb = $this->createQueryBuilder('a')
        //     ->select('SUM(a.ponderation) as score, COUNT(a.ponderation) as nb')
        //     ->innerJoin('a.question', 'q')
        //     ->innerJoin('q.category', 'c')
        //     ->leftJoin('a.collectiviteAnswers', 'ca')
        //     ->where('ca.collectivite = :collectivite')
        //     ->andWhere('c = :category')
        //     ->setParameter('collectivite', $collectivite)
        //     ->setParameter('category', $category)
        //     ;

        // if ($collectivite->isLevelTwo() == false) {
        //     $qb->andWhere('q.levelTwo = 0');
        // }

        // return $qb->getQuery()->getScalarResult()[0];

        $qb = $this->getEntityManager()->createQueryBuilder()
        ->from(CollectiviteAnswer::class, 'ca')
        ->select('SUM(a.ponderation) AS score')
        // ->addSelect('SUM(a.ponderation) AS nb')
        ->innerJoin('ca.answer', 'a')
        ->innerJoin('a.question', 'q')
        ->where('ca.collectivite = :collectivite')
        ->andWhere('q.category = :category')
        ->setParameter('collectivite', $collectivite)
        ->setParameter('category', $category)
        ;

        $score= $qb->getQuery()->getSingleResult();
        
        $q = $this->createQueryBuilder('a')
        ->select('SUM(a.ponderation) AS nb')
        ->innerJoin('a.question', 'q')
        ->innerJoin('q.category', 'c')
        ->where('c = :category')
        ->setParameter('category', $category)
        ;
        
        if ($collectivite->isLevelTwo() == false) {
            $q->andWhere('q.levelTwo = 0');
        }
        $nb = $q->getQuery()->getSingleResult();

        return ['score' => $score['score'], 'nb' => $nb['nb']];
    }

    public function findPonderationMax()
    {
        /* Requête d'origine
            SELECT SUM(reponse.Ponderation) as nb
            FROM reponse
            JOIN question ON question.Id = reponse.IdQuestion
            JOIN categorie ON categorie.Id = question.IdCategorie
            WHERE reponse.Text = 'Oui
        */
        $qb = $this->createQueryBuilder('a')
        ->select('SUM(a.ponderation) as nb')
        // Étant donné que le calcul se fait sur la table answer uniquement, les jointures semblent inutiles
        // ->innerJoin('a.question', 'q')
        // ->innerJoin('q.category', 'c')
        ->where('a.body = :body')
        ->setParameter('body', 'Oui');
        return $qb->getQuery()->getScalarResult();
    }

    public function save(Answer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Answer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
