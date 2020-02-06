<?php

namespace Smart\ContentBundle\Admin;

use Smart\SonataBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class AuthorAdmin extends AbstractAdmin
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
                ->with('fieldset.label_general')
                ->end()
            ->end()
        ;
    }
}
