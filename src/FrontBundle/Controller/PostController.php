<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 21:08
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Post;
use FrontBundle\Form\AddPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function showAction($postId)
    {
        $post = $this->get('manager.post')->loadOneBy(array('publicId' => $postId));
        if (!$post) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }

        return $this->render(
            'FrontBundle:Post:show.html.twig',
            array(
                'post' => $post
            )
        );
    }

    public function addAction(Request $request)
    {
        if (!$this->isGranted('ROLE_USER')) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(AddPostType::class, $post);

        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($post);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $filename = $this->get('picture_uploader.service')->upload($post->getCoverPicture()->getFile());
                $post->getCoverPicture()->setFilename($filename);

                $this->get('manager.post')->save($post);

                // TODO : Add flash

                return $this->redirect($this->generateUrl('front_post_show', array('postId' => $post->getPublicId())));
            } catch (\Exception $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render(
            'FrontBundle:Post:add.html.twig',
            array(
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }

    public function ajaxRenderAddFormAction(Request $request)
    {
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(AddPostType::class, $post, array(
            'action' => $this->generateUrl('api_post_add')
        ));

        $form->handleRequest($request);

        return $this->render(
            'FrontBundle:Post:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}