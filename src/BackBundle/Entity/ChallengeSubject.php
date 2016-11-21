<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 16:50
 */

namespace BackBundle\Entity;

use BackBundle\DBAL\ChallengeSubjectType;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="challenge_subjects")
 */
class ChallengeSubject
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Challenge
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Challenge")
     * @ORM\JoinColumn(name="challenge_id", referencedColumnName="id")
     */
    private $challenge;

    /**
     * @var Picture
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Picture")
     * @ORM\JoinColumn(name="cover_picture_id", referencedColumnName="id", nullable=true)
     */
    private $coverPicture;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var ChallengeSubjectType
     * @ORM\Column(name="type", type="challengesubject")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var DateTime
     * @ORM\Column(name="start_submission_date", type="datetime", nullable=true)
     */
    private $startSubmissionDate;

    /**
     * @var DateTime
     * @ORM\Column(name="end_submission_date", type="datetime", nullable=true)
     */
    private $endSubmissionDate;

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
     * @return Challenge
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * @param Challenge $challenge
     */
    public function setChallenge($challenge)
    {
        $this->challenge = $challenge;
    }

    /**
     * @return Picture
     */
    public function getCoverPicture()
    {
        return $this->coverPicture;
    }

    /**
     * @param Picture $coverPicture
     */
    public function setCoverPicture($coverPicture)
    {
        $this->coverPicture = $coverPicture;
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
     * @return ChallengeSubjectType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param ChallengeSubjectType $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getStartSubmissionDate()
    {
        return $this->startSubmissionDate;
    }

    /**
     * @param DateTime $startSubmissionDate
     */
    public function setStartSubmissionDate($startSubmissionDate)
    {
        $this->startSubmissionDate = $startSubmissionDate;
    }

    /**
     * @return DateTime
     */
    public function getEndSubmissionDate()
    {
        return $this->endSubmissionDate;
    }

    /**
     * @param DateTime $endSubmissionDate
     */
    public function setEndSubmissionDate($endSubmissionDate)
    {
        $this->endSubmissionDate = $endSubmissionDate;
    }

    public function isOpen()
    {
        $now = new DateTime();
        if ($this->startSubmissionDate <= $now && $this->endSubmissionDate >= $now) {

            return true;
        }

        return false;
    }

    public function isPast()
    {
        $now = new DateTime();
        if ($this->endSubmissionDate < $now) {

            return true;
        }

        return false;
    }
}
