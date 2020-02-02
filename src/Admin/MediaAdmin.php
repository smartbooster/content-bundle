<?php

namespace Smart\ContentBundle\Admin;

use Smart\SonataBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class MediaAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $form)
    {
        //Todo see if we can fix admin display with extension priority
        $form
            ->tab('tab.label_content')
                ->with('fieldset.label_general')
                ->end()
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->tab('tab.label_content')
                ->with('fieldset.label_general')->end()
                ->with('fieldset.label_parameters')->end()
                ->with('fieldset.label_preview')
                    ->add('formats', null, [
                        'label' => 'form.label_formats',
                        'mapped' => false,
                        'template'  => '@SmartContent/admin/show_format.html.twig',
                        'formats' => [
                            'smart_content_list_thumb',
                            'smart_content_show_thumb'
                        ]// Todo handle this with configuration https://github.com/smartbooster/content-bundle/issues/7
                    ])
                ->end()
            ->end()
        ;
    }
}
