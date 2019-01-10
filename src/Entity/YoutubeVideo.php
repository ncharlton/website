<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $etag;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $channelId;

    /**
     * @ORM\Column(type="string")
     */
    private $channelTitle;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoThumbnail", mappedBy="video")
     */
    private $thumbnails;


    private $tags;

    /**
     * @ORM\Column(type="string")
     */
    private $duration;

    /**
     * @ORM\Column(type="string")
     */
    private $definition;

    /**
     * @ORM\Column(type="string")
     */
    private $embeddable;

    /**
     * @ORM\Column(type="bigint")
     */
    private $viewCount;

    /**
     * @ORM\Column(type="bigint")
     */
    private $likeCount;

    /**
     * @ORM\Column(type="bigint")
     */
    private $dislikeCount;

    /**
     * @ORM\Column(type="bigint")
     */
    private $commentCount;

    /**
     * @ORM\Column(type="string")
     */
    private $embedHtml;

    /**
     * @ORM\Column(type="bigint")
     */
    private $embedHeight;

    /**
     * @ORM\Column(type="bigint")
     */
    private $embedWidth;

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
     * @return mixed
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

    /**
     * @return mixed
     */
    public function getEmbedHeight()
    {
        return $this->embedHeight;
    }

    /**
     * @param mixed $embedHeight
     */
    public function setEmbedHeight($embedHeight): void
    {
        $this->embedHeight = $embedHeight;
    }

    /**
     * @return mixed
     */
    public function getEmbedWidth()
    {
        return $this->embedWidth;
    }

    /**
     * @param mixed $embedWidth
     */
    public function setEmbedWidth($embedWidth): void
    {
        $this->embedWidth = $embedWidth;
    }
}