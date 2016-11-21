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

    /**
     * @param null $limit
     * @param string $orderBy
     *
     * @return Post[]
     */
    public function getAll($limit = null, $orderBy = 'DESC')
    {
        $q = $this->em->createQueryBuilder()
            ->select('post')
            ->from($this->class, 'post')
            ->orderBy('post.createdAt', $orderBy);
        if ($limit != null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }

    /**
     * @param $userId
     * @param null $limit
     * @param string $orderBy
     *
     * @return \BackBundle\Entity\Post[]
     */
    public function getByUserId($userId, $limit = null, $orderBy = 'DESC')
    {
        $q = $this->em->createQueryBuilder()
            ->select('post')
            ->from($this->class, 'post')
            ->leftJoin("post.coverPicture", "coverPicture")
            ->leftJoin("post.author", "author")
            ->where('post.author = :userId')->setParameter('userId', $userId)
            ->orderBy('post.createdAt', $orderBy);
        if ($limit != null) {
            $q->setMaxResults($limit);
        }

        return $q->getQuery()->getResult();
    }
}