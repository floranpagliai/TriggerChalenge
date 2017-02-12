<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 10/02/2017
 * Time: 13:22
 */

namespace BackBundle\Service;


use BackBundle\Entity\ChallengeSubject;
use BackBundle\Manager\ChallengeSubjectManager;

class ChallengeSubjectService
{
    private $challengeSubjectManager;
    private $pictureUploaderService;

    /**
     * ChallengeSubjectService constructor.
     * @param ChallengeSubjectManager $challengeSubjectManager
     * @param PictureUploaderService $pictureUploaderService
     */
    public function __construct(ChallengeSubjectManager $challengeSubjectManager, PictureUploaderService $pictureUploaderService)
    {
        $this->challengeSubjectManager = $challengeSubjectManager;
        $this->pictureUploaderService = $pictureUploaderService;
    }

    public function save(ChallengeSubject $challengeSubject)
    {
        $filename = $this->pictureUploaderService->upload($challengeSubject->getCoverPicture()->getFile());
        $challengeSubject->getCoverPicture()->setFilename($filename);

        $this->challengeSubjectManager->save($challengeSubject);
    }
}