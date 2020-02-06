<?php

namespace Smart\ContentBundle\Admin;

use Smart\SonataBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class CategoryAdmin extends AbstractAdmin
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
                
                ->end()
            ->end()
        ;
    }
}
