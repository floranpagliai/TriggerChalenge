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
        $postLikeManager = $this->get('manager.post_like');

        if (!$this->isGranted('ROLE_USER')) {
            $message = $this->get('translator')->trans('user.message.warning.need_login');

            return new JsonResponse(array('message' => $message), 401);
        }
        $postLikeService->likeOrUnlikePost($idPost, $this->getUser());
        $likesCount =  $postLikeManager->countByPost($idPost);

        return new JsonResponse(array('likesCount' => $likesCount), 200);
    }
}