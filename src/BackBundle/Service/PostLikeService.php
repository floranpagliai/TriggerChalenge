<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 09/02/2017
 * Time: 11:29
 */

namespace BackBundle\Service;


use BackBundle\Entity\Post;
use BackBundle\Entity\PostLike;
use BackBundle\Entity\User;
use BackBundle\Manager\PostLikeManager;
use BackBundle\Manager\PostManager;
use BackBundle\Provider\PostLikeProvider;

class PostLikeService
{

    private $postLikeProvider;
    private $postLikeManager;
    private $postManager;

    /**
     * PostLikeService constructor.
     * @param PostLikeManager $postLikeManager
     * @param PostManager $postManager
     * @param PostLikeProvider $postLikeProvider
     */
    public function __construct(PostLikeManager $postLikeManager, PostManager $postManager, PostLikeProvider $postLikeProvider)
    {
        $this->postLikeManager = $postLikeManager;
        $this->postManager = $postManager;
        $this->postLikeProvider = $postLikeProvider;
    }


    public function likeOrUnlikePost($idPost, User $user)
    {
        $post = $this->postManager->load($idPost);
        if (!$post instanceof Post) {
            throw new \Exception('post.message.error.not_exist');
        }
        $postLike = $this->postLikeManager->loadOneBy(array('post' => $post, 'user' => $user));
        if (!$postLike instanceof PostLike) {
            $this->postLikeProvider->likePost($post, $user);
        } elseif ($postLike->isDeleted() === true) {
            $this->postLikeProvider->reLikePost($postLike);
        } else {
            $this->postLikeProvider->unlikePost($postLike);
        }
    }
}