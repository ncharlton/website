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
    public function fetchHighlight()
    {
        /**
         * @return News
         */
        return $this->createQueryBuilder('news')
            ->where('news.highlight = true')
            ->orderBy('news.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();
    }

    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | News[]
     */
    public function fetchNewest($queryMode = false) {
        $query = $this->createQueryBuilder('news')
            ->orderBy('news.createdAt', 'DESC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }

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