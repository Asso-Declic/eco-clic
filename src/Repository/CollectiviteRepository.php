<?php

namespace App\Repository;

use App\Entity\Collectivite;
use App\Entity\Population;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

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

    public function findInDepartementByPopulation(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c.id as collectiviteId')
        ->leftJoin('c.type', 'ct')
        ->leftJoin('ct.populations', 'p')
        ->where('c.departement = :departmentCode')
        ->andWhere($qb->expr()->lt('p.min', $collectivite->getPopulation()))
        ->andWhere($qb->expr()->gt('p.max', $collectivite->getPopulation()))
        ->setParameter('departmentCode', $collectivite->getDepartement()->getCode())
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function findInDepartementByType(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c.id as collectiviteId')
        ->leftJoin('c.type', 'ct')
        ->where('c.departement = :departmentCode')
        ->andWhere('ct = :type')
        ->setParameter('departmentCode', $collectivite->getDepartement()->getCode())
        ->setParameter('type', $collectivite->getType())
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function findInRegionByPopulation(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c.id as collectiviteId')
        ->leftJoin('c.type', 'ct')
        ->leftJoin('ct.populations', 'p')
        ->leftJoin('c.departement', 'd')
        ->where('d.region = :regionCode')
        ->andWhere($qb->expr()->lt('p.min', $collectivite->getPopulation()))
        ->andWhere($qb->expr()->gt('p.max', $collectivite->getPopulation()))
        ->setParameter('regionCode', $collectivite->getDepartement()->getRegion()->getCode())
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function findInRegionByType(Collectivite $collectivite)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c.id as collectiviteId')
        ->leftJoin('c.type', 'ct')
        ->leftJoin('c.departement', 'd')
        ->where('d.region = :regionCode')
        ->andWhere('ct = :type')
        ->setParameter('regionCode', $collectivite->getDepartement()->getRegion()->getCode())
        ->setParameter('type', $collectivite->getType())
        ;

        return $qb->getQuery()->getScalarResult();
    }

    public function findInNation()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c.id as collectiviteId')
        ;

        return $qb->getQuery()->getScalarResult();
    }   

    public function remove(Collectivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function download_CC_Thelloise()
    {
        // Create native query
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('Nom', 'Nom');
        $rsm->addScalarResult('progression', 'progression');
        $rsm->addScalarResult('niveaux_2', 'niveaux_2');
        $rsm->addScalarResult('score', 'score');
        $rsm->addScalarResult('OPSN', 'OPSN');

        $q = $this->getEntityManager()->createNativeQuery('WITH communes AS (
            SELECT "COMMUNE DE NEUILLY EN THELLE" AS name
            UNION ALL
            SELECT "COMMUNE DE ABBECOURT"
            UNION ALL
            SELECT "COMMUNE DE ANGY"
            UNION ALL
            SELECT "COMMUNE DE ANSACQ"
            UNION ALL
            SELECT "COMMUNE DE BALAGNY SUR THERAIN"
            UNION ALL
            SELECT "COMMUNE DE BELLE EGLISE"
            UNION ALL
            SELECT "COMMUNE DE BERTHECOURT"
            UNION ALL
            SELECT "COMMUNE DE CHAMBLY"
            UNION ALL
            SELECT "COMMUNE DE CIRES LES MELLO"
            UNION ALL
            SELECT "COMMUNE DE LE COUDRAY SUR THELLE"
            UNION ALL
            SELECT "COMMUNE DE CROUY EN THELLE"
            UNION ALL
            SELECT "COMMUNE DE DIEUDONNE"
            UNION ALL
            SELECT "COMMUNE DE ERCUIS"
            UNION ALL
            SELECT "COMMUNE DE FOULANGUES"
            UNION ALL
            SELECT "COMMUNE DE FRESNOY EN THELLE"
            UNION ALL
            SELECT "COMMUNE D\'HEILLES"
            UNION ALL
            SELECT "COMMUNE D\'HODENC L\'EVEQUE"
            UNION ALL
            SELECT "COMMUNE D\'HONDAINVILLE"
            UNION ALL
            SELECT "COMMUNE DE LACHAPELLE-SAINT-PIERRE"
            UNION ALL
            SELECT "COMMUNE DE MELLO"
            UNION ALL
            SELECT "COMMUNE DE LE MESNIL EN THELLE"
            UNION ALL
            SELECT "COMMUNE DE MOUCHY LE CHATEL"
            UNION ALL
            SELECT "COMMUNE DE NOAILLES"
            UNION ALL
            SELECT "COMMUNE DE NOVILLERS"
            UNION ALL
            SELECT "COMMUNE DE PONCHON"
            UNION ALL
            SELECT "COMMUNE DE PRECY SUR OISE"
            UNION ALL
            SELECT "COMMUNE DE PUISEUX LE HAUBERGER"
            UNION ALL
            SELECT "COMMUNE DE SAINT FELIX"
            UNION ALL
            SELECT "COMMUNE DE SAINT SULPICE"
            UNION ALL
            SELECT "COMMUNE DE SAINTE GENEVIEVE"
            UNION ALL
            SELECT "COMMUNE DE SILLY TILLARD"
            UNION ALL
            SELECT "COMMUNE DE THURY SOUS CLERMONT"
            UNION ALL
            SELECT "COMMUNE DE ULLY ST GEORGES"
            UNION ALL
            SELECT "COMMUNE DE VILLERS SAINT SEPULCRE"
            UNION ALL
            SELECT "COMMUNE DE VILLERS SOUS SAINT LEU"
            UNION ALL
            SELECT "COMMUNE DE BLAINCOURT-LES-PRECY"
            UNION ALL
            SELECT "COMMUNE DE CAUVIGNY"
            UNION ALL
            SELECT "COMMUNE DE MONTREUIL SUR THERAIN"
            UNION ALL
            SELECT "COMMUNE DE MORANGLES"
            UNION ALL
            SELECT "COMMUNE DE MORTEFONTAINE EN THELLE"
            UNION ALL
            SELECT "COMMUNE DE BORAN SUR OISE"
        )
        SELECT 
            communes.name AS Nom,
            COALESCE(
                (COUNT(DISTINCT ca.id) * 100) / (
                    SELECT SUM(t.nb) 
                    FROM (
                        SELECT COUNT(q.id) AS nb
                        FROM question q
                        WHERE q.parent_answer_id IN (
                            SELECT ca_inner.answer_id
                            FROM collectivite_answer ca_inner
                            INNER JOIN question q_inner ON q_inner.parent_answer_id = ca_inner.answer_id
                            WHERE ca_inner.collectivite_id = c.id 
                            AND q_inner.level_two = c.level_two
                        )
                        UNION ALL
                        SELECT COUNT(q.id) AS nb
                        FROM question q
                        WHERE q.parent_id IS NULL 
                        AND q.level_two = c.level_two
                        UNION ALL
                        SELECT COUNT(ca_inner.id) AS nb
                        FROM collectivite_answer ca_inner
                        INNER JOIN answer a ON a.id = ca_inner.answer_id
                        INNER JOIN question q ON a.question_id = q.id
                        WHERE ca_inner.collectivite_id = c.id
                        AND ca_inner.body != "" 
                        AND q.level_two = c.level_two
                    ) AS t
                ), 
                "Pas inscrit"
            ) AS progression,
            IF(c.level_two = 1, "Oui", "Non") AS niveaux_2,
            (
                SELECT CASE 
                    WHEN COALESCE(
                        (COUNT(DISTINCT ca.id) * 100) / (
                            SELECT SUM(t.nb) 
                            FROM (
                                SELECT COUNT(q.id) AS nb
                                FROM question q
                                WHERE q.parent_answer_id IN (
                                    SELECT ca_inner.answer_id
                                    FROM collectivite_answer ca_inner
                                    INNER JOIN question q_inner ON q_inner.parent_answer_id = ca_inner.answer_id
                                    WHERE ca_inner.collectivite_id = c.id 
                                    AND q_inner.level_two = c.level_two
                                )
                                UNION ALL
                                SELECT COUNT(q.id) AS nb
                                FROM question q
                                WHERE q.parent_id IS NULL 
                                AND q.level_two = c.level_two
                                UNION ALL
                                SELECT COUNT(ca_inner.id) AS nb
                                FROM collectivite_answer ca_inner
                                INNER JOIN answer a ON a.id = ca_inner.answer_id
                                INNER JOIN question q ON a.question_id = q.id
                                WHERE ca_inner.collectivite_id = c.id
                                AND ca_inner.body != "" 
                                AND q.level_two = c.level_two
                            ) AS t
                        ), 
                        0
                    ) = 100 THEN CASE 
                        WHEN s.score >= 99 THEN "A"
                        WHEN s.score < 99 AND s.score >= 80 THEN "B"
                        WHEN s.score < 80 AND s.score >= 60 THEN "C"
                        WHEN s.score < 60 AND s.score >= 40 THEN "D"
                        WHEN s.score < 40 THEN "E"
                        ELSE NULL
                    END
                    ELSE NULL
                END
                FROM score s
                WHERE s.collectivite_id = c.id 
                AND s.category_id IS NULL
                LIMIT 1
            ) AS score,
            opsn.name as OPSN
        FROM communes
        LEFT JOIN collectivite c ON communes.name = c.name
        LEFT JOIN opsn ON opsn.id = c.opsn_id
        LEFT JOIN collectivite_answer ca ON c.id = ca.collectivite_id
        GROUP BY communes.name, c.id, c.level_two', $rsm);

        return $q->getScalarResult();
    }
}
