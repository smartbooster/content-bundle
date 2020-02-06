<?php

namespace Smart\ContentBundle\Admin;

use Smart\SonataBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class TagAdmin extends AbstractAdmin
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
        $form

            ->tab('tab.label_content')
                ->with('fieldset.label_general', ['class' => 'col-md-8'])
                    ->add('name')
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
                ->with('fieldset.label_general', ['class' => 'col-md-8'])
                    ->add('name', null, ['label' => 'form.label_name'])
                ->end()
            ->end()
        ;
    }
}
