<?php

namespace App\Repository;

use App\Entity\Collectivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Collectivite>
 *
 * @method Collectivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collectivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collectivite[]    findAll()
 * @method Collectivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collectivite::class);
    }

    public function findInfos(Collectivite $collectivite)
    {
        /*
            Requête d'origine
            SELECT collectivite.Id, collectivite.Siret, collectivite.Nom, `DepartementCode` as Departement, ref_TypeCollectivite.Nom as Type FROM `collectivite` 
            INNER JOIN ref_TypeCollectivite ON ref_TypeCollectivite.Id = collectivite.TypeId WHERE collectivite.Id = :id");
            $req->execute(array(":id" => $Id));

            Ça passait dans cette boucle
            while ($row = $req->fetch(PDO::FETCH_OBJ)) {
                $row->Nom = AjaxHelper::ToUtf8($row->Nom);
                $result[] = $row;
            }
        */
        $qb = $this->createQueryBuilder('c')
        ->addSelect('t.label type')
        ->innerJoin('c.type', 't')
        ->where('c = :collectivite')
        ->setParameter('collectivite', $collectivite);
        
        return $qb->getQuery()->getScalarResult();
    }

    /**
     * 
     */
    public function findProgression(Collectivite $collectivite)
        {
            /* Requête d'origine
                SELECT
                    categorie.Id as CategorieId,
                    utilisateurReponse.CollectiviteId as UtilisateurId,
                    count(DISTINCT(utilisateurReponse.IdQuestion)) as NbRepondu
                FROM `utilisateurReponse` 
                INNER JOIN question
                INNER JOIN categorie
                WHERE utilisateurReponse.IdQuestion = question.Id
                AND question.IdCategorie = categorie.Id
                AND utilisateurReponse.CollectiviteId = :CollectiviteId
                GROUP BY categorie.Id
            */
            $qb = $this->createQueryBuilder('coll');
            $qb->select('c.id category_id')
            ->addSelect($qb->expr()->countDistinct('c.id') . ' AS nb_repondu')
            ->innerJoin('coll.collectiviteAnswers', 'ca')
            ->innerJoin('ca.answer', 'a')
            ->innerJoin('a.question', 'q')
            ->innerJoin('q.category', 'c')
            ->where('ca.collectivite = :collectivite')
            ->groupBy('c.id')
            ->setParameter('collectivite', $collectivite);
            return $qb->getQuery()->getScalarResult();
        }
    
    public function save(Collectivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Collectivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Collectivite[] Returns an array of Collectivite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Collectivite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
