<?php

namespace App\Repository;

use App\Entity\TemporarySiret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemporarySiret>
 *
 * @method TemporarySiret|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemporarySiret|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemporarySiret[]    findAll()
 * @method TemporarySiret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemporarySiretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemporarySiret::class);
    }

    public function save(TemporarySiret $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TemporarySiret $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
