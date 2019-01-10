<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table(name="game")
 * @package App\Entity
 */
class Game {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int $id;
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
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

}