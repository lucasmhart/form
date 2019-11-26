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
        $args = array(
            'field_id' => 'myprefix_setting-id-4',
            'field_title' => 'Field Title',
            'field_render' => 'field_render',
            'group' => 'general',
            'label' => 'Field title',
            'sanitize_callback' => 'sanitize_text_field',
            'validation_callback' => 'some_validation_function',
            'description' => 'Field description',
            'default_value' => 'Default',
            'wrapper_class' => 'field-wrapper-class'
        );
        
        add_action( 'admin_init', function() use ( $args ){
            add_settings_field(
                $args['field_id'],
                $args['field_title'],
                function() use ( $args ){
                    $twig = new Twig();
                    $form = new AztecForm();

                    $form->add( 'task', EmailType::class, [
                        'required' => false,
                        'label' => 'my_label',
                        'data' => get_option( $args['field_id'] ),
                        'compound' => true,
                        'row_attr' => [
                            'name' => 'myname',
                            'id' => $args['field_id']
                        ],
                        'attr' => [
                            'class' => 'teste',
                        ]
                    ] );
            
                    $context = [
                        'form' => $form->createView(),
                    ];
            
                    echo  $twig->render( 'row.html.twig', $context );
                },
                $args['group'],
                'default',
                $args
            );
        });
    }
}
