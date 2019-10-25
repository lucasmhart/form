<?php

namespace Aztec\Form\Register;

use Aztec\Form\Render\Input\EmailRender;
use Aztec\Form\Render\Notice\ErrorNotice;

class EmailRegister
{

     /**
     * Register an email input to the form
     * 
     * @param string    $group
     * @param string    $field_id
     * @param array     $args     
     */
    public static function register( $group, $field_id, $args )
    {
        add_action( 'admin_init', function () use ( $field_id, $group, $args ) {
            register_setting( $group, $field_id, [
                'type' => 'string',
                'sanitize_callback' => $args['sanitize_callback'],
                'description' => $args['description'],
                'show_in_rest' => true,
                'default' => $args['default_value'],
            ] );

            add_settings_field(
                $field_id,
                $args['label'],
                array( EmailRender::class, 'render' ),
                $group,
                'default',
                array(
                    'field_id' => $field_id,
                    'label_for' => $field_id,
                    'wrapper_class' => $args['wrapper_class'],
                )
            );

            if ( isset( $_POST ) ) {
                ErrorNotice::render( $field_id, 'Notice error render' );
            }
        });
    }
}
