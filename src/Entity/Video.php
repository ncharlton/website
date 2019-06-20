<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class Video
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 * @ORM\Table(name="video")
 */
class Video
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
    private $title;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"title"})
     *
     * @Serializer\Groups({"video"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"video"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Serializer\Groups({"video"})
     */
    private $published;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\YoutubeVideo")
     *
     * @Serializer\Groups({"video"})
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VideoPlaylist", inversedBy="videos")
     *
     * @Serializer\Groups({"video"})
     */
    private $playlist;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="videos")
     * @ORM\JoinColumn(name="video_tags")
     * @ORM\OrderBy({"tag" = "ASC"})
     *
     * @Serializer\Groups({"video"})
     */
    private $tags;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     *
     * @Serializer\Groups({"video"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     */
    public function setPublished($published): void
    {
        $this->published = $published;
    }

    /**
     * @return YoutubeVideo
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param YoutubeVideo $video
     */
    public function setVideo($video): void
    {
        $this->video = $video;
    }

    /**
     * @return VideoPlaylist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param VideoPlaylist $playlist
     */
    public function setPlaylist($playlist): void
    {
        $this->playlist = $playlist;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag) {
        if(!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag) {
        if($this->tags->contains($tag)) {
            $this->tags->remove($tag);
        }
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}