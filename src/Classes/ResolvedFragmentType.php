<?php

namespace Aztec\Form\Classes;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\ResolvedFormType;

class ResolvedFragmentType extends ResolvedFormType
{
    /**
     * Configures a form view for the type hierarchy.
     *
     * This method is called before the children of the view are built.
     *
     * @param FormView      $view    The form view to configure
     * @param FormInterface $form    The form corresponding to the view
     * @param array         $options The options used for the configuration
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($view->parent) {
            $view->parent->vars['full_name'] = '';
            $view->parent->vars['help_translation_parameters'] = array();
         }
        parent::buildView($view, $form, $options);
    }
}
