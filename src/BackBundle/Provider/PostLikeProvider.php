<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 09/02/2017
 * Time: 11:17
 */

namespace BackBundle\Provider;


use BackBundle\Entity\Post;
use BackBundle\Entity\PostLike;
use BackBundle\Entity\User;
use BackBundle\Manager\PostLikeManager;

class PostLikeProvider
{

    private $postLikeManager;

    /**
     * PostLikeProvider constructor.
     * @param PostLikeManager $postLikeManager
     */
    public function __construct(PostLikeManager $postLikeManager)
    {
        $this->postLikeManager = $postLikeManager;
    }

    public function likePost(Post $post, User $user)
    {
        $postLike = new PostLike();
        $postLike->setPost($post);
        $postLike->setUser($user);

        $this->postLikeManager->save($postLike);
    }

    public function unlikePost(PostLike $postLike)
    {
        $postLike->setDeleted(true);

        $this->postLikeManager->save($postLike);
    }

    public function reLikePost(PostLike $postLike)
    {
        $postLike->setDeleted(false);

        $this->postLikeManager->save($postLike);
    }

}