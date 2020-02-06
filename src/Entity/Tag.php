<?php

namespace Smart\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Smart\ContentBundle\Entity\Traits\NameableTrait;
use Smart\ContentBundle\Entity\Traits\SeoTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Smart\ContentBundle\Entity\Repository\TagRepository")
 * @ORM\Table(name="smart_content_tag")
 *
 * @UniqueEntity({"name"})
 * @UniqueEntity({"url"})
 */
class Tag
{
    use NameableTrait;
    use SeoTrait;
    
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|Post[]
     *
     * @ORM\ManyToMany(targetEntity="Smart\ContentBundle\Entity\Post", mappedBy="tags")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection|Post[] $posts
     *
     * @return $this
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }
}
