<?php

namespace Smart\ContentBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Smart\ContentBundle\Entity\Category;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @param int|null $limit
     * @return Category[]
     */
    public function getAllWithPublishedPosts($limit = null)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.posts', 'p')
            ->andWhere('p.publishedAt IS NOT NULL')
            ->andWhere('p.enabled = 1')
            ->orderBy('c.title', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
