<?php

namespace Smart\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Smart\ContentBundle\Entity\Traits\ContentTrait;
use Smart\ContentBundle\Entity\Traits\ImageTrait;
use Smart\ContentBundle\Entity\Traits\SeoTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 *
 * This entity has been named media to be able to handle files : pdf, doc... in the future
 * Waiting for a real use case to implement
 * Right now media handle Image only
 *
 * @ORM\Entity(repositoryClass="Smart\ContentBundle\Entity\Repository\MediaRepository")
 * @ORM\Table(name="smart_content_media")
 *
 * @Vich\Uploadable
 *
 * @UniqueEntity({"url"})
 */
class Media
{
    use ContentTrait;
    use ImageTrait;
    use SeoTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
