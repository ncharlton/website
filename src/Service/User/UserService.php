<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserService
 * @package App\Service\User
 */
class UserService
{
    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $twitchUser
     * @param $twitchTokens
     *
     * @return User
     */
    public function registerUser(array $twitchUser, array $twitchTokens) {
        $user = new User();
        $user->setTwitchId($twitchUser['twitchId']);
        $user->setUsername($twitchUser['twitchUsername']);
        $user->setEmail($twitchUser['twitchEmail']);
        $user->setStatus(0);
        $user->setAccessToken($twitchTokens['accessToken']);
        $user->setRefreshToken($twitchTokens['refreshToken']);
        //$user->setTokenExpire($twitchTokens['expiresIn']);

        try {
            $this->em->persist($user);
            $this->em->flush();

            return $user;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function updateUser() {

    }
}