<?php
/**
 * User: floran
 * Date: 22/11/2016
 * Time: 22:32
 */

namespace BackBundle\Controller;

use BackBundle\Entity\Challenge;
use BackBundle\Form\ChallengeForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

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

    public function addOrEditAction(Request $request, $idChallenge = 0)
    {
        $challenge = $this->get('manager.challenge')->load($idChallenge);
        if (!$challenge instanceof Challenge) {
            $challenge = new Challenge();
        }
        $form = $this->createForm(ChallengeForm::class, $challenge);

        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($challenge);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('manager.challenge')->save($challenge);

                return $this->redirectToRoute('back_challenge_index');
            } catch (\Exception $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render(
            'BackBundle:Challenge:form.html.twig',
            array(
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }
}