<?php

namespace Smart\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Smart\ContentBundle\Entity\Traits\ContentTrait;
use Smart\ContentBundle\Entity\Traits\ImageTrait;
use Smart\ContentBundle\Entity\Traits\NameableTrait;
use Smart\ContentBundle\Entity\Traits\SeoTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 *
 * @ORM\Entity(repositoryClass="Smart\ContentBundle\Entity\Repository\AuthorRepository")
 * @ORM\Table(name="smart_content_author")
 *
 * @Vich\Uploadable
 * @UniqueEntity({"name"})
 * @UniqueEntity({"url"})
 */
class Author
{
    use NameableTrait;
    use ImageTrait;
    use ContentTrait;
    use SeoTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
