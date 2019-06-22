<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class MapDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="map_detail")
 *
 */
class MapDetail
{
    // basic
    const TYPE = ['land', 'water', 'mixed'];
    const START = ['nomad', 'town center', 'migration', 'random'];
    const BASE = ['open', 'walled', 'random'];
    const SCOUT = ['none', 'scout', 'animal', 'random'];

    // terrain
    const HILLS = ['none', 'few', 'normal', 'many'];
    const CLIFFS = ['none', 'few', 'normal', 'many'];
    const TERRAIN = ['grass', 'snow', 'mangroves', 'sand', 'mixed', 'random'];
    const WALLABLE = ['easy', 'normal', 'hard', 'random'];

    // ressources
    const SHORE_FISH = ['none', 'low', 'normal', 'high', 'random'];
    const DEEP_FISH = ['none', 'low', 'normal', 'high', 'random'];
    const WOOD = ['none', 'low', 'normal', 'high', 'random'];
    const GOLD = ['none', 'low', 'normal', 'high', 'random'];
    const STONE = ['none', 'low', 'normal', 'high', 'random'];
    const FOOD = ['none', 'low', 'normal', 'high', 'random'];
    const HUNT = ['none', 'low', 'normal', 'high', 'random'];
    const BERRIES = ['none', 'low', 'normal', 'high', 'random'];
    const RELICS = ['none', 'low', 'normal', 'high', 'random'];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"list"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $start;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $base;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $scout;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $shoreFish;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $deepFish;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $wood;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $gold;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $stone;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $food;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $hunt;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $berries;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $relics;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $hills;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $cliffs;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $terrain;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Groups({"list"})
     */
    private $wallable;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Serializer\Groups({"list"})
     */
    private $createdAt;

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
    public function getStart(): ?string
    {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart(string $start): void
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getScout(): ?string
    {
        return $this->scout;
    }

    /**
     * @param string $scout
     */
    public function setScout(string $scout): void
    {
        $this->scout = $scout;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getShoreFish(): ?string
    {
        return $this->shoreFish;
    }

    /**
     * @param string $shoreFish
     */
    public function setShoreFish(string $shoreFish): void
    {
        $this->shoreFish = $shoreFish;
    }

    /**
     * @return string
     */
    public function getDeepFish(): ?string
    {
        return $this->deepFish;
    }

    /**
     * @param string $deepFish
     */
    public function setDeepFish(string $deepFish): void
    {
        $this->deepFish = $deepFish;
    }

    /**
     * @return string
     */
    public function getWood(): ?string
    {
        return $this->wood;
    }

    /**
     * @param string $wood
     */
    public function setWood(string $wood): void
    {
        $this->wood = $wood;
    }

    /**
     * @return string
     */
    public function getGold(): ?string
    {
        return $this->gold;
    }

    /**
     * @param string $gold
     */
    public function setGold(string $gold): void
    {
        $this->gold = $gold;
    }

    /**
     * @return string
     */
    public function getStone(): ?string
    {
        return $this->stone;
    }

    /**
     * @return string
     */
    public function getFood(): ?string
    {
        return $this->food;
    }

    /**
     * @param string $food
     */
    public function setFood(string $food): void
    {
        $this->food = $food;
    }

    /**
     * @param string $stone
     */
    public function setStone(string $stone): void
    {
        $this->stone = $stone;
    }

    /**
     * @return string
     */
    public function getHunt(): ?string
    {
        return $this->hunt;
    }

    /**
     * @param string $hunt
     */
    public function setHunt(string $hunt): void
    {
        $this->hunt = $hunt;
    }

    /**
     * @return string
     */
    public function getBerries(): ?string
    {
        return $this->berries;
    }

    /**
     * @param string $berries
     */
    public function setBerries(string $berries): void
    {
        $this->berries = $berries;
    }

    /**
     * @return string
     */
    public function getRelics(): ?string
    {
        return $this->relics;
    }

    /**
     * @param string $relics
     */
    public function setRelics(string $relics): void
    {
        $this->relics = $relics;
    }

    /**
     * @return string
     */
    public function getHills(): ?string
    {
        return $this->hills;
    }

    /**
     * @param string $hills
     */
    public function setHills(string $hills): void
    {
        $this->hills = $hills;
    }

    /**
     * @return string
     */
    public function getCliffs(): ?string
    {
        return $this->cliffs;
    }

    /**
     * @param string $cliffs
     */
    public function setCliffs(string $cliffs): void
    {
        $this->cliffs = $cliffs;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getBase(): ?string
    {
        return $this->base;
    }

    /**
     * @param string $base
     */
    public function setBase(string $base): void
    {
        $this->base = $base;
    }

    /**
     * @return mixed
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * @param mixed $terrain
     */
    public function setTerrain($terrain): void
    {
        $this->terrain = $terrain;
    }

    /**
     * @return mixed
     */
    public function getWallable()
    {
        return $this->wallable;
    }

    /**
     * @param mixed $wallable
     */
    public function setWallable($wallable): void
    {
        $this->wallable = $wallable;
    }
}