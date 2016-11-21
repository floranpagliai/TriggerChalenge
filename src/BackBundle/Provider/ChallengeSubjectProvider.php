<?php
/**
 * User: floran
 * Date: 21/11/2016
 * Time: 21:23
 */

namespace BackBundle\Provider;


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

    public function getOngoingFeatured($subjectToShow = 3)
    {
        $ongoingFeaturedSubjects = array();
        $featuredChallenges = $this->challengeManager->loadBy(array('featured' => true));
        foreach ($featuredChallenges as $featuredChallenge) {
            $ongoingSubjects = $this->challengeSubjectManager->getOngoing(1);
            $subjectToShow -= sizeof($ongoingSubjects);
            $previousSubjects = $this->challengeSubjectManager->getPrevious(1);
            $subjectToShow -= sizeof($previousSubjects);
            $nextSubject = $this->challengeSubjectManager->getNext($subjectToShow);
            $subjectToShow -= sizeof($nextSubject);
            if ($subjectToShow > 0) {
                $subjectToShow += sizeof($previousSubjects);
                $previousSubjects = $this->challengeSubjectManager->getPrevious($subjectToShow);
            }
            $subjects = array_merge($previousSubjects, $ongoingSubjects, $nextSubject);
            $ongoingFeaturedSubjects[] = array('challenge' => $featuredChallenge,
                                               'subjects'  => $subjects);
        }

        return $ongoingFeaturedSubjects;
    }
}