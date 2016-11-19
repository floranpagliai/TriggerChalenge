<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 10:26
 */

namespace BackBundle\Manager;

class UserManager extends AbstractManager
{

    public function getOneByEmail($email)
    {
        $q = $this->em->createQueryBuilder()
            ->select('u')
            ->from($this->class, 'u')
            ->where('u.email = :email')->setParameter('email', $email)
            ->setMaxResults(1);

        return $q->getQuery()->getOneOrNullResult();
    }
}