<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<Notification>
 *
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

   /**
    * @return Notification[] Returns an array of Notification objects
    */
   public function findByCol($collectiviteId)
   {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('collectivite_id', 'collectivite_id');
        $rsm->addScalarResult('category_id', 'category_id');
        $rsm->addScalarResult('posted_at', 'posted_at');
        $rsm->addScalarResult('name', 'name');

        $q = $this->getEntityManager()->createNativeQuery("SELECT notification.*, category.name FROM `notification` INNER JOIN category ON category.id = notification.category_id where collectivite_id = :collectivite_id", $rsm)

        ->setParameter('collectivite_id', $collectiviteId);

        return $q->getResult();
   }

   public function deleteNotification($notifId)
   {
        $rsm = new ResultSetMapping();
        $qb = $this->getEntityManager()->createNativeQuery("DELETE FROM `notification` WHERE id = :id", $rsm)
        ->setParameter('id', $notifId);

        return $qb->getResult();
   }

   public function deleteAllNotification($collectiviteId)
   {
        $rsm = new ResultSetMapping();
        $qb = $this->getEntityManager()->createNativeQuery("DELETE FROM `notification` WHERE collectivite_id = :collectiviteId", $rsm)
        ->setParameter('collectiviteId', $collectiviteId);

        return $qb->getResult();
   }
}
