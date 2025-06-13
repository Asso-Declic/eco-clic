<?php

namespace App\Repository;

use App\Entity\Collectivite;
use App\Entity\Population;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Population>
 *
 * @method Population|null find($id, $lockMode = null, $lockVersion = null)
 * @method Population|null findOneBy(array $criteria, array $orderBy = null)
 * @method Population[]    findAll()
 * @method Population[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PopulationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Population::class);
    }

    public function findForCollectivite(Collectivite $collectivite): ?Population
    {
        $qb = $this->createQueryBuilder('p');

        $qb->leftJoin('p.collectiviteType', 'ct')
            ->leftJoin('ct.collectivites', 'c')
            ->where('c = :collectivite')
            ->andWhere($qb->expr()->lt('p.min', $collectivite->getPopulation()))
            ->andWhere($qb->expr()->gt('p.max', $collectivite->getPopulation()))
            ->setParameter('collectivite', $collectivite);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Population $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Population $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
