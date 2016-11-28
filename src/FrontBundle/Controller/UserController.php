<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 16:50
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use BackBundle\Entity\User;
use FrontBundle\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function showAction($userId)
    {
        $user = $this->get('manager.user')->loadOneBy(array('publicId' => $userId));
        if (!$user instanceof User) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->getByUserId($user->getId());
        $stats['postCount'] = sizeof($posts);

        return $this->render('FrontBundle:User:profile.html.twig',
            array(
                'user'  => $user,
                'posts' => $posts,
                'stats' => $stats
            )
        );
    }

    public function editPasswordAction(Request $request)
    {
        $user = $this->getUser();
        if (!$user instanceof User) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }

        $errors = array();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('provider.user')->changePassword($user, $form->getData()['newPassword'], $form->getData()['oldPassword']);
                $message = $this->get('translator')->trans('user.message.success.password_changed');
                $this->addFlash('success', $message);
            } catch (\Exception $e) {
                $form->get('oldPassword')->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render('FrontBundle:User/Edit:password.html.twig',
            array(
                'user'   => $user,
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }
}