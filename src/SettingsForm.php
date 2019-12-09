<?php

namespace Aztec\Form;

use Aztec\Form\Classes\Form as AztecForm;
use Aztec\Form\Classes\Twig;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SettingsForm
{
    /**
     * Function to add input to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function text( $group, $field_id, $type, $args )
    {        
        add_action( 'admin_init', function() use ( $group, $field_id, $type, $args ){
            register_setting( $group, $field_id, 'esc_attr');
            add_settings_field(
                $field_id,
                $args['field_title'],
                function() use ( $field_id, $type, $args ){
                    $twig = new Twig();
                    $form = new AztecForm();

                    $required = isset( $args['required'] ) ? $args['required'] : false;
                    $class = isset( $args['wrapper_class'] ) ? $args['wrapper_class'] : '';
                    
                    $default_value = get_option( $field_id );
                    if( empty( $default_value ) ) {
                        $default_value = isset( $args['default_value'] ) ? $args['default_value'] : '';
                    }

                    $form->add( $field_id, $type, [
                        'required' => $required,
                        'data' => $default_value,
                        'attr' => [
                            'class' => $class,
                        ]
                    ] );
            
                    $context = [
                        'form' => $form->createView(),
                    ];
            
                    echo  $twig->render( 'row.html.twig', $context );
                },
                $group,
                'default',
                $args
            );
        });
    }

    /**
     * Function to add select to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function select( $group, $field_id, $type, $args )
    {
        add_action( 'admin_init', function() use ( $group, $field_id, $type, $args ){
            register_setting( $group, $field_id, 'esc_attr');
            add_settings_field(
                $field_id,
                $args['field_title'],
                function() use ( $field_id, $type, $args ){
                   
                    $twig = new Twig();
                    $form = new AztecForm();

                    $required = isset( $args['required'] ) ? $args['required'] : false;
                    $class = isset( $args['wrapper_class'] ) ? $args['wrapper_class'] : '';
                    
                    $default_value = get_option( $field_id );
                    if( empty( $default_value ) ) {
                        $default_value = isset( $args['default_value'] ) ? $args['default_value'] : '';
                    }

                    $form->add( $field_id, $type, [
                        'required' => $required,
                        'placeholder' => $args['placeholder'],
                        'attr' => [
                            'class' => $class,
                        ],
                        'choices' => $args['choices'],
                        'data' => $args['default_value'],
                    ] );
            
                    $context = [
                        'form' => $form->createView(),
                    ];
            
                    echo  $twig->render( 'row.html.twig', $context );
                },
                $group,
                'default',
                $args
            );
        });
    }

}
