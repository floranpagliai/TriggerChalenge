<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 12/02/2017
 * Time: 00:50
 */

namespace BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdatePostMetadataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('trc:admin:update-post-metadata');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $postManager = $container->get('manager.post');
        $postMetadataService = $container->get('service.post_metadata');

        $posts = $postManager->getAll();
        foreach ($posts as $post) {
            $coverPicture = $post->getCoverPicture();
            $postMetadata = $postMetadataService->get($coverPicture->getUrl($container->getParameter('storage.bucket_name')), $post->getMetadata());
            $post->setMetadata($postMetadata);

            $postManager->save($post);
            $output->writeln('[UpdatePostMetadataCommand]Metadata for post with id = ' . $post->getId() . ' saved');
        }

    }
}