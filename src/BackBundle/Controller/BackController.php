<?php
/**
 * User: floran
 * Date: 17/11/2016
 * Time: 14:12
 */

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'BackBundle:Dashboard:index.html.twig'
        );
    }
}