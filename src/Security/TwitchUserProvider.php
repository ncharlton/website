<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class TwitchUserProvider
 * @package App\Security
 */
class TwitchUserProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param string $username
     * @return UserInterface|UsernameNotFoundException
     * @throws UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository('App:User')
            ->fetchUserByUsername($username);

        if($user && $user instanceof User)
        {
            return $user;
        } else
        {
            throw new UsernameNotFoundException('User doesnt exist');
        }
    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     * @throws UnsupportedUserException
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User)
        {
            throw new UnsupportedUserException('Invalid user class "%s".', get_class($user));
        }

        $this->loadUserByUsername($user);
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}