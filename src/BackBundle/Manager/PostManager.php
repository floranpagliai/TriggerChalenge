<?php
/**
 * User: floran
 * Date: 23/10/2016
 * Time: 17:52
 */

namespace BackBundle\Manager;

use BackBundle\Entity\Post;

class PostManager extends AbstractManager
{

    public function getAll($orderBy = 'DESC')
    {
        $q = $this->em->createQueryBuilder()
            ->select('post')
            ->from($this->class, 'post')
            ->leftJoin("post.coverPicture", "coverPicture")
            ->leftJoin("post.author", "author")
            ->orderBy('post.createdAt', $orderBy);

        return $q->getQuery()->getResult();
    }

    /**
     * @param $userId
     * @param string $orderBy
     *
     * @return \BackBundle\Entity\Post[]
     */
    public function getByUserId($userId, $orderBy = 'DESC')
    {
        $q = $this->em->createQueryBuilder()
            ->select('post')
            ->from($this->class, 'post')
            ->leftJoin("post.coverPicture", "coverPicture")
            ->leftJoin("post.author", "author")
            ->where('post.author = :userId')->setParameter('userId', $userId)
            ->orderBy('post.createdAt', $orderBy);

        return $q->getQuery()->getResult();
    }
}