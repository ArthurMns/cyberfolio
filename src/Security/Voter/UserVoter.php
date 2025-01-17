<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserVoter extends Voter
{
    // Définir les permissions prises en charge
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['EDIT']) && $subject instanceof User;
    }

    // Logique d'autorisation
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Vérifiez si l'utilisateur est connecté
        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var User $subject */

        // Autoriser uniquement si l'utilisateur essaie de modifier son propre compte
        switch ($attribute) {
            case 'EDIT':
                return $user === $subject; // Vérifie si l'utilisateur connecté est le même que l'utilisateur à modifier
        }

        return false;
    }
}
