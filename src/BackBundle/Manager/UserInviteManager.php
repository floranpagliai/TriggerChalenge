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
     * @return UserInvite
     */
    public function getByEmailAndCode($email, $code)
    {
        $q = $this->em->createQueryBuilder()
            ->select('ui')
            ->from($this->class, 'ui')
            ->where('ui.email = :email')->setParameter('email', $email)
            ->andWhere('ui.code = :code')->setParameter('code', $code)
            ->setMaxResults(1);

        return $q->getQuery()->getOneOrNullResult();
    }
}