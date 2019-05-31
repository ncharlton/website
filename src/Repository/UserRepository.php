<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param int $limit
     * @return User[]
     */
    public function fetchNewestUsersWithLimit($limit = 10) {
        return $this->createQueryBuilder('user')
            ->orderBy('user.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->execute();
    }

    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | User[]
     */
    public function fetchNewest($queryMode = false) {
        $query = $this->createQueryBuilder('user')
            ->orderBy('user.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }

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