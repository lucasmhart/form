<?php

namespace Aztec\Form\Render\Input;

class EmailRender
{
    public static function render( $args )
    {
        echo '<input 
                name="' . $args['field_id'] . '" 
                type="email" id="' . $args['field_id'] . '" 
                value="' . get_option($args['field_id']) . '" 
                class="regular-text ltr ' . $args['wrapper_class'] . ' "
            >';
    }
}
