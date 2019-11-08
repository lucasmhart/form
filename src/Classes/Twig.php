<?php

namespace Aztec\Form\Classes;

use Symfony\Bridge\Twig\AppVariable;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class Twig
{
    /**
     * Default form theme
     * 
     * @var array
     */
    protected $defaultFormTheme;

    /**
     * Directory of AppVariable
     * 
     * @var string
     */
    protected $vendorTwigBridgeDirectory;

    /**
     * Views directory path
     * 
     * @var string
     */
    protected $viewsDirectory;

    /**
     * Twig environment
     * 
     * @var Environment
     */
    protected $environment;

    public function __construct()
    {
        $this->setDefaultValues();

        $this->setEnvironment();
        $this->setRuntimeLoader();
        $this->setExtensions();
    }

    /**
     * set the default values of variables
     */
    private function setDefaultValues()
    {
        $appVariableReflection = new \ReflectionClass(AppVariable::class);
        $this->vendorTwigBridgeDirectory = dirname($appVariableReflection->getFileName());

        $this->viewsDirectory = realpath(__DIR__ . '/../template');

        $this->defaultFormTheme = [
            'form_div_layout.html.twig',
            'blocks.html.twig'
        ];
    }

    /**
     * set default environment
     */
    private function setEnvironment()
    {
        $this->environment =  new Environment(new FilesystemLoader([
            $this->viewsDirectory,
            $this->vendorTwigBridgeDirectory . '/Resources/views/Form',
        ]));
    }

    /**
     * Get environment
     * 
     * @return Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * set runtime loader
     */
    private function setRuntimeLoader()
    {
        $formEngine = new TwigRendererEngine($this->defaultFormTheme, $this->environment);
        $this->environment->addRuntimeLoader(
            new FactoryRuntimeLoader([
                FormRenderer::class => function () use ($formEngine) {
                    return new FormRenderer($formEngine);
                }
            ])
        );
    }

    /**
     * Set environment extensions
     */
    private function setExtensions()
    {
        $this->environment->addExtension(new FormExtension());
        $this->environment->addExtension(new TranslationExtension());
    }

    /**
     * render twig
     * 
     * @param   string  $template
     * @param   array   $context
     * @return string
     */
    public function render($template, array $context)
    {
        return $this->getEnvironment()->render($template, $context);
    }
}
