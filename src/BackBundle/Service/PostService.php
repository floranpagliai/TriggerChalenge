<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 10/02/2017
 * Time: 12:53
 */

namespace BackBundle\Service;


use BackBundle\Entity\Picture;
use BackBundle\Entity\Post;
use BackBundle\Manager\PostManager;

class PostService
{
    private static $allowedMimeTypes = array(
        'image/jpeg'
    );

    private $postManager;
    private $pictureUploaderService;
    private $postMetadataService;

    /**
     * PostService constructor.
     * @param PostManager $postManager
     * @param PictureUploaderService $pictureUploaderService
     * @param PostMetadataService $postMetadataService
     */
    public function __construct(PostManager $postManager, PictureUploaderService $pictureUploaderService, PostMetadataService $postMetadataService)
    {
        $this->postManager = $postManager;
        $this->pictureUploaderService = $pictureUploaderService;
        $this->postMetadataService = $postMetadataService;
    }

    public function save(Post $post)
    {
        $file = $post->getCoverPicture()->getFile();
        if (!in_array($file->getClientMimeType(), self::$allowedMimeTypes)) {
            throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
        }
        $filename = $this->pictureUploaderService->uploadThumbnail($file, 'thumbnails/');
        $picture = new Picture();
        $picture->setFilename($filename);
        $post->setThumbnailPicture($picture);

        $filename = $this->pictureUploaderService->upload($file);
        $post->getCoverPicture()->setFilename($filename);

        $postMetadata = $this->postMetadataService->get($file->getRealPath());
        $post->setMetadata($postMetadata);

        $this->postManager->save($post);
    }

}