<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        $challengeSubjects = $this->get('manager.challenge_subject')->getOngoing(4);
        $posts = $this->get('manager.post')->getAll(8);

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'challengeSubjects' => $challengeSubjects,
                'posts' => $posts
            )
        );
    }
}
