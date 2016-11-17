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
        $invitation = $this->userInviteManager->getByEmailAndCode($email, $code);

        if (!$invitation)
        {
            throw new \Exception('user_invite.warning.not_invited');
        }
        if ($invitation->getExpireAt() < new \DateTime())
        {
            throw new \Exception('user_invite.warning.expired');
        }
    }

    public function isAlreadyInvited($email)
    {
        $invitation = $this->userInviteManager->getOneByEmailNonExpired($email);

        if ($invitation)
        {
            throw new \Exception('user_invite.warning.already_invited');
        }
    }
}