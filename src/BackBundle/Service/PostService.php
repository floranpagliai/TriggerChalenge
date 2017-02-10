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
use BackBundle\Utils\ImageResizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostService
{

    private $postManager;
    private $pictureUploaderService;
    private $rootDir;

    /**
     * PostService constructor.
     * @param PostManager $postManager
     * @param PictureUploaderService $pictureUploaderService
     * @param $rootDir
     */
    public function __construct(PostManager $postManager, PictureUploaderService $pictureUploaderService, $rootDir)
    {
        $this->postManager = $postManager;
        $this->pictureUploaderService = $pictureUploaderService;
        $this->rootDir = $rootDir;
    }

    public function save(Post $post)
    {
        $filename = $this->pictureUploaderService->upload($post->getCoverPicture()->getFile());
        $post->getCoverPicture()->setFilename($filename);

        $file = $post->getCoverPicture()->getFile();
        $image = new ImageResizer($file->getRealPath());
        $image->resizeImage(300, 300, 'crop');
        $path = $this->rootDir . '/../web';
        $filename = '/tmp'.strrchr($post->getCoverPicture()->getFilename(),'.');;
        $image->saveImage($path . $filename);
        $file = new UploadedFile($path . $filename, $filename, $file->getMimeType(), null, null, true);
        $filename2 = $this->pictureUploaderService->upload($file, 'thumbnails/');
        $picture = new Picture();
        $picture->setFilename($filename2);
        $post->setThumbnailPicture($picture);
        unlink($path . $filename);

        $this->postManager->save($post);
    }

}