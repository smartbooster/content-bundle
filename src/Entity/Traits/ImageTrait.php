<?php

namespace Smart\ContentBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * https://symfony.com/doc/master/bundles/EasyAdminBundle/integration/vichuploaderbundle.html
 */
trait ImageTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $image;

    /**
     * @Vich\UploadableField(mapping="smart_content_image", fileNameProperty="image")
     *
     * @Assert\Image
     * @Assert\File(maxSize="500k")
     *
     * @var File
     */
    protected $imageFile;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasImage()
    {
        return ($this->image !== null);
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * It is required that at least one field changes if you are using Doctrine,
     * otherwise the event listeners won't be called and the file is lost
     *
     * @param File|UploadedFile $file
     *
     * @return $this
     */
    public function setImageFile(File $file = null)
    {
        $this->imageFile = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }
}
