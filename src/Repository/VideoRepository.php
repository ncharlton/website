<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\Video;
use Doctrine\ORM\EntityRepository;

/**
 * Class VideoRepository
 * @package App\Repository
 */
class VideoRepository extends EntityRepository
{
    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | Video[]
     */
    public function fetchNewest($queryMode = false) {
        $query = $this->createQueryBuilder('video')
            ->orderBy('video.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}