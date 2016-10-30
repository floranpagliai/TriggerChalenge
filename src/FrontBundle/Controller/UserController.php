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
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->getByUserId($userId);

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'posts' => $posts
            )
        );
    }
}