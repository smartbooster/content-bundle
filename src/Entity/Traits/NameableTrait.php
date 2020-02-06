<?php

namespace Smart\ContentBundle\Entity\Traits;

use Doctrine\Orm\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait NameableTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
