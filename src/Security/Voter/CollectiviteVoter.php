<?php

namespace App\Security\Voter;

use App\Entity\Collectivite;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CollectiviteVoter extends Voter
{
    public const UPDATE_LEVEL_TWO = 'COLLECTIVITE_UPDATE_LEVEL_TWO';
    public const VIEW = 'COLLECTIVITE_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::UPDATE_LEVEL_TWO, self::VIEW])
            && $subject instanceof Collectivite;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::UPDATE_LEVEL_TWO:
                return $this->canUpdateLevelTwo($subject, $user);
                break;

            // case self::VIEW:
            //     // logic to determine if the user can VIEW
            //     // return true or false
            //     break;
        }

        return false;
    }

    private function canUpdateLevelTwo(Collectivite $collectivite, User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        dd($user->isAdminOpsn(), $user->getOpsn(), $collectivite->getOpsn());

        if ($user->isAdminOpsn() && $user->getOpsn() == $collectivite->getOpsn()) {
            return true;
        }

        return false;
    }
}
