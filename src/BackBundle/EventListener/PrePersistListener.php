<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 11:28
 */

namespace BackBundle\EventListener;

use BackBundle\Model\TimestampableInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PrePersistListener
{
    /**
     * Pre persist event
     *
     * @param LifecycleEventArgs $args Arguments
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof TimestampableInterface) {
            $now = new \DateTime('now');
            $entity->setCreatedAt($now);
            $entity->setUpdatedAt($now);
        }
    }
}