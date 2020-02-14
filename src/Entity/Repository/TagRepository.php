<?php

namespace Smart\ContentBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Smart\ContentBundle\Entity\Tag;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class TagRepository extends EntityRepository
{
    /**
     * @param int|null $limit
     * @return Tag[]
     */
    public function getAllWithPublishedPosts($limit = null)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.posts', 'p')
            ->andWhere('p.publishedAt IS NOT NULL')
            ->andWhere('p.enabled = 1')
            ->orderBy('t.title', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
