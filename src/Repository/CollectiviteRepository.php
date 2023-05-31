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

    public function remove(Collectivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
