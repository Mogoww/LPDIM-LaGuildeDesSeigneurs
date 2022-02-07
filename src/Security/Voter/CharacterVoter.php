<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Character;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Charset;
use LogicException;

class CharacterVoter extends Voter
{
    public const CHARACTER_DISPLAY = 'characterDisplay';
    public const CHARACTER_CREATE = 'characterCreate';


    private const ATTRIBUTES = array(
        self::CHARACTER_DISPLAY,
        self::CHARACTER_CREATE,
    );

    protected function supports(string $attribute, $subject): bool
    {

        if (null !== $subject) {
            return $subject instanceof Character && in_array($attribute, self::ATTRIBUTES);
        }

        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, self::ATTRIBUTES);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::CHARACTER_DISPLAY:
                return $this->canDisplay();
                break;
            case self::CHARACTER_CREATE:
                return $this->canCreate();
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
}
