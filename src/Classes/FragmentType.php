<?php

namespace Aztec\Form\Classes;

use Symfony\Component\Form\Extension\Core\DataMapper\PropertyPathMapper;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class FragmentType extends BaseType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        
        parent::buildView($view, $form, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->setCompound(true)
            ->setDataMapper(new PropertyPathMapper())
        ;
    }
}
