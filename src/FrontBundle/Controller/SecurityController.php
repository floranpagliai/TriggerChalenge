<?php
/**
 * User: floran
 * Date: 25/10/2016
 * Time: 00:10
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\User;
use FrontBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
    /**
     * @return Response
     */
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('front_homepage');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('FrontBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function registerAction(Request $request)
    {
        $email = $request->get('email');
        $invitationCode = $request->get('code');

        try {
            $this->get('provider.user_invite')->verify($email, $invitationCode);
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('front_homepage');
        }

        $user = new User();
        $user->setEmail($email);
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $this->get('manager.user')->save($user);

            return $this->redirectToRoute('front_homepage');
        }

        return $this->render(
            'FrontBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}