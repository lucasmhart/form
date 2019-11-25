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

        $input =  $twig->render('row.html.twig', $context);
        
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
        
        add_action('admin_init', function() use ($args){
            add_settings_field(
                $args['field_id'],
                $args['field_title'],
                function() use ($args){
                    echo '<input
                        name="'. $args['field_id'] .'"
                        type="email"
                        id="'. $args['field_id'] .'"
                        value="' . get_option($args['field_id']) . '"
                        class="regular-text ltr"
                        >';
                },
                $args['group'],
                'default',
                $args
            );
        });

        // /** ------------------------------------------------------ */
        // $field_id = 'general';
        // $group = 'myprefix_setting-id-4';
        // $args = array(
        //     'label' => "Field title",
        //     'sanitize_callback' => 'sanitize_text_field',
        //     'validation_callback' => 'some_validation_function',
        //     'description' => 'Field description',
        //     'default_value' => 'Default',
        //     'wrapper_class' => 'field-wrapper-class'
        // );
        // add_action('admin_init', function () use ($field_id, $group, $args, $input) {
        //     register_setting($group, $field_id, [
        //         'type' => 'string',
        //         'sanitize_callback' => $args['sanitize_callback'],
        //         'description' => $args['description'],
        //         'show_in_rest' => true,
        //         'default' => $args['default_value'],
        //     ]);

        //     add_settings_field(
        //         $field_id,
        //         $args['label'],
        //         $input,
        //         $group,
        //         'default',
        //         array(
        //             'field_id' => $field_id,
        //             'label_for' => $field_id,
        //             'wrapper_class' => $args['wrapper_class'],
        //         )
        //     );

        //     if (isset($_POST)) {
        //         ErrorNotice::render($field_id, 'Notice error render');
        //     }
        // });
    }
}
