<?php

namespace App\Repository;

use App\Entity\OPSN;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OPSN>
 *
 * @method OPSN|null find($id, $lockMode = null, $lockVersion = null)
 * @method OPSN|null findOneBy(array $criteria, array $orderBy = null)
 * @method OPSN[]    findAll()
 * @method OPSN[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OPSNRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OPSN::class);
    }

    public function save(OPSN $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OPSN $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
