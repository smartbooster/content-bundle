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
class ImageExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {

        $list
            ->add('imageFile', null, [
                'template' => '@SmartContent/admin/list_field_image.html.twig',
                'label' => 'form.label_image'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('tab.label_content')
                ->with('fieldset.label_parameters', ['class' => 'col-md-4'])
                    ->add('imageFile', VichImageType::class, [
                        'required' => false,
                        'label' => 'form.label_image'
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
                ->with('fieldset.label_parameters', ['class' => 'col-md-4'])
                    ->add('imageFile', null, [
                        'template'  => '@SmartContent/admin/show_image.html.twig',
                        'fieldName' => 'imageFile',
                        'label' => 'form.label_image'
                    ])
                ->end()
            ->end()
        ;
    }
}
