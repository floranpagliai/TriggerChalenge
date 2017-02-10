<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 07/02/2017
 * Time: 23:20
 */

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BackBundle\Model\TimestampableInterface;
use BackBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="post_likes")
 */
class PostLike implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     */
    private $post;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var boolean
     * @ORM\Column(name="is_deleted", type="boolean", options={"default" : false})
     */
    private $deleted = false;

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
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost($post)
    {
        $this->post = $post;
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
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }
}