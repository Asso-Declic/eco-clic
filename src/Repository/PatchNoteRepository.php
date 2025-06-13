<?php

namespace App\Repository;

use App\Entity\PatchNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<PatchNote>
 *
 * @method PatchNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatchNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatchNote[]    findAll()
 * @method PatchNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatchNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatchNote::class);
    }

    public function insert($patchNote)
    {
        // Create native query
        $rsm = new ResultSetMapping();

        $q = $this->getEntityManager()->createNativeQuery("INSERT INTO `patch_note`(`title`, `body`) VALUES (:Title, :Body); UPDATE `user` SET `is_vu`= 0", $rsm)

        ->setParameter('Title', $patchNote->getTitle())
        ->setParameter('Body', $patchNote->getBody());

        return $q->getResult();
    }
}
