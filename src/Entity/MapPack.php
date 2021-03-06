<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class MapPack
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\MapPackRepository")
 * @ORM\Table(name="map_pack")
 */
class MapPack
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
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $published;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Map", inversedBy="mapPacks")
     * @ORM\JoinColumn(name="maps_packs")
     */
    private $maps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="mapPack")
     */
    private $events;

    public function __construct()
    {
        $this->maps = new ArrayCollection();
        $this->events = new ArrayCollection();
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
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
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published): void
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getMaps()
    {
        return $this->maps;
    }

    public function setMaps($maps) {
        $this->maps = $maps;
    }

    public function addMap(Map $map)
    {
        if(!$this->maps->contains($map)) {
            $this->maps->add($map);
        }
    }

    public function removeMap(Map $map) {
        if($this->maps->contains($map)) {
            $this->maps->remove($map);
        }
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events): void
    {
        $this->events = $events;
    }

    public function addEvent(Event $event)
    {
        if(!$this->events->contains($event)) {
            $this->events->add($event);
        }
    }

    public function removeEvent(Event $event)
    {
        if($this->events->contains($event)) {
            $this->events->remove($event);
        }
    }
}