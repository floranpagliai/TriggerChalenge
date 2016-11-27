<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 16:50
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use BackBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function showAction($userId)
    {
        $user = $this->get('manager.user')->loadOneBy(array('publicId' => $userId));
        if (!$user instanceof User) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->getByUserId($user->getId());
        $stats['postCount'] = sizeof($posts);

        return $this->render('FrontBundle:User:profile.html.twig',
            array(
                'user'  => $user,
                'posts' => $posts,
                'stats' => $stats
            )
        );
    }
}