<?php

namespace App\Repository;

use App\Entity\RecommandationSuccessIndicator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationSuccessIndicator>
 *
 * @method RecommandationSuccessIndicator|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationSuccessIndicator|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationSuccessIndicator[]    findAll()
 * @method RecommandationSuccessIndicator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationSuccessIndicatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationSuccessIndicator::class);
    }

}
