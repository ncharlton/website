<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @ORM\Table(name="tag")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="50")
     *
     * @Serializer\Expose()
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Gedmo\Slug(fields={"tag"})
     *
     * @Serializer\Expose()
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\News", mappedBy="tags")
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="tags")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Video", mappedBy="tags")
     */
    private $videos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\VideoPlaylist", mappedBy="tags")
     */
    private $playlists;

    public function __construct()
    {
        $this->news = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->playlists = new ArrayCollection();
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return ArrayCollection | News[]
     */
    public function getNews() {
        return $this->news;
    }

    public function addNews(News $news) {
        if(!$this->news->contains($news)) {
            $this->events->add($news);
        }
    }

    public function removeNews(News $news) {
        if($this->news->contains($news)) {
            $this->events->remove($news);
        }
    }

    /**
     * @return Collection | Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param Event $event
     */
    public function addEvent(Event $event) {
        if(!$this->events->contains($event)) {
            $this->events->add($event);
        }
    }

    /**
     * @param Event $event
     */
    public function removeEvent(Event $event) {
        if($this->events->contains($event)) {
            $this->events->remove($event);
        }
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Video $video
     */
    public function addVideo(Video $video) {
        if(!$this->videos->contains($video)) {
            $this->videos->add($video);
        }
    }

    /**
     * @param Video $video
     */
    public function removeVideo(Video $video) {
        if($this->videos->contains($video)) {
            $this->videos->remove($video);
        }
    }

    /**
     * @return ArrayCollection|VideoPlaylist[]
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * @param VideoPlaylist $playlist
     */
    public function addPlaylist(VideoPlaylist $playlist) {
        if(!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
        }
    }

    /**
     * @param VideoPlaylist $playlist
     */
    public function removePlaylist(VideoPlaylist $playlist) {
        if($this->playlists->contains($playlist)) {
            $this->playlists->remove($playlist);
        }
    }
}