<?php

namespace App\EventListener;

use App\Entity\User;
use App\Service\MailingService;
use Doctrine\ORM\Event\PrePersistEventArgs;

class UserLifecycleListener
{
    public function __construct(
        private MailingService $mailingService,
    ) {}

    /**
     * On envoie l'email pour toute création d'utilisateur
     *
     * @param User $user
     * @param PrePersistEventArgs $args
     * @return void
     */
    public function prePersist(User $user, PrePersistEventArgs $args)
    {
        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $user->setToken($token);

        $this->mailingService->InscriptionUtilisateur($user->getEmail(), $user->getToken());
    }
}