<?php
/**
 * User: floran
 * Date: 24/12/2016
 * Time: 19:01
 */

namespace BackBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class GoogleCloudStorageService extends \Google_Service_Storage
{
    /**
     * @param $privateKeyPath
     */
    public function __construct(ContainerInterface $container, $privateKeyPath)
    {
        $client = new \Google_Client();

        $path = $container->get('kernel')->getRootDir() . '/../web/';
        $client->setAuthConfig($path.$privateKeyPath);
        $client->addScope(\Google_Service_Storage::DEVSTORAGE_FULL_CONTROL);

        parent::__construct($client);
    }
}