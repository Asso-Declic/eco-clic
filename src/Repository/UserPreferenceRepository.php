<?php

namespace App\Repository;

use App\Entity\UserPreference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserPreference>
 *
 * @method UserPreference|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPreference|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPreference[]    findAll()
 * @method UserPreference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPreferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPreference::class);
    }

    public function save(UserPreference $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserPreference $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
