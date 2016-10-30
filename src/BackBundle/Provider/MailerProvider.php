<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 22:00
 */

namespace BackBundle\Provider;


use BackBundle\Entity\UserInvite;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class MailerProvider
{
    protected $mailer;
    protected $templating;

    /**
     * MailerProvider constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param TwigEngine $templating
     */
    public function __construct(\Swift_Mailer $mailer, TwigEngine $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendUserInvitation(UserInvite $userInvite)
    {
        $from = 'floran.pagliai@gmail.com';
        $fromName = 'Floran Pagliai';
        $to = $userInvite->getEmail();
        $subject = 'Bienvenue dans l\'aventure photographique !';
        $body = $this->templating->render('BackBundle:Mails:invitation.txt.twig', array('invite' => $userInvite));

        $this->sendMail($from, $fromName, $to, $subject, $body);
    }

    /**
     * @param $from
     * @param $fromName
     * @param $to
     * @param $subject
     * @param $body
     */
    protected function sendMail($from, $fromName, $to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail->setFrom($from, $fromName)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}