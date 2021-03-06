<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table(name="game")
 * @package App\Entity
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Game {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     *
     * @var int $id;
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $summary;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $image;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Url()
     */
    private $buyLink;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Url()
     */
    private $website;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $developer;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="game")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Map", mappedBy="game")
     */
    private $maps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="game")
     */
    private $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getBuyLink()
    {
        return $this->buyLink;
    }

    /**
     * @param string $buyLink
     */
    public function setBuyLink(string $buyLink)
    {
        $this->buyLink = $buyLink;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @param string $developer
     */
    public function setDeveloper(string $developer)
    {
        $this->developer = $developer;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     */
    public function setPublisher(string $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return mixed
     */
    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos): void
    {
        $this->videos = $videos;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    public function addVideo(Video $video)
    {
        if(!$this->videos->contains($video)) {
            $this->videos->add($video);
        }
    }

    public function removeVideo(Video $video) {
        if($this->videos->contains($video)) {
            $this->videos->remove($video);
        }
    }
}