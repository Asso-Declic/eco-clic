<?php

namespace App\Repository;

use App\Entity\Collectivite;
use App\Entity\CollectiviteStatus;
use App\Entity\Recommandation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CollectiviteStatus>
 *
 * @method CollectiviteStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectiviteStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectiviteStatus[]    findAll()
 * @method CollectiviteStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectiviteStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectiviteStatus::class);
    }

    public function updateCode(Collectivite $collectivite, Recommandation $recommandation, string $code): void
    {
        /* Requête d'origine
        UPDATE utilisateurStatut
        SET StatutCode = :statutId
        WHERE RecommandationId = :Id
        AND UtilisateurId = :CollectiviteId
        */
        dd($this->createQueryBuilder('cs')
            ->update()
            ->set('cs.code', ':code')
            ->where('cs.recommandation = :recommandation')
            ->andWhere('cs.collectivite = :collectivite')
            ->setParameter('code', $code)
            ->setParameter('recommandation', $recommandation)
            ->setParameter('collectivite', $collectivite)
            ->setMaxResults(1)
            ->getQuery()
            ->execute());
    }

    public function save(CollectiviteStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CollectiviteStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CollectiviteStatus[] Returns an array of CollectiviteStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('cs')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CollectiviteStatus
//    {
//        return $this->createQueryBuilder('cs')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}