<?php

namespace Smart\ContentBundle\Entity\Traits;

use Doctrine\Orm\Mapping as ORM;

trait SeoTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    protected $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_meta_tags", type="text", nullable=true)
     */
    protected $customMetaTags;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setSeoDescription($description)
    {
        $this->seoDescription = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomMetaTags()
    {
        return $this->customMetaTags;
    }

    /**
     * @param string $customMetaTags
     *
     * @return $this
     */
    public function setCustomMetaTags($customMetaTags)
    {
        $this->customMetaTags = $customMetaTags;

        return $this;
    }
}
