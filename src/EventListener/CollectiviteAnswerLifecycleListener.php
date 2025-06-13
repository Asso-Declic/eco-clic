<?php

namespace App\EventListener;

use App\Entity\Collectivite;
use App\Entity\CollectiviteAnswer;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class CollectiviteAnswerLifecycleListener
{
    public function prePersist(CollectiviteAnswer $collectiviteAnswer, PrePersistEventArgs $args)
    {
        $collectivite = $collectiviteAnswer->getCollectivite();
        $this->updateCollectiviteAnsweredAt($collectivite);
    }

    public function preUpdate(CollectiviteAnswer $collectiviteAnswer, PreUpdateEventArgs $args)
    {
        $collectivite = $collectiviteAnswer->getCollectivite();
        $this->updateCollectiviteAnsweredAt($collectivite);
    }

    private function updateCollectiviteAnsweredAt(Collectivite $collectivite)
    {
        if ($collectivite->getFirstAnsweredAt() === null) {
            $collectivite->setFirstAnsweredAt(new \DateTimeImmutable());
        }
        $collectivite->setLastAnsweredAt(new \DateTimeImmutable());
    }
}