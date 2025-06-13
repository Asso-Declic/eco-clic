<?php

namespace App\EventListener;

use App\Entity\Log;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationListener
{
    public function __construct(EntityManagerInterface $em, AuthenticationUtils $authenticationUtils)
    {
        $this->em = $em;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * onAuthenticationFailure
     *
     * @param LoginFailureEvent $event
     */
    public function onAuthenticationFailure(LoginFailureEvent $event)
    {
        $username = $this->authenticationUtils->getLastUsername();
        if ($username != "") {
            $user = $this->em->getRepository(User::class)->findOneBy([
                'username' => $username,
            ]);

            if ($user == null) {
                $userid = "inconnu";
            } else {
                $userid = $user->getId();
            }
            
            $this->saveLogin($username, $userid, "connexion echoué");
        }
        
    }

    /**
     * onAuthenticationSuccess
     *
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $username = $event->getAuthenticationToken()->getUser()->getUsername();
        $user = $this->em->getRepository(User::class)->findOneBy([
            'username' => $username,
        ]);
        
        $this->saveLogin($username, $user->getId(), "connexion");
    }

    /**
     *
     * @param $type
     * @param $username
     */
    private function saveLogin($username, $userid, $type) {
        $login = new Log();
        $login->setUsername($username);
        $login->setUserid($userid);
        $login->setType($type);

        $this->em->persist($login);
        $this->em->flush();
    }
}