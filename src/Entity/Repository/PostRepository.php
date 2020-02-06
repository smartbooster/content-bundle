<?php

namespace Smart\ContentBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Smart\ContentBundle\Entity\Category;
use Smart\ContentBundle\Entity\Post;
use Smart\ContentBundle\Entity\Tag;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class PostRepository extends EntityRepository
{
    /**
     * @return \DateTime|null
     */
    public function getLastPublishedPostDate()
    {
        if (null !== $post = $this->getLastPublishedPost()) {
            return $post->getPublishedAt();
        }

        return null;
    }

    /**
     * @param int $count
     * @param Category|null $category
     * @param Tag|null $tag
     *
     * @return Post[]
     */
    public function getLastPublishedPosts($count = 3, $category = null, $tag = null)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        if ($category !== null) {
            $queryBuilder
                ->andWhere('p.category = :category')
                ->setParameter(':category', $category);
        }
        if ($tag !== null) {
            $queryBuilder
                ->leftJoin('p.tags', 't')
                ->andWhere('t.id = :tag')
                ->setParameter(':tag', $tag);
        }
        $queryBuilder
            ->andWhere('p.publishedAt IS NOT NULL')
            ->andWhere('p.enabled = 1')
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults($count);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Category|null $category
     * @param Tag|null $tag
     * @return Post|null
     */
    public function getLastPublishedPost($category = null, $tag = null)
    {
        $posts = $this->getLastPublishedPosts(1, $category, $tag);
        
        if (count($posts)) {
            return array_pop($posts);
        }

        return null;
    }
}
