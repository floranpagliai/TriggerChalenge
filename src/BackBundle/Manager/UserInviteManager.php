<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 15:23
 */

namespace BackBundle\Manager;


use BackBundle\Entity\UserInvite;

class UserInviteManager extends AbstractManager
{

    /**
     * @param $email
     *
     * @return UserInvite[]
     */
    public function getByEmailOrderByExpireAt($email)
    {
        $q = $this->em->createQueryBuilder()
            ->select('ui')
            ->from($this->class, 'ui')
            ->where('ui.email = :email')->setParameter('email', $email)
            ->orderBy('expireAt', 'DESC');

        return $q->getQuery()->getArrayResult();
    }
}