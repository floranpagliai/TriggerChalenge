<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 11:43
 */

namespace BackBundle\Model;


interface TimestampableInterface
{
    /**
     * Get created at
     *
     * @return \DateTime Created at
     */
    public function getCreatedAt();
    /**
     * Set created at
     *
     * @param \DateTime $createdAt Created at
     */
    public function setCreatedAt(\DateTime $createdAt);
    /**
     * Get updated at
     *
     * @return \DateTime Updated at
     */
    public function getUpdatedAt();
    /**
     * Set updated at
     *
     * @param \DateTime $updatedAt Updated at
     */
    public function setUpdatedAt(\DateTime $updatedAt);
}