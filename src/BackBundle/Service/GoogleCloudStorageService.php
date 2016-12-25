<?php
/**
 * User: floran
 * Date: 24/12/2016
 * Time: 19:01
 */

namespace BackBundle\Service;


class GoogleCloudStorageService extends \Google_Service_Storage
{
    /**
     * @param $privateKeyPath
     */
    public function __construct($privateKeyPath)
    {
        $client = new \Google_Client();

        $client->setAuthConfig($privateKeyPath);
        $client->addScope(\Google_Service_Storage::DEVSTORAGE_FULL_CONTROL);

        parent::__construct($client);
    }
}