<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class VideoThumbnail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="video_thumbnail")
 */
class VideoThumbnail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\YoutubeVideo", inversedBy="thumbnails")
     */
    private $video;

    /**
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     */
    private $width;

    /**
     * @ORM\Column(type="string")
     */
    private $height;

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
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param YoutubeVideo $video
     */
    public function setVideo(YoutubeVideo $video): void
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }
}