<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        $ongoingFeaturedChallenges = $this->get('provider.challenge_subject')->getOngoingFeatured();
        $posts = $this->get('manager.post')->getAll(8);

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'ongoingFeaturedChallenges' => $ongoingFeaturedChallenges,
                'posts' => $posts
            )
        );
    }
}
