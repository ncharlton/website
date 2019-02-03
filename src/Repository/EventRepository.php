<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityRepository;

/**
 * Class EventRepository
 * @package App\Repository
 */
class EventRepository extends EntityRepository
{
    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | Event[]
     */
    public function fetchNewest($queryMode = false) {
        $query = $this->createQueryBuilder('event')
            ->orderBy('event.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }

    /**
     * @param bool $queryMode
     * @param string $order
     * @return \Doctrine\ORM\Query | Event[]
     */
    public function fetchPublished($queryMode = false, $order = 'DESC') {
        $query = $this->createQueryBuilder('event')
            ->andWhere('event.published = true')
            ->orderBy('event.createdAt', $order)
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}