<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 17:53
 */

namespace BackBundle\Controller;

use BackBundle\Entity\UserInvite;
use BackBundle\Form\UserInvitationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class UserInviteController extends Controller
{
    public function indexAction()
    {
        /** @var UserInvite[] $invitations */
        $invitations = $this->get('manager.user_invite')->loadAll();

        return $this->render(
            'BackBundle:UserInvite:index.html.twig',
            array('invitations' => $invitations)
        );
    }

    public function addAction(Request $request)
    {
        $userInvite = new UserInvite($this->getUser());
        $userInvite->setExpireAt((new \DateTime())->add(new \DateInterval('P1M')));
        $form = $this->createForm(UserInvitationForm::class, $userInvite);

        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($userInvite);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('provider.user_invite')->isAlreadyInvited($userInvite->getEmail());
                $this->get('manager.user_invite')->save($userInvite);
                // TODO : add flash

                $mailer = $this->get('provider.mailer');
                $mailer->sendUserInvitation($userInvite);

                return $this->redirectToRoute('back_user_invite_index');
            } catch (\Exception $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render(
            'BackBundle:UserInvite:add.html.twig',
            array(
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }
}