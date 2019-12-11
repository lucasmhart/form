<?php

namespace Aztec\Form;

use Aztec\Form\Classes\Form as AztecForm;
use Aztec\Form\Classes\Twig;
use DateTime;
use DateTimeImmutable;
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
            register_setting( $group, $field_id, 'esc_attr' );
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
            register_setting( $group, $field_id, 'esc_attr' );
            add_settings_field(
                $field_id,
                $args['field_title'],
                function() use ( $field_id, $type, $args ){
                   
                    $twig = new Twig();
                    $form = new AztecForm();

                    $required = isset( $args['required'] ) ? $args['required'] : false;
                    $class = isset( $args['wrapper_class'] ) ? $args['wrapper_class'] : '';
                    $expanded = isset( $args['expanded'] ) ? $args['expanded'] : false;
                    
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
                        'data' => $default_value,
                        'expanded' => $expanded
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
     * Function to add date input to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function date( $group, $field_id, $type, $args )
    {        
        add_action( 'admin_init', function() use ( $group, $field_id, $type, $args ){
            register_setting( $group, $field_id, 'esc_attr' );
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
                        $default_value = isset( $args['default_value'] ) ? $args['default_value'] : null;
                    }

                    $default_value = empty( $default_value ) ? null : new DateTimeImmutable( $default_value );

                    $form->add( $field_id, $type, [
                        'required' => $required,
                        'data' => $default_value,
                        'attr' => [
                            'class' => $class,
                        ],
                        'widget' => 'single_text',
                        'input'  => 'datetime_immutable'
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
     * Function to add checkbox to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function checkbox( $group, $field_id, $type, $args )
    {        
        add_action( 'admin_init', function() use ( $group, $field_id, $type, $args ){
            
            foreach( $args['choices'] as $choice ) {
                register_setting( $group, $choice['name'], 'esc_attr' );
            }
            
            add_settings_field(
                $field_id,
                $args['field_title'],
                function() use ( $type, $args ){
                    $twig = new Twig();
                    $form = new AztecForm();

                    $required = isset( $args['required'] ) ? $args['required'] : false;
                    $class = isset( $args['wrapper_class'] ) ? $args['wrapper_class'] : '';
                    
                    foreach( $args['choices'] as $choice ) {
                        $field = $choice['name'];
                        $default_value = get_option( $field );
    
                        if( empty( $default_value ) ) {
                            $default_value = isset( $args['default_value'] ) ? $args['default_value'] : false;
                        }

                        $form->add( $field , $type, [
                            'required' => $required,
                            'label' => $choice['label'],
                            'attr' => [
                                'class' => $class,
                                'checked' => $default_value
                            ],
                        ] );
                    }
            
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
     * Function to add checkbox to form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param mixed     $type
     * @param array     $args     
     */
    public static function radio( $group, $field_id, $type, $args )
    {        
        $args['expanded'] = true;
        self::select( $group, $field_id, $type, $args );
    }

}
