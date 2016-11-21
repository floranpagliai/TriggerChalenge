<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 16:40
 */

namespace BackBundle\Entity;

use BackBundle\DBAL\ChallengeFrequencyType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="challenges")
 */
class Challenge
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var ChallengeFrequencyType
     * @ORM\Column(name="frequency", type="challengefrequency")
     */
    private $frequency;

    /**
     * @var ChallengeSubject[]
     * @ORM\OneTomany(targetEntity="BackBundle\Entity\ChallengeSubject", mappedBy="challenge")
     */
    private $subjects;

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
     * @return ChallengeFrequencyType
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param ChallengeFrequencyType $frequency
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
}