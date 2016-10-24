<?php
/**
 * User: floran
 * Date: 23/10/2016
 * Time: 13:18
 */

namespace BackBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function setEmail($email){
        parent::setEmail($email);
        $this->setUsername($email);
    }
}