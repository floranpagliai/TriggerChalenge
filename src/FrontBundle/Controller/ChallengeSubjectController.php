<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\ChallengeSubject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChallengeSubjectController extends Controller
{
    public function showAction($idChallenge)
    {
        $challengeSubject = $this->get('manager.challenge_subject')->load($idChallenge);
        if (!$challengeSubject instanceof ChallengeSubject) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        $challengeNumber = $this->get('provider.challenge_subject')->getSequenceNumber($challengeSubject);
        $posts = $this->get('manager.post')->getByChallengeSubject($challengeSubject->getId());

        return $this->render(
            'FrontBundle:ChallengeSubject:show.html.twig',
            array(
                'challengeSubject' => $challengeSubject,
                'challengeNumber' => $challengeNumber,
                'posts' => $posts
            )
        );
    }
}
