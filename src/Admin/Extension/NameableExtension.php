<?php

namespace Smart\ContentBundle\Admin\Extension;

use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class NameableExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('name', null, [
                'label' => 'form.label_name',
                'show_filter' => true,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name', null, ['label' => 'form.label_name'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('tab.label_content')
                ->with('fieldset.label_general')
                    ->add('name')
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
                ->with('fieldset.label_general')
                    ->add('name', null, ['label' => 'form.label_name'])
                ->end()
            ->end()
        ;
    }
}
