<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 07/02/2017
 * Time: 23:26
 */

namespace BackBundle\Manager;


class PostLikeManager extends AbstractManager
{

    /**
     * @param $idPost
     * @param null $idUser
     * @return int
     */
    public function countByPost($idPost, $idUser = null)
    {
        $q = $this->em->createQueryBuilder()
            ->select('COUNT(postLike)')
            ->from($this->class, 'postLike')
            ->where('postLike.post = :idPost')->setParameter('idPost', $idPost)
            ->andWhere('postLike.deleted = 0');
        if ($idUser !== null) {
            $q->andWhere('postLike.user = :idUser')->setParameter('idUser', $idUser);
        }

        return $q->getQuery()->getSingleScalarResult();
    }
}