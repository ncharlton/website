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
    public function fetchPublishedPlaylists($queryMode = false) {
        $query = $this->createQueryBuilder('video_playlist')
            ->select('video_playlist')
            ->innerJoin('video_playlist.videos', 'videos')
            ->andWhere('videos.published = true')
            ->andWhere('video_playlist.published = true')
            ->getQuery();

        if($queryMode) {
            return $query;
        } else {
            return $query->execute();
        }
    }
}