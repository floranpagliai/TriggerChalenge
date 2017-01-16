<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 22:04
 */

namespace BackBundle\Manager;

use BackBundle\Entity\ChallengeSubject;
use DateTime;

class ChallengeSubjectManager extends AbstractManager
{

    /**
     * @param null $limit
     *
     * @return ChallengeSubject[]
     */
    public function getOngoing($limit = null)
    {
        $q = $this->em->createQueryBuilder()
            ->select('cs')
            ->from($this->class, 'cs')
            ->andWhere('cs.startSubmissionDate <= :now')
            ->andWhere('cs.endSubmissionDate >= :now')
            ->setParameter('now', new DateTime());
        if ($limit !== null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }

    /**
     * @param null $limit
     *
     * @return ChallengeSubject[]
     */
    public function getPrevious($limit = null)
    {
        $q = $this->em->createQueryBuilder()
            ->select('cs')
            ->from($this->class, 'cs')
            ->andWhere('cs.endSubmissionDate <= :now')
            ->setParameter('now', new DateTime())
            ->orderBy('cs.endSubmissionDate', 'DESC');
        if ($limit !== null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }

    /**
     * @param null $limit
     *
     * @return ChallengeSubject[]
     */
    public function getNext($limit = null)
    {
        $q = $this->em->createQueryBuilder()
            ->select('cs')
            ->from($this->class, 'cs')
            ->andWhere('cs.startSubmissionDate >= :now')
            ->setParameter('now', new DateTime())
            ->orderBy('cs.startSubmissionDate', 'ASC');
        if ($limit !== null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }

    /**
     * @param DateTime $startSubmissionDate
     * @param $idChallenge
     *
     * @return int
     */
    public function countPreviousByChallenge(DateTime $startSubmissionDate, $idChallenge)
    {
        $q = $this->em->createQueryBuilder()
            ->select('COUNT(cs)')
            ->from($this->class, 'cs')
            ->andWhere('cs.challenge = :idChallenge')
            ->setParameter('idChallenge', $idChallenge)
            ->andWhere('cs.startSubmissionDate <= :startSubmissionDate')
            ->setParameter('startSubmissionDate', $startSubmissionDate);

        return $q->getQuery()->getSingleScalarResult();
    }
}