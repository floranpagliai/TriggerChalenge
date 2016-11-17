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
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneByEmailNonExpired($email)
    {
        $q = $this->em->createQueryBuilder()
            ->select('ui')
            ->from($this->class, 'ui')
            ->where('ui.email = :email')->setParameter('email', $email)
            ->andWhere('ui.expireAt > :date')->setParameter('date', new \DateTime())
            ->setMaxResults(1);

        return $q->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $email
     *
     * @param $code
     *
     * @return UserInvite
     * @throws \Doctrine\ORM\NonUniqueResultException
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