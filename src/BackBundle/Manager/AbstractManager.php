<?php

namespace BackBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Class AbstractManager
 * @package BackBundle\Manager
 */
abstract class AbstractManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    protected $class;

    /**
     * @param EntityManager $em
     * @param $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->class = $class;
    }

    public function getEm()
    {
        return $this->em;
    }

    public function createObject()
    {
        $class = $this->getClass();

        return new $class();
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getReference($id)
    {
        return $this->em->getReference($this->class, $id);
    }

    public function load($id)
    {
        return $this->repository->find($id);
    }

    public function loadOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function loadBy(array $criteria, array $order = null)
    {
        return $this->repository->findBy($criteria, $order);
    }

    public function loadAll()
    {
        return $this->repository->findAll();
    }

    public function flush()
    {
        $this->em->flush();
    }

    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush($entity);
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush($entity);
    }

}