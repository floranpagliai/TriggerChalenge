<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 25/03/2017
 * Time: 19:07
 */

namespace BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdatePostPictureCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('trc:admin:update-post-picture');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}