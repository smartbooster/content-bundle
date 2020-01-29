<?php

namespace Smart\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Smart\ContentBundle\Entity\Traits\ContentTrait;
use Smart\ContentBundle\Entity\Traits\ImageTrait;
use Smart\ContentBundle\Entity\Traits\SeoTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Smart\ContentBundle\Entity\Repository\PostRepository")
 * @ORM\Table(name="smart_content_post")
 *
 * @UniqueEntity({"url"})
 *
 * @Vich\Uploadable
 */
class Post
{
    use ContentTrait;
    use SeoTrait;
    use ImageTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="Smart\ContentBundle\Entity\Author")
     */
    protected $author;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Smart\ContentBundle\Entity\Category", inversedBy="posts")
     * @Assert\NotNull()
     */
    protected $category;

    /**
     * @var ArrayCollection|Tag[]
     *
     * @ORM\ManyToMany(targetEntity="Smart\ContentBundle\Entity\Tag", inversedBy="posts")
     */
    protected $tags;

    public function __construct()
    {
        $this->publishedAt      = new \DateTime();
        $this->tags             = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     *
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCategoryUrl()
    {
        return $this->getCategory()->getUrl();
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return ArrayCollection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection|Tag[] $tags
     *
     * @return $this
     */
    public function setTags($tags)
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag($tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }
}
