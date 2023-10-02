<?php

namespace App\Repository;

use App\Entity\RecommandationResource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecommandationResource>
 *
 * @method RecommandationResource|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommandationResource|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommandationResource[]    findAll()
 * @method RecommandationResource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommandationResource::class);
    }

}
