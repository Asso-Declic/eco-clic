<?php

namespace App\EventListener;

use App\Entity\Collectivite;
use App\Entity\CollectiviteType;
use App\Entity\Departement;
use App\Entity\OPSN;
use Doctrine\ORM\Event\PrePersistEventArgs;

class OPSNLifecycleListener
{
    public function prePersist(OPSN $opsn, PrePersistEventArgs $args)
    {
        $em = $args->getObjectManager();

        // À la création d'une OPSN, on lui crée une collectivité
        $typeAutre = $em->getRepository(CollectiviteType::class)->findOneBy(['label' => 'Autre']);
        $departement = $em->getRepository(Departement::class)->findOneBy(['code' => $opsn->getDepartement()]);
        // TODO, idée alternative : utiliser le InseeService pour récupérer plus d'infos sur l'opsn et les mettre dans sa collectivité. Ça nécessiterait cependant d'avoir le siret de l'OPSN dès sa création

        $collectivite = new Collectivite();
        $collectivite->setName($opsn->getName());
        $collectivite->setPopulation(0);
        $collectivite->setSiret($opsn->getSiret());
        $collectivite->setLatitude($opsn->getLatitude());
        $collectivite->setLongitude($opsn->getLongitude());
        $collectivite->setPostalCode($opsn->getDepartement() . '000');
        $collectivite->setDepartement($departement);
        $collectivite->setType($typeAutre);
        $collectivite->setOpsn($opsn);

        $em->persist($collectivite);
    }

}