<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Repository;

use App\Entity\VideoPlaylist;
use Doctrine\ORM\EntityRepository;

/**
 * Class VideoPlaylistRepository
 * @package App\Repository
 */
class VideoPlaylistRepository extends EntityRepository
{
    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | VideoPlaylist[]
     */
    public function fetchPublishedPlaylistsOrderByPosition($queryMode = false) {
        $query = $this->createQueryBuilder('video_playlist')
            ->select('video_playlist')
            ->innerJoin('video_playlist.videos', 'videos')
            ->andWhere('videos.published = true')
            ->andWhere('video_playlist.published = true')
            ->orderBy('video_playlist.orderNumber', 'ASC')
            ->orderBy('video_playlist.title', 'ASC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }

    /**
     * @param bool $queryMode
     * @return \Doctrine\ORM\Query | VideoPlaylist[]
     */
    public function fetchOrderByPosition($queryMode = false) {
        $query = $this->createQueryBuilder('video_playlist')
            ->select('video_playlist')
            ->orderBy('video_playlist.orderNumber', 'ASC')
            ->orderBy('video_playlist.title', 'ASC')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}