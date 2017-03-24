<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 11/02/2017
 * Time: 21:51
 */

namespace BackBundle\Service;

use BackBundle\Entity\PostMetadata;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostMetadataService
{

    public function get($filename, PostMetadata $postMetadata = null)
    {
        $postMetadata = $postMetadata !== null ? $postMetadata : new PostMetadata();
        $exifData = @exif_read_data($filename);
        $i = 0;
        if (!empty($exifData['Model'])) {
            $postMetadata->setCameraModel($exifData['Model']);
            $i++;
        }
        if (!empty($exifData['ExposureTime'])) {
            $postMetadata->setExposure($exifData['ExposureTime']);
            $i++;
        }
        if (!empty($exifData['ISOSpeedRatings'])) {
            $postMetadata->setIso($exifData['ISOSpeedRatings']);
            $i++;
        }
        if (!empty($exifData['COMPUTED']['ApertureFNumber'])) {
            $postMetadata->setAperture($exifData['COMPUTED']['ApertureFNumber']);
            $i++;
        }
        if (!empty($exifData['FocalLength'])) {
            $values = explode('/', $exifData['FocalLength']);
            if (isset($values[0]) && $values[1]) {
                $focalLength = intval($values[0]) / intval($values[1]);
                $postMetadata->setFocalLength($focalLength);
            }
            $i++;
        }
        if (!empty($exifData['FocalLengthIn35mmFilm'])) {
            $postMetadata->setFocalLengthIn35mm($exifData['FocalLengthIn35mmFilm']);
            $i++;
        }
        if (!empty($exifData['UndefinedTag:0xA434'])) {
            $postMetadata->setLens($exifData['UndefinedTag:0xA434']);
            $i++;
        }
        if (!empty($exifData['DateTimeOriginal'])) {
            $postMetadata->setTakenDate(new \DateTime($exifData['DateTimeOriginal']));
            $i++;
        }
        if (!empty($exifData['COMPUTED']['Height'])) {
            $postMetadata->setHeight($exifData['COMPUTED']['Height']);
            $i++;
        }
        if (!empty($exifData['COMPUTED']['Width'])) {
            $postMetadata->setWidth((int)$exifData['COMPUTED']['Width']);
            $i++;
        }
        if (!empty($exifData['FileSize'])) {
            $postMetadata->setFileSize($exifData['FileSize']);
            $i++;
        }

        $postMetadata = $i != 0 ? $postMetadata : null;

        return $postMetadata;
    }
}