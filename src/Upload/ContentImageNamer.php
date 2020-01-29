<?php

namespace Smart\ContentBundle\Upload;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Util\Transliterator;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class ContentImageNamer implements NamerInterface
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
     * {@inheritdoc}
     */
    public function name($object, PropertyMapping $mapping): string
    {
        $file = $mapping->getFile($object);
        $name = $this->transliterator->transliterate((string) $object);

        if ($extension = $file->guessExtension()) {
            $name = sprintf('%s_%s.%s', $name, date('YmdHis'), $extension);
        }

        return $name;
    }
}
