<?php

namespace Smart\ContentBundle\Admin;

use Smart\SonataBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class PostAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {

        $list
            ->addIdentifier('id')
            ->add('author')
            ->add('category')
            ->add('tags')
            ->add('enabled')
            ->add('publishedAt', 'date', [
                'format' => 'd/m/Y'
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
                ->with('fieldset.label_general')
                ->end()
                ->with('fieldset.label_parameters', ['class' => 'col-md-4'])
                    ->add('publishedAt', DatePickerType::class, [
                        'required' => false,
                        'format'   => 'dd/MM/yyyy',
                    ])
                    ->add('author')
                    ->add('category')
                    ->add('tags')
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
                ->with('fieldset.label_parameters', ['class' => 'col-md-4'])
                    ->add('publishedAt', null, ['label' => 'form.label_published_at'])
                    ->add('author', null, ['label' => 'form.label_author'])
                    ->add('category', null, ['label' => 'form.label_category'])
                    ->add('tags', null, ['label' => 'form.label_tags'])
                ->end()
            ->end()
        ;
    }
}
