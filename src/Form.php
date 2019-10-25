<?php

namespace Aztec\Form;

use Aztec\Form\Register\EmailRegister;

class Form
{
    const NAMESPACE = '\\Aztec\\Form\\Form';

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
        EmailRegister::register( $group, $field_id, $args );
    }
}
