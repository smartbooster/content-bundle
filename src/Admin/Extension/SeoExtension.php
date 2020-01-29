<?php

namespace Smart\ContentBundle\Admin\Extension;

use Cocur\Slugify\Slugify;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class SeoExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('tab.label_seo')
                ->with('fieldset.label_routing')
                    ->add('url', null, [
                        'required' => false,
                        'help' => 'url.help'
                    ])
                ->end()
                ->with('fieldset.label_metadata')
                    ->add('seoDescription', null, [
                        'attr' => [
                            'rows' => 5
                        ]
                    ])
                    ->add('customMetaTags', null, [
                        'attr' => [
                            'rows' => 5
                        ],
                        'help' => 'custom_metatags.help'
                    ])
                ->end()
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureShowFields(ShowMapper $show)
    {
        $show
            ->tab('tab.label_seo')
                ->with('fieldset.label_routing')
                    ->add('url', null, ['label' => 'form.label_url'])
                ->end()
                ->with('fieldset.label_metadata')
                    ->add('seoDescription', null, ['label' => 'form.label_seo_description'])
                    ->add('customMetaTags', null, ['label' => 'form.label_custom_meta_tags'])
                ->end()
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function prePersist(AdminInterface $admin, $object)
    {
        if (null === $object->getUrl()) {
            $slugify = new Slugify();
            $object->setUrl($slugify->slugify($object->__toString()));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function preUpdate(AdminInterface $admin, $object)
    {
        $this->prePersist($admin, $object);
    }
}
