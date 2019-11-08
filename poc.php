<?php

use Aztec\Form\Entity\Input;
use Aztec\Form\Type\InputType;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\ResolvedFormTypeFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/vendor/autoload.php';

function createForm($inputs)
{
    $formTypeFactory = new ResolvedFormTypeFactory();
    // $resolvedFactory = $factory->createResolvedType($formType, []);
    $registry = new FormRegistry([], $formTypeFactory);
    $formFactory = new FormFactory($registry);

    // $formType = new FormType();

    $form = $formFactory->create('Symfony\Component\Form\Extension\Core\Type\FormType', $inputs);

    return $form;
}

$input = new Input();
$input->setType('email')
    ->setName('field_name')
    ->setId('some_field_id')
    ->setValue('42')
    ->setWrapperClass('');

$input2 = new Input();
$input2->setType('text')
    ->setName('field_name_2')
    ->setId('some_field_id_2')
    ->setValue('42_2')
    ->setWrapperClass('my_class');

$form = createForm([$input, $input2]);

// var_dump($form);
// die;

// $form->handleRequest($request);

// if ($form->isSubmitted() && $form->isValid()) {
//     // $form->getData() holds the submitted values
//     // but, the original `$task` variable has also been updated
//     $task = $form->getData();

//     // ... perform some action, such as saving the task to the database
//     // for example, if Task is a Doctrine entity, save it!
//     // $entityManager = $this->getDoctrine()->getManager();
//     // $entityManager->persist($task);
//     // $entityManager->flush();
// }

// $defaultThemes = ['number.html.twig'];

// $engine = new TwigRendererEngine($defaultThemes, $environment);
// $formRenderer = new FormRenderer($engine);

// $formView = new FormView();

// echo $formRenderer->setTheme($formView, $defaultThemes, 'name');
// echo $formRenderer->renderBlock($formView, 'number');
// echo $formView->count();



$loader = new FilesystemLoader([
    '/var/www/html/form/src/templates',
    '/var/www/html/form/vendor/symfony/twig-bridge/Resources/views/Form'
]);

$twig = new Environment($loader);
$twig->addExtension(new FormExtension());

$engine = new TwigRendererEngine(['form_div_layout.html.twig'], $twig);
$renderer = new FormRenderer($engine);


echo $twig->render('form.html.twig', [
    'form' => $form->createView()
]);
