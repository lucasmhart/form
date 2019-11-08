<?php

use Aztec\Form\Classes\Form;
use Aztec\Form\Classes\Twig;
use Symfony\Component\Form\Extension\Core\Type\TextType;

require_once __DIR__ . '/vendor/autoload.php';

$twig = new Twig();
$form = new Form();


$form->add('task', TextType::class, [
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

$form_print = $twig->render('row.html.twig', $context);

var_dump($form_print);
