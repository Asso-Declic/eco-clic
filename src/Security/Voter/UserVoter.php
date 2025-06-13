<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    public const ADD = 'USER_ADD';
    public const DEACTIVATE = 'USER_DEACTIVATE';
    public const DELETE = 'USER_DELETE';
    public const UPDATE = 'USER_UPDATE';
    public const UPDATE_LEVEL_TWO = 'USER_UPDATE_LEVEL_TWO';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [
            self::ADD,
            self::DEACTIVATE,
            self::DELETE,
            self::UPDATE,
            self::UPDATE_LEVEL_TWO,
        ])
            && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::ADD:
                return $this->canAdd($subject, $user);
                break;
            case self::DEACTIVATE:
                return $this->canDeactivate($subject, $user);
                break;
            case self::UPDATE:
                return $this->canUpdate($subject, $user);
                break;
            case self::UPDATE_LEVEL_TWO:
                return $this->canUpdateLevelTwo($subject, $user);
                break;
            case self::DELETE:
                return $this->canDelete($subject, $user);
                break;
        }

        return false;
    }

    private function canAdd(User $subject, User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        if ($user->isAdminOpsn()) {
            return true;
        }

        if ($user->isAdminCollectivite()) {
            return true;
        }

        return false;
    }

    private function canDeactivate(User $subject, User $user): bool
    {
        // Si l'utilisateur tente de se désactiver on l'empêche
        if ($user == $subject) {
            return false;
        }

        return $this->canModify($subject, $user);
    }

    private function canModify(User $subject, User $user): bool
    {
        // Pour un super admin
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Pour un utilisateur qui est admin de l'OPSN de la collectivité
        if ($user->isAdminOpsn() && $user->getOpsn() == $subject->getOpsn()) {
            return true;
        }

        // Pour un utilisateur qui est admin de sa collectivité
        if ($user->isAdminCollectivite() && $user->getCollectivite() == $subject->getCollectivite()) {
            return true;
        }

        return false;
    }

    private function canDelete(User $subject, User $user): bool
    {
        return $this->canModify($subject, $user);
    }

    private function canUpdate(User $subject, User $user): bool
    {
        // Si l'utilisateur tente de se modifier on l'autorise
        if ($user == $subject) {
            return true;
        }
        return $this->canModify($subject, $user);
    }

    private function canUpdateLevelTwo(User $subject, User $user): bool
    {
        // Pour un super admin
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Pour un utilisateur qui est admin de l'OPSN de la collectivité
        if ($user->isAdminOpsn() && $user->getOpsn() == $subject->getOpsn()) {
            return true;
        }
    }
}
