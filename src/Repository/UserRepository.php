<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class UserRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return User
     *
     * Fetches user by id
     */
    public function fetchUserById(int $id) :User
    {
        $query = $this->createQueryBuilder('user')
            ->andWhere('user.id = :$id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery();

        return $query->execute();
    }

    /**
     * Fetches user by username
     *
     * @param $username
     * @return User
     */
    public function fetchUserByUsername($username) :User
    {
        $query = $this->createQueryBuilder('user')
            ->andWhere('user.username = :username')
            ->setParameter('username', $username)
            ->setMaxResults(1)
            ->getQuery();

        return $query->execute();
    }

    /**
     * Fetches user by twitch id
     *
     * @param integer $twitchId
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function fetchUserByTwitchId($twitchId) :User
    {
        $query = $this->createQueryBuilder('user')
            ->andWhere('user.twitchId = :twitchId')
            ->setParameter('twitchId', $twitchId)
            ->setMaxResults(1)
            ->getQuery();

        $query->getOneOrNullResult();
    }
}