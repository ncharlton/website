<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\Clip;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class ClipRepository
 * @package App\Repository
 */
class ClipRepository extends EntityRepository
{
    /**
     * @param bool $queryMode
     * @return Query | Clip[]
     */
    public function fetchNewest(bool $queryMode = false) {
        $query = $this->createQueryBuilder('clip')
            ->orderBy('clip.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}