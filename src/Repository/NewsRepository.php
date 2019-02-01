<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\News;
use Doctrine\ORM\EntityRepository;

/**
 * Class NewsRepository
 * @package App\Repository
 */
class NewsRepository extends EntityRepository
{
    /**
     * @param string $order
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | News[]
     */
    public function fetchPublishedNews($order = 'DESC', $queryMode = false) {
         $query = $this->createQueryBuilder('news')
            ->where('news.published = true')
            ->orderBy('news.createdAt', $order)
            ->getQuery();

         if($queryMode) {
             return $query;
         } else {
             return $query->execute();
         }
    }
}