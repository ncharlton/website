<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MapRepository
 * @package App\Repository
 */
class MapRepository extends EntityRepository
{
    public function filter(array $load) {
        $q = $this->createQueryBuilder('map')
            ->innerJoin('map.mapDetail', 'mapDetail');

        if($load['start'] !== '') {
            $q->andWhere("mapDetail.start = :start");
            $q->setParameter('start', $load['start']);
        }

        if($load['scout'] !== '') {
            $q->andWhere("mapDetail.scout = :scout");
            $q->setParameter('scout', $load['scout']);
        }

        if($load['base'] !== '') {
            $q->andWhere("mapDetail.base = :base");
            $q->setParameter('base', $load['base']);
        }

        if($load['type'] !== '') {
            $q->andWhere("mapDetail.type = :type");
            $q->setParameter('type', $load['type']);
        }

        if($load['orderBy'] == 'title') {
            $q->orderBy('map.title', strtoupper($load['orderDirection']));
        }

        if($load['orderBy'] == 'created') {
            $q->orderBy('map.createdAt', strtoupper($load['orderDirection']));
        }

        return $q->getQuery()->execute();
    }
}