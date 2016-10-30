<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 15:22
 */

namespace BackBundle\Provider;


use BackBundle\Manager\UserInviteManager;

class UserInviteProvider
{
    /** @var  UserInviteManager $userInviteManager */
    private $userInviteManager;

    /**
     * UserInviteProvider constructor.
     *
     * @param UserInviteManager $userInviteManager
     */
    public function __construct(UserInviteManager $userInviteManager)
    {
        $this->userInviteManager = $userInviteManager;
    }

    public function verify($email, $code)
    {
        $invitations = $this->userInviteManager->getByEmailOrderByExpireAt($email);

        if (count($invitations) == 0)
        {
            throw new \Exception('user_invite.warning.not_invited');
        }
        $invitation = $invitations[0];
        if ($invitation->getExpireAt() < new \DateTime())
        {
            throw new \Exception('user_invite.warning.expired');
        }

        if ($invitation->getCode() !== $code)
        {
            throw new \Exception('user_invite.warning.wrong_code');
        }
    }
}