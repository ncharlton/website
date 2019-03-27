<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\Page;
use Doctrine\ORM\EntityRepository;

/**
 * Class PageRepository
 * @package App\Repository
 */
class PageRepository extends EntityRepository
{
    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | Page[]
     */
    public function fetchNewest($queryMode = false) {
        $query = $this->createQueryBuilder('page')
            ->orderBy('page.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}