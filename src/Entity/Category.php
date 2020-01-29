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
 * @ORM\Entity(repositoryClass="Smart\ContentBundle\Entity\Repository\CategoryRepository")
 * @ORM\Table(name="smart_content_category")
 *
 * @UniqueEntity({"url"})
 *
 * @Vich\Uploadable
 */
class Category
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
     * @var ArrayCollection|Post[]
     *
     * @ORM\OneToMany(targetEntity="Smart\ContentBundle\Entity\Post", mappedBy="category")
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
        return (string) $this->getTitle();
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
        foreach ($posts as $post) {
            $this->addPost($post);
        }

        return $this;
    }

    /**
     * @param Post $post
     *
     * @return $this
     */
    public function addPost($post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }

        return $this;
    }
}
