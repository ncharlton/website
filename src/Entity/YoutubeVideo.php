<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class YoutubeVideo
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="youtube_video")
 */
class YoutubeVideo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"video"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $youtubeId;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $etag;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Serializer\Groups({"video"})
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"video"})
     */
    private $channelId;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $channelTitle;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoThumbnail", mappedBy="video", cascade={"persist"})
     *
     * @Serializer\Groups({"video"})
     */
    private $thumbnails;


    private $tags;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $duration;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $definition;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $embeddable;

    /**
     * @ORM\Column(type="bigint")
     *
     * @Serializer\Groups({"video"})
     */
    private $viewCount;

    /**
     * @ORM\Column(type="bigint")
     * @Serializer\Groups({"video"})
     */
    private $likeCount;

    /**
     * @ORM\Column(type="bigint")
     *
     * @Serializer\Groups({"video"})
     */
    private $dislikeCount;

    /**
     * @ORM\Column(type="bigint")
     *
     * @Serializer\Groups({"video"})
     */
    private $commentCount;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $embedHtml;

    public function __construct()
    {
        $this->thumbnails = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * @param mixed $youtubeId
     */
    public function setYoutubeId($youtubeId): void
    {
        $this->youtubeId = $youtubeId;
    }


    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @param mixed $etag
     */
    public function setEtag($etag): void
    {
        $this->etag = $etag;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param mixed $channelId
     */
    public function setChannelId($channelId): void
    {
        $this->channelId = $channelId;
    }

    /**
     * @return mixed
     */
    public function getChannelTitle()
    {
        return $this->channelTitle;
    }

    /**
     * @param mixed $channelTitle
     */
    public function setChannelTitle($channelTitle): void
    {
        $this->channelTitle = $channelTitle;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection|VideoThumbnail[]
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }

    /**
     * @param mixed $thumbnails
     */
    public function setThumbnails($thumbnails): void
    {
        $this->thumbnails = $thumbnails;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param mixed $definition
     */
    public function setDefinition($definition): void
    {
        $this->definition = $definition;
    }

    /**
     * @return mixed
     */
    public function getEmbeddable()
    {
        return $this->embeddable;
    }

    /**
     * @param mixed $embeddable
     */
    public function setEmbeddable($embeddable): void
    {
        $this->embeddable = $embeddable;
    }

    /**
     * @return mixed
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param mixed $viewCount
     */
    public function setViewCount($viewCount): void
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return mixed
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param mixed $likeCount
     */
    public function setLikeCount($likeCount): void
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return mixed
     */
    public function getDislikeCount()
    {
        return $this->dislikeCount;
    }

    /**
     * @param mixed $dislikeCount
     */
    public function setDislikeCount($dislikeCount): void
    {
        $this->dislikeCount = $dislikeCount;
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * @param mixed $commentCount
     */
    public function setCommentCount($commentCount): void
    {
        $this->commentCount = $commentCount;
    }

    /**
     * @return mixed
     */
    public function getEmbedHtml()
    {
        return $this->embedHtml;
    }

    /**
     * @param mixed $embedHtml
     */
    public function setEmbedHtml($embedHtml): void
    {
        $this->embedHtml = $embedHtml;
    }

    public function smallestThumbnail() {
        /** @var VideoThumbnail $thumbnail */
        foreach($this->thumbnails->toArray() as $thumbnail) {
            if($thumbnail->getWidth() == '120') {
                return $thumbnail;
            }
        }
    }

    public function smallThumbnail() {
        /** @var VideoThumbnail $thumbnail */
        foreach($this->thumbnails->toArray() as $thumbnail) {
            if($thumbnail->getWidth() == '320') {
                return $thumbnail;
            }
        }
    }

    public function mediumThumbnail() {
        /** @var VideoThumbnail $thumbnail */
        foreach($this->thumbnails->toArray() as $thumbnail) {
            if($thumbnail->getWidth() == '480') {
                return $thumbnail;
            }
        }
    }

    public function bigThumbnail() {
        /** @var VideoThumbnail $thumbnail */
        foreach($this->thumbnails->toArray() as $thumbnail) {
            if($thumbnail->getWidth() == '640') {
                return $thumbnail;
            }
        }
    }

    public function biggestThumbnail() {
        /** @var VideoThumbnail $thumbnail */
        foreach($this->thumbnails->toArray() as $thumbnail) {
            if($thumbnail->getWidth() == '1280') {
                return $thumbnail;
            }
        }
    }

    public function getFormattedDuration() {
        $youtube_time = $this->getDuration();
        preg_match_all('/(\d+)/',$youtube_time,$parts);

        // Put in zeros if we have less than 3 numbers.
        if (count($parts[0]) == 1) {
            array_unshift($parts[0], "0", "0");
        } elseif (count($parts[0]) == 2) {
            array_unshift($parts[0], "0");
        }

        $sec_init = $parts[0][2];
        $seconds = $sec_init%60;
        $seconds_overflow = floor($sec_init/60);

        $min_init = $parts[0][1] + $seconds_overflow;
        $minutes = ($min_init)%60;
        $minutes_overflow = floor(($min_init)/60);

        $hours = $parts[0][0] + $minutes_overflow;

        if($hours != 0)
            return $hours.':'.$minutes.':'.$seconds;
        else
            return $minutes.':'.$seconds;
    }
}