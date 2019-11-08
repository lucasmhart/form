<?php
namespace Aztec\Form;

use Aztec\Form\Classes\Form as AztecForm;
use Aztec\Form\Classes\Twig;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Form
{
    /**
     * Function to add field to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function email(
        $group,
        $field_id,
        $type,
        $args
    ) {
        $twig = new Twig();
        $form = new AztecForm();

        $form->add('field_id', EmailType::class, [
            'required' => false,
            'label' => 'my_label',
            'data' => 'a123',
            'attr' => [
                'class' => 'regular-text ltr ' + $args['wrapper_class'],
                'id' => $field_id
            ]
        ]);

        $context = [
            'form' => $form->createView(),
        ];

        try {
            return $twig->render('row.html.twig', $context);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function text()
    {
        $twig = new Twig();
        $form = new AztecForm();

        $form->add('task', EmailType::class, [
            'required' => false,
            'label' => 'my_label',
            'data' => 'a123',
            'attr' => [
                'class' => 'teste',
                'id' => 'my_id'
            ]
        ]);
        
        $context = [
            'form' => $form->createView(),
        ];

        return $twig->render('row.html.twig', $context);
    }
}
