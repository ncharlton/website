<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Clip
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\ClipRepository")
 * @ORM\Table(name="clip")
 *
 * @UniqueEntity("twitchId")
 * @UniqueEntity("url")
 * @UniqueEntity("title")
 * @UniqueEntity("slug")
 */
class Clip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $twitchId;

    /**
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     */
    private $embedUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $creatorId;

    /**
     * @ORM\Column(type="string")
     */
    private $creatorName;

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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $submittedAt;

    /**
     * @ORM\Column(type="string")
     */
    private $thumbnailUrl;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $views;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="clips")
     * @Gedmo\Blameable(on="create")
     */
    private $user;

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
    public function getTwitchId()
    {
        return $this->twitchId;
    }

    /**
     * @param mixed $twitchId
     */
    public function setTwitchId($twitchId): void
    {
        $this->twitchId = $twitchId;
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
    public function getEmbedUrl()
    {
        return $this->embedUrl;
    }

    /**
     * @param mixed $embedUrl
     */
    public function setEmbedUrl($embedUrl): void
    {
        $this->embedUrl = $embedUrl;
    }

    /**
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * @param mixed $creatorId
     */
    public function setCreatorId($creatorId): void
    {
        $this->creatorId = $creatorId;
    }

    /**
     * @return mixed
     */
    public function getCreatorName()
    {
        return $this->creatorName;
    }

    /**
     * @param mixed $creatorName
     */
    public function setCreatorName($creatorName): void
    {
        $this->creatorName = $creatorName;
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
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * @param mixed $submittedAt
     */
    public function setSubmittedAt($submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }

    /**
     * @return mixed
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param mixed $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views): void
    {
        $this->views = $views;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}