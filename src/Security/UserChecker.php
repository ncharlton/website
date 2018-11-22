<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserChecker
 * @package App\Security
 */
class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if(!$user instanceof User) {
            return;
        }

        if($user->isBlocked()) {
            throw new CustomUserMessageAuthenticationException(
                'Your account is blocked. Sorry bro!'
            );
        }

        if($user->isBanned()) {
            throw new CustomUserMessageAuthenticationException(
                'Your account is banned!'
            );
        }
    }

    public function checkPostAuth(UserInterface $user)
    {

    }

}