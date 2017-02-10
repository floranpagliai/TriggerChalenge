<?php
/**
 * User: floran
 * Date: 22/11/2016
 * Time: 22:41
 */

namespace BackBundle\Controller;

use BackBundle\Entity\Challenge;
use BackBundle\Entity\ChallengeSubject;
use BackBundle\Form\ChallengeSubjectForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class ChallengeSubjectController extends Controller
{
    public function indexAction($idChallenge)
    {
        /** @var ChallengeSubject[] $challengeSubjects */
        $challengeSubjects = $this->get('manager.challenge_subject')->loadBy(array('challenge' => $idChallenge));

        return $this->render(
            'BackBundle:ChallengeSubject:index.html.twig',
            array(
                'challengeSubjects' => $challengeSubjects,
                'idChallenge' => $idChallenge
            )
        );
    }

    public function addOrEditAction(Request $request, $idChallenge, $idChallengeSubject = 0)
    {
        $challenge = $this->get('manager.challenge')->load($idChallenge);
        if (!$challenge instanceof Challenge) {
            return $this->redirectToRoute('back_challenge_index');
        }
        $challengeSubject = $this->get('manager.challenge_subject')->load($idChallengeSubject);
        $challengeSubject = $challengeSubject instanceof ChallengeSubject ? $challengeSubject : new ChallengeSubject($challenge);
        $form = $this->createForm(ChallengeSubjectForm::class, $challengeSubject);

        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($challengeSubject);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('service.challenge_subject')->save($challengeSubject);

                return $this->redirectToRoute('back_challenge_index');
            } catch (\Exception $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render(
            'BackBundle:ChallengeSubject:form.html.twig',
            array(
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }
}