<?php
/**
 * User: floran
 * Date: 21/11/2016
 * Time: 21:23
 */

namespace BackBundle\Provider;


use BackBundle\Entity\Challenge;
use BackBundle\Entity\ChallengeSubject;
use BackBundle\Manager\ChallengeManager;
use BackBundle\Manager\ChallengeSubjectManager;

class ChallengeSubjectProvider
{
    /** @var ChallengeSubjectManager $challengeSubjectManager */
    private $challengeSubjectManager;

    /** @var  ChallengeManager $challengeManager */
    private $challengeManager;

    /**
     * ChallengeProvider constructor.
     *
     * @param ChallengeSubjectManager $challengeSubjectManager
     * @param ChallengeManager $challengeManager
     */
    public function __construct(ChallengeSubjectManager $challengeSubjectManager, ChallengeManager $challengeManager)
    {
        $this->challengeSubjectManager = $challengeSubjectManager;
        $this->challengeManager = $challengeManager;
    }

    /**
     * @param int $subjectToShow
     *
     * @return array
     */
    public function getOngoingFeatured($subjectToShow = 3)
    {
        $ongoingFeaturedSubjects = array();
        /** @var Challenge[] $featuredChallenges */
        $featuredChallenges = $this->challengeManager->loadBy(array('featured' => true));
        foreach ($featuredChallenges as $featuredChallenge) {
            $ongoingSubjects = $this->challengeSubjectManager->getOngoing($subjectToShow);
            $subjectToShow -= sizeof($ongoingSubjects);
            $previousSubjects = $this->challengeSubjectManager->getPrevious(1);
            $subjectToShow -= sizeof($previousSubjects);
            $nextSubjects = $this->challengeSubjectManager->getNext($subjectToShow);
            $subjectToShow -= sizeof($nextSubjects);
            if ($subjectToShow > 0) {
                $subjectToShow += sizeof($previousSubjects);
                $previousSubjects = $this->challengeSubjectManager->getPrevious($subjectToShow);
            }
            $subjects = array_merge($previousSubjects, $ongoingSubjects, $nextSubjects);
            $previousSubjects = $this->challengeSubjectManager->getPrevious(null, sizeof($previousSubjects));
            $previousSubjects = is_array($previousSubjects) ? array_reverse($previousSubjects) : null;
            $ongoingFeaturedSubjects[] = array(
                'challenge' => $featuredChallenge,
                'subjects'  => $subjects,
                'previousSubjects' => $previousSubjects
            );
        }

        return $ongoingFeaturedSubjects;
    }

    /**
     * @param ChallengeSubject $challengeSubject
     *
     * @return int
     */
    public function getSequenceNumber(ChallengeSubject $challengeSubject)
    {
        return $this->challengeSubjectManager->countPreviousByChallenge($challengeSubject->getStartSubmissionDate(), $challengeSubject->getChallenge()->getId());
    }
}