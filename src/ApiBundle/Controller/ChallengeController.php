<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChallengeController extends Controller
{
    public function deleteAction($idChallenge)
    {
        $challengeManager = $this->get('manager.challenge');
        $challenge = $challengeManager->load($idChallenge);

        if (!$this->isGranted('ROLE_ADMIN')) {

            return new JsonResponse(array(), 401);
        }
        if (!$challenge) {

            return new JsonResponse(array(), 404);
        }
        $challengeManager->delete($challenge);
        $message = $this->get('translator')->trans('challenge.message.success.deleted');

        return new JsonResponse(array('message' => $message), 200);
    }
}
