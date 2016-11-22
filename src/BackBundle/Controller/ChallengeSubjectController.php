<?php
/**
 * User: floran
 * Date: 22/11/2016
 * Time: 22:41
 */

namespace BackBundle\Controller;

use BackBundle\Entity\ChallengeSubject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChallengeSubjectController extends Controller
{
    public function indexAction($idChallenge)
    {
        /** @var ChallengeSubject[] $challengeSubjects */
        $challengeSubjects = $this->get('manager.challenge_subject')->loadBy(array('challenge' => $idChallenge));

        return $this->render(
            'BackBundle:ChallengeSubject:index.html.twig',
            array('challengeSubjects' => $challengeSubjects)
        );
    }
}