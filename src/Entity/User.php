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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     *
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @var int $status
     *
     * 0 = active
     * 1 = disabled
     * 2 = banned
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @Assert\NotBlank()
     *
     * @var int $twitchId
     */
    private $twitchId;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\Email()
     *
     * @var string $email
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\NotBlank()
     *
     * @Serializer\Expose()
     *
     * @var string $username
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     *
     * @var string $accessToken
     */
    private $accessToken;

    /**
     * @ORM\Column(type="string")
     *
     * @var string $refreshToken
     */
    private $refreshToken;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int $tokenExpire
     */
    private $tokenExpire;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     *
     * @var \DateTime
     */
    private $lastActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Clip", mappedBy="user")
     */
    private $clips;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\News", mappedBy="author")
     */
    private $news;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="user")
     */
    private $events;

    public function __construct()
    {
        $this->clips = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getTwitchId()
    {
        return $this->twitchId;
    }

    /**
     * @param int $twitchId
     */
    public function setTwitchId(int $twitchId)
    {
        $this->twitchId = $twitchId;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return int
     */
    public function getTokenExpire()
    {
        return $this->tokenExpire;
    }

    /**
     * @param int $tokenExpire
     */
    public function setTokenExpire(int $tokenExpire)
    {
        $this->tokenExpire = $tokenExpire;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getLastActive()
    {
        return $this->lastActive;
    }

    /**
     * @param \DateTime $lastActive
     */
    public function setLastActive(\DateTime $lastActive)
    {
        $this->lastActive = $lastActive;
    }

    /**
     * @return ArrayCollection|Clip[]
     */
    public function getClips()
    {
        return $this->clips;
    }

    ////////////////////////////////////

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        $roles = $this->roles;

        if(!in_array('ROLE_USER', $roles))
        {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return bool Whether the user is active or not
     */
    public function isActiveNow() {
        $delay = new \DateTime('2 minutes ago');

        return ($this->getLastActive() > $delay);
    }

    public function getStatusWritten() {
        if ($this->status == 0) {
            return 'Allowed';
        }
        if ($this->status == 1) {
            return 'Banned';
        }
        if ($this->status == 2) {
            return 'Blocked';
        }
    }

    public function isBlocked() {
        if($this->status == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function isBanned() {
        if($this->status == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isAllowed() {
        if($this->status == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isSuperAdmin()
    {
        if(in_array('ROLE_SUPER_ADMIN', $this->roles)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        if(in_array('ROLE_ADMIN', $this->roles) || in_array('ROLE_SUPER_ADMIN', $this->roles)) {
            return true;
        } else {
            return false;
        }
    }

    public function isMod()
    {
        if(in_array(array('ROLE_MOD', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN') , $this->roles)) {
            return true;
        } else {
            return false;
        }
    }

    public function role()
    {
        if(in_array('ROLE_SUPER_ADMIN', $this->roles)) {
            return 'Super admin';
        }

        if(in_array('ROLE_ADMIN', $this->roles)) {
            return 'Admin';
        }

        if(in_array('ROLE_MOD', $this->roles)) {
            return 'Mod';
        }

        if(in_array('ROLE_USER', $this->roles)) {
            return 'User';
        }
    }
}