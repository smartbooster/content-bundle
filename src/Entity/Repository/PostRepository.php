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
    const DIRECTION_PREVIOUS = 'previous';
    const DIRECTION_NEXT = 'next';

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

    /**
     * @param Post|null $post
     * @param Category|null $category
     * @param Tag|null $tag
     *
     * @return Post|null
     */
    public function getPreviousPost(Post $post = null, $category = null, $tag = null)
    {
        return $this->getClosestPost($post, 'previous', $category, $tag);
    }

    /**
     * @param Post|null $post
     * @param Category|null $category
     * @param Tag|null $tag
     *
     * @return Post|null
     */
    public function getNextPost(Post $post = null, $category = null, $tag = null)
    {
        return $this->getClosestPost($post, 'next', $category, $tag);
    }

    /**
     * @param Post|null $post
     * @param string $direction
     * @param Category|null $category
     * @param Tag|null $tag
     *
     * @return Post|null
     */
    protected function getClosestPost(Post $post = null, $direction = 'next', $category = null, $tag = null)
    {
        if (null === $post || null === $post->getPublishedAt()) {
            return null;
        }

        $queryBuilder = $this->createQueryBuilder('p');

        if ($direction === 'next') {
            $queryBuilder
                ->andWhere('p.publishedAt < :date')
                ->orderBy('p.publishedAt', 'DESC');
        } else {
            $queryBuilder
                ->andWhere('p.publishedAt >= :date')
                ->orderBy('p.publishedAt', 'ASC');
        }

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

        return $queryBuilder
            ->setParameter(':date', $post->getPublishedAt())
            ->andWhere('p.publishedAt IS NOT NULL')
            ->andWhere('p.enabled = 1')
            ->andWhere('p.id != ' . $post->getId())
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
