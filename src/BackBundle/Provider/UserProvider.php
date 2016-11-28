<?php
/**
 * User: floran
 * Date: 28/11/2016
 * Time: 11:32
 */

namespace BackBundle\Provider;


use BackBundle\Entity\User;
use BackBundle\Manager\UserManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserProvider
{
    /** @var  UserManager $userManager */
    private $userManager;

    /** @var  MailerProvider $mailerProvider */
    private $mailerProvider;

    /** @var  UserPasswordEncoder $passwordEncoder */
    private $passwordEncoder;

    /**
     * UserProvider constructor.
     *
     * @param UserManager $userManager
     * @param MailerProvider $mailerProvider
     * @param UserPasswordEncoder $passwordEncoder
     */
    public function __construct(UserManager $userManager, MailerProvider $mailerProvider, UserPasswordEncoder $passwordEncoder)
    {
        $this->userManager = $userManager;
        $this->mailerProvider = $mailerProvider;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function changePassword(User $user, $newPassword, $oldPassword = null)
    {
        if ($oldPassword !== null && !$this->passwordEncoder->isPasswordValid($user, $oldPassword)) {
            throw new \Exception('user.message.error.wrong_password');
        }
        $newPassword = $this->passwordEncoder->encodePassword($user, $newPassword);
        $user->setPassword($newPassword);

        $this->userManager->save($user);
    }

    public function resetPassword($email)
    {
        $user = $this->userManager->loadOneBy(array('email' => $email));
        if (!$user instanceof User) {
            throw new \Exception('user.message.warning.unknown_email');
        }
        $newPassword = substr(str_shuffle(strtolower(sha1(rand() . time() . $user->getSalt()))),0, 8);
        $this->changePassword($user, $newPassword);
        $this->mailerProvider->sendForgottenPassword($user, $newPassword);
    }
}