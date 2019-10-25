<?php

namespace Aztec\Form\Render\Notice;

class ErrorNotice
{
    public static function render( $field_id, $message )
    {
        add_settings_error( $field_id, $field_id . '-error', $message );
    }
}
