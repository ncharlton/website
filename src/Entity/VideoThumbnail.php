<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     *
     * @Serializer\Groups({"video"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\YoutubeVideo", inversedBy="thumbnails")
     */
    private $video;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $width;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"video"})
     */
    private $orderNumber;

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

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param mixed $orderNumber
     */
    public function setOrderNumber($orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }
}