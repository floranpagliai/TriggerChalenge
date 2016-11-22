<?php
/**
 * User: floran
 * Date: 22/11/2016
 * Time: 22:32
 */

namespace BackBundle\Controller;

use BackBundle\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChallengeController extends Controller
{
    public function indexAction()
    {
        /** @var Challenge[] $challenges */
        $challenges = $this->get('manager.challenge')->loadAll();

        return $this->render(
            'BackBundle:Challenge:index.html.twig',
            array('challenges' => $challenges)
        );
    }
}