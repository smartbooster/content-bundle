<?php

namespace Smart\ContentBundle\Admin\Extension;

use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class ContentExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {

        $list
            ->add('title', null, ['label' => 'form.label_title'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('tab.label_content')
                ->with('fieldset.label_general', ['class' => 'col-md-8'])
                    ->add('title')
                    ->add('description', null, [
                        'attr' => [
                            'rows' => 5
                        ]
                    ])
                    ->add('content', null, [
                        'attr' => [
                            'rows' => 25,
                            'class' => 'wysiwyg'
                        ]
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
            ->tab('tab.label_content')
                ->with('fieldset.label_general', ['class' => 'col-md-8'])
                    ->add('title', null, ['label' => 'form.label_title'])
                    ->add('description', null, ['label' => 'form.label_description'])
                    ->add('content', null, [
                        'label' => 'form.label_content',
                        'safe' => true
                    ])
                ->end()
            ->end()
        ;
    }
}
