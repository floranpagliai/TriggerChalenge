<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 11/02/2017
 * Time: 21:57
 */

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post_metadatas")
 */
class PostMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="camera_model", type="string")
     */
    private $cameraModel;

    /**
     * @var string
     * @ORM\Column(name="exposure", type="string")
     */
    private $exposure;

    /**
     * @var string
     * @ORM\Column(name="iso", type="string")
     */
    private $iso;

    /**
     * @var string
     * @ORM\Column(name="shutter_speed", type="string")
     */
    private $shutterSpeed;

    /**
     * @var string
     * @ORM\Column(name="aperture", type="string")
     */
    private $aperture;

    /**
     * @var string
     * @ORM\Column(name="lens", type="string")
     */
    private $lens;

    /**
     * @var \DateTime
     * @ORM\Column(name="taken_date", type="datetime")
     */
    private $takenDate;

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
    public function getCameraModel()
    {
        return $this->cameraModel;
    }

    /**
     * @param string $cameraModel
     */
    public function setCameraModel($cameraModel)
    {
        $this->cameraModel = $cameraModel;
    }

    /**
     * @return string
     */
    public function getExposure()
    {
        return $this->exposure;
    }

    /**
     * @param string $exposure
     */
    public function setExposure($exposure)
    {
        $this->exposure = $exposure;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getShutterSpeed()
    {
        return $this->shutterSpeed;
    }

    /**
     * @param string $shutterSpeed
     */
    public function setShutterSpeed($shutterSpeed)
    {
        $this->shutterSpeed = $shutterSpeed;
    }

    /**
     * @return string
     */
    public function getAperture()
    {
        return $this->aperture;
    }

    /**
     * @param string $aperture
     */
    public function setAperture($aperture)
    {
        $this->aperture = $aperture;
    }

    /**
     * @return string
     */
    public function getLens()
    {
        return $this->lens;
    }

    /**
     * @param string $lens
     */
    public function setLens($lens)
    {
        $this->lens = $lens;
    }

    /**
     * @return \DateTime
     */
    public function getTakenDate()
    {
        return $this->takenDate;
    }

    /**
     * @param \DateTime $takenDate
     */
    public function setTakenDate($takenDate)
    {
        $this->takenDate = $takenDate;
    }
}