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
     * @return \BackBundle\Entity\ChallengeSubject[]
     */
    public function getOngoing($limit = null)
    {
        $q = $this->em->createQueryBuilder()
            ->select('cs')
            ->from($this->class, 'cs')
            ->andWhere('cs.endSubmissionDate >= :now')
            ->setParameter('now', new DateTime());
        if ($limit != null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }
}