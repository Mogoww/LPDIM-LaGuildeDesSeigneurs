<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Player;


class PlayerVoter extends Voter
{
    public const PLAYER_DISPLAY = 'playerDisplay';
    public const PLAYER_CREATE = 'playerCreate';
    public const PLAYER_INDEX = 'playerIndex';
    public const PLAYER_MODIFY = 'playerModify';
    public const PLAYER_DELETE = 'playerDelete';




    private const ATTRIBUTES = array(
        self::PLAYER_DISPLAY,
        self::PLAYER_CREATE,
        self::PLAYER_INDEX,
        self::PLAYER_MODIFY,
        self::PLAYER_DELETE,

    );

    protected function supports(string $attribute, $subject): bool
    {

        if (null !== $subject) {
            return $subject instanceof Player && in_array($attribute, self::ATTRIBUTES);
        }

        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, self::ATTRIBUTES);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::PLAYER_DISPLAY:
            case self::PLAYER_INDEX:
                return $this->canDisplay();
                break;
            case self::PLAYER_CREATE:
                return $this->canCreate();
                break;
            case self::PLAYER_MODIFY:
                return $this->canModify();
                break;
            case self::PLAYER_DELETE:
                return $this->canDelete();
                break;
        }

        throw new LogicException('Invalid attribute : ' . $attribute);
    }

    /*
    * Checks if is allowed to display
    */
    private function canDisplay()
    {
        return true;
    }

    /*
    * Checks if is allowed to create
    */
    private function canCreate()
    {
        return true;
    }

    /*
    * Checks if is allowed to modify
    */
    private function canModify()
    {
        return true;
    }

    /*
    * Checks if is allowed to delete
    */
    private function canDelete()
    {
        return true;
    }
}
