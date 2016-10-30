<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 11:29
 */

namespace BackBundle\EventListener;

use BackBundle\Model\TimestampableInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PreUpdateListener
{
    /**
     * Pre update event
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof TimestampableInterface) {
            $entity->setUpdatedAt(new \DateTime('now'));
        }
    }
}