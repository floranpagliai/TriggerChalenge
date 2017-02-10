<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 16:40
 */

namespace BackBundle\Entity;

use BackBundle\DBAL\ChallengeFrequencyType;
use BackBundle\Traits\SlugTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="challenges")
 */
class Challenge
{
    use SlugTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=45)
     */
    private $name;

    /**
     * @var ChallengeFrequencyType
     * @ORM\Column(name="frequency", type="challengefrequency")
     */
    private $frequency;

    /**
     * @var ChallengeSubject[]
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\ChallengeSubject", mappedBy="challenge")
     */
    private $subjects;

    /**
     * @var boolean
     * @ORM\Column(name="is_featured", type="boolean", options={"default" : false})
     */
    private $featured = false;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param string $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return ChallengeSubject[]
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param ChallengeSubject[] $subjects
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
    }

    /**
     * @return boolean
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param boolean $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slugify($this->getName());
    }
}