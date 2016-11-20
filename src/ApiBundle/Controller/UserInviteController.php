<?php
/**
 * User: floran
 * Date: 19/11/2016
 * Time: 12:50
 */

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserInviteController extends Controller
{
    public function deleteAction($idUserInvite)
    {
        $userInviteManager = $this->get('manager.user_invite');
        $userInvite = $userInviteManager->load($idUserInvite);

        if (!$this->isGranted('ROLE_ADMIN')) {

            return new JsonResponse(array(), 401);
        }
        if (!$userInvite) {

            return new JsonResponse(array(), 404);
        }
        $userInviteManager->delete($userInvite);
        $message = $this->get('translator')->trans('user_invite.message.success.deleted');

        return new JsonResponse(array('message' => $message), 200);
    }
}