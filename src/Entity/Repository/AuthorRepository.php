<?php

namespace Smart\ContentBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Smart\ContentBundle\Entity\Author;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class AuthorRepository extends EntityRepository
{
    /**
     * @param int|null $limit
     * @return Author[]
     */
    public function getAllWithPublishedPosts($limit = null)
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.posts', 'p')
            ->andWhere('p.publishedAt IS NOT NULL')
            ->andWhere('p.enabled = 1')
            ->orderBy('a.title', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
