<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Map
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 * @ORM\Table(name="map")
 */
class Map
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
    private $title;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $download;

    // TODO
    private $image;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $infos;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $published;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="maps", cascade={"persist"})
     * @ORM\JoinColumn(name="news_tags")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MapPack", mappedBy="maps")

     */
    private $mapPacks;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->mapPacks = new ArrayCollection();
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
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * @param mixed $download
     */
    public function setDownload($download): void
    {
        $this->download = $download;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * @param mixed $infos
     */
    public function setInfos($infos): void
    {
        $this->infos = $infos;
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
    public function getTags()
    {
        return $this->tags;
    }

    public function addTag(Tag $tag)
    {
        if(!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    public function removeTag(Tag $tag)
    {
        if($this->tags->contains($tag)) {
            $this->tags->remove($tag);
        }
    }

    public function setMapPacks($mapPacks) {
        $this->mapPacks = $mapPacks;
    }

    public function getMapPacks()
    {
        return $this->mapPacks;
    }

    public function addMapPack(MapPack $mapPack)
    {
        if(!$this->mapPacks->contains($mapPack)) {
            $this->mapPacks->add($mapPack);
        }
    }

    public function removeMapPack(MapPack $mapPack)
    {
        if($this->mapPacks->contains($mapPack)) {
            $this->mapPacks->remove($mapPack);
        }
    }
}
