<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 09/02/2017
 * Time: 11:57
 */

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostLikeController extends Controller
{

    public function updateAction($idPost)
    {
        $postLikeService = $this->get('service.post_like');

        if (!$this->isGranted('ROLE_USER')) {

            return new JsonResponse(array(), 401);
        }
        $postLikeService->likeOrUnlikePost($idPost, $this->getUser());

        return new JsonResponse(array(), 200);
    }
}