<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChallengeSubjectController extends Controller
{
    public function deleteAction($idChallengeSubject)
    {
        $challengeSubjectManager = $this->get('manager.challenge_subject');
        $challengeSubject = $challengeSubjectManager->load($idChallengeSubject);

        if (!$this->isGranted('ROLE_ADMIN')) {

            return new JsonResponse(array(), 401);
        }
        if (!$challengeSubject) {

            return new JsonResponse(array(), 404);
        }
        $challengeSubjectManager->delete($challengeSubject);
        $message = $this->get('translator')->trans('challenge_subject.message.success.deleted');

        return new JsonResponse(array('message' => $message), 200);
    }
}
