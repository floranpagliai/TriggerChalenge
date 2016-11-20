<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 10:07
 */

namespace BackBundle\Entity;

use BackBundle\Model\TimestampableInterface;
use BackBundle\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_invites")
 */
class UserInvite implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User $invitingUser
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\User")
     * @ORM\JoinColumn(name="inviting_user_id", referencedColumnName="id", nullable=false)
     */
    private $invitingUser;

    /**
     * @var string $email
     * @ORM\Column(name="email", type="string", length=200)
     */
    private $email;

    /**
     * @var string $code
     * @ORM\Column(name="code", type="string", length=88)
     */
    private $code;

    /**
     * @var \DateTime $updatedAt
     * @ORM\Column(name="expire_at", type="datetime")
     */
    private $expireAt;

    /**
     * UserInvite constructor.
     *
     * @param User $invitingUser
     */
    public function __construct(User $invitingUser)
    {
        $this->invitingUser = $invitingUser;
        $this->setCode(uniqid('ui'));
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getInvitingUser()
    {
        return $this->invitingUser;
    }

    /**
     * @param User $invitingUser
     */
    public function setInvitingUser($invitingUser)
    {
        $this->invitingUser = $invitingUser;
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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return \DateTime
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @param \DateTime $expireAt
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;
    }
}