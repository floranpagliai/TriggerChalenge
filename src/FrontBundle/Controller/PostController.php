<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 21:08
 */

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{

    public function showAction()
    {
        return $this->render(
            'FrontBundle:Post:show.html.twig'
        );
    }
}