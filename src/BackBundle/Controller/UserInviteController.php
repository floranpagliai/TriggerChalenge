<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 17:53
 */

namespace BackBundle\Controller;


class UserInviteController
{
    public function indexAction()
    {
        /** @var Post[] $posts */
        $posts = $this->get('manager.post')->loadAll();

        return $this->render('FrontBundle:Index:index.html.twig',
            array(
                'posts' => $posts
            )
        );
    }
}