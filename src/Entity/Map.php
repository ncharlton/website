<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Map
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 * @ORM\Table(name="map")
 * @Vich\Uploadable()
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $download;

    /**
     * @Vich\UploadableField(
     *     mapping="map_image",
     *     fileNameProperty="imageName",
     *     size="imageSize"
     * )
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @Vich\UploadableField(
     *     mapping="map_download",
     *     fileNameProperty="downloadName",
     *     size="downloadSize"
     * )
     *
     * @var File
     */
    private $downloadFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $downloadName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $downloadSize;

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
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     *
     * @var \DateTime
     */
    private $updatedAt;

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

    /**
     * @var MapDetail
     * @ORM\OneToOne(targetEntity="App\Entity\MapDetail")
     */
    private $mapDetail;

    /**
     * @var Game|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="maps")
     */
    private $game;

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
     * @param File|UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if(null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    /**
     * @param File|UploadedFile $downloadFile
     */
    public function setDownloadFile(?File $downloadFile = null): void
    {
        $this->downloadFile = $downloadFile;

        if(null !== $downloadFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDownloadFile(): ?File
    {
        return $this->downloadFile;
    }

    public function getDownloadName(): ?string
    {
        return $this->downloadName;
    }

    public function setDownloadName(?string $downloadName): void
    {
        $this->downloadName = $downloadName;
    }

    public function getDownloadSize(): ?int
    {
        return $this->downloadSize;
    }

    public function setDownloadSize(?int $downloadSize): void
    {
        $this->downloadSize = $downloadSize;
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

    /**
     * @return MapDetail|null
     */
    public function getMapDetail(): ?MapDetail
    {
        return $this->mapDetail;
    }

    /**
     * @param MapDetail $mapDetail
     */
    public function setMapDetail(MapDetail $mapDetail): void
    {
        $this->mapDetail = $mapDetail;
    }

    /**
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game|null $game
     */
    public function setGame(?Game $game): void
    {
        $this->game = $game;
    }
}
