<?php
/**
 * User: floran
 * Date: 24/12/2016
 * Time: 19:11
 */

namespace BackBundle\Service;

use BackBundle\Utils\ImageResizer;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureUploaderService
{
    private static $allowedMimeTypes = array(
        'image/jpeg',
        'image/png',
        'image/gif'
    );

    private $filesystem;
    private $rootDir;

    /**
     * PictureUploaderService constructor.
     * @param Filesystem $filesystem
     * @param $rootDir
     */
    public function __construct(Filesystem $filesystem, $rootDir)
    {
        $this->filesystem = $filesystem;
        $this->rootDir = $rootDir;
    }

    public function upload(UploadedFile $file, $dir = '')
    {
        if (!in_array($file->getClientMimeType(), self::$allowedMimeTypes)) {
            throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
        }
        $filename = sprintf($dir . '%s/%s/%s.%s', date('Y'), date('m'), uniqid(), $file->getClientOriginalExtension());
        $adapter = $this->filesystem->getAdapter();
        $adapter->setMetadata($filename, array('contentType' => $file->getClientMimeType()));
        $adapter->write($filename, file_get_contents($file->getPathname()));

        return $filename;
    }

    public function uploadThumbnail(UploadedFile $file, $dir = '')
    {
        if (!in_array($file->getClientMimeType(), self::$allowedMimeTypes)) {
            throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
        }
        $image = new ImageResizer($file);
        $image->resizeImage(300, 300, 'crop');
        $path = $this->rootDir . '/../web/';
        $filename = $file->getFilename() . '.' . $file->getClientOriginalExtension();
        $image->saveImage($path . $filename);
        $file = new UploadedFile($path . $filename, $filename, $file->getMimeType(), null, null, true);
        $uploadedFilename = $this->upload($file, $dir);
        unlink($path . $filename);

        return $uploadedFilename;
    }

}