<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 16:50
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function profileAction($userId)
    {
        $user = $this->get('manager.user')->loadOneBy(array('publicId' => $userId));
        if (!$user) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->getByUserId($user->getId());

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'posts' => $posts
            )
        );
    }
}