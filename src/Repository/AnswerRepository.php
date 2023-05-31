<?php

namespace App\Repository;

use App\Entity\Answer;
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
