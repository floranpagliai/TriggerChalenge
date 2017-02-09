<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 21:08
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Picture;
use BackBundle\Entity\Post;
use BackBundle\Utils\ImageResizer;
use FrontBundle\Form\AddPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function showAction($postId)
    {
        $postManager = $this->get('manager.post');
        $postLikeManager = $this->get('manager.post_like');
        $postLikeProvider = $this->get('provider.post_like');

        $post = $postManager->loadOneBy(array('publicId' => $postId));
        if (!$post instanceof Post) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        $isLiking = $postLikeProvider->userIsLiking($post, $this->getUser());
        $likesCount =  $postLikeManager->countByPost($post->getId());

        return $this->render(
            'FrontBundle:Post:show.html.twig',
            array(
                'post' => $post,
                'likesCount' => $likesCount,
                'isLiking' => $isLiking
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

                $file = $post->getCoverPicture()->getFile();
                $image = new ImageResizer($post->getCoverPicture()->getUrl($this->getParameter('storage.bucket_name')));
                $image->resizeImage(300, 300, 'crop');
                $path = $this->get('kernel')->getRootDir() . '/../web';
                $filename = '/tmp'.strrchr($post->getCoverPicture()->getFilename(),'.');;
                $image->saveImage($path . $filename);
                $file = new UploadedFile($path . $filename, $filename, $file->getMimeType(), null, null, true);
                $filename2 = $this->get('picture_uploader.service')->upload($file, 'thumbnails/');
                $picture = new Picture();
                $picture->setFilename($filename2);
                $post->setThumbnailPicture($picture);
                unlink($path . $filename);

                $this->get('manager.post')->save($post);

                $message = $this->get('translator')->trans('post.message.success.added');
                $this->addFlash('success', $message);

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