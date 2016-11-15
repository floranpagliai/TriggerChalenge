<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->getAll();

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'posts' => $posts
            )
        );
    }
}
