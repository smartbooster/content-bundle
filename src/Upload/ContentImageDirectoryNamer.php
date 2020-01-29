<?php

namespace Smart\ContentBundle\Upload;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Util\Transliterator;

/**
 * https://www.prestaconcept.net/blog/symfony/vichuploaderbundle-dry-configuration
 */
class ContentImageDirectoryNamer implements DirectoryNamerInterface
{
    /**
     * @var Transliterator
     */
    protected $transliterator;

    public function __construct(Transliterator $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    /**
     * Get short class name of given object :
     *  - AppBundle\Entity\Product : product
     *  - AppBundle\Entity\User : user
     *
     * @param object $object
     * @param PropertyMapping $mapping
     * @return string
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        $fqcn = get_class($object);
        $classParts = explode('\\', $fqcn);

        return $this->transliterator->transliterate(array_pop($classParts));
    }
}
