<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 15:22
 */

namespace BackBundle\Provider;


use BackBundle\Entity\UserInvite;
use BackBundle\Manager\UserInviteManager;
use BackBundle\Manager\UserManager;

class UserInviteProvider
{
    /** @var  UserInviteManager $userInviteManager */
    private $userInviteManager;

    /** @var  UserManager $userManager */
    private $userManager;

    /**
     * UserInviteProvider constructor.
     *
     * @param UserInviteManager $userInviteManager
     * @param UserManager $userManager
     */
    public function __construct(UserInviteManager $userInviteManager, UserManager $userManager)
    {
        $this->userInviteManager = $userInviteManager;
        $this->userManager = $userManager;
    }

    /**
     * @param $email
     * @param $code
     * @return UserInvite
     * @throws \Exception
     */
    public function verify($email, $code)
    {
        $invitation = $this->userInviteManager->getByEmailAndCode($email, $code);
        if (!$invitation) {
            throw new \Exception('user_invite.message.warning.not_invited');
        }
        if ($invitation->getInvitedUser() !== null) {
            throw new \Exception('user_invite.message.warning.already_registered');
        }
        if ($invitation->getExpireAt() < new \DateTime()) {
            throw new \Exception('user_invite.message.warning.expired');
        }

        return $invitation;
    }

    public function isAlreadyInvited($email)
    {
        $invitation = $this->userInviteManager->getOneByEmailNonExpired($email);
        if ($invitation) {
            throw new \Exception('user_invite.message.warning.already_invited');
        }
        $user = $this->userManager->getOneByEmail($email);
        if ($user) {
            throw new \Exception('user.message.error.unique_email');
        }
    }
}