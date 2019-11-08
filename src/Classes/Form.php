<?php
namespace Aztec\Form\Classes;

use stdClass;
use Symfony\Component\Form\Forms;

class Form {
    /**
     * Form factory
     * 
     * @var Forms
     */
    protected $formFactory;

    /**
     * Form
     * 
     * @var Form
     */
    protected $form;

    /**
     * Form open tag
     * 
     * @var bool
     */
    protected $openForm = false;

    /**
     * Form nodes
     * 
     * @var array
     */
    protected $nodes = [];

    public function __construct()
    {
        $this->setFormFactory();
        $this->setForm();
    }

    /**
     * Set form factory
     */
    private function setFormFactory()
    {
        $formFactoryBuilder = Forms::createFormFactoryBuilder();
        $formFactoryBuilder->setResolvedTypeFactory(new ResolvedFragmentTypeFactory());
        $this->formFactory = $formFactoryBuilder->getFormFactory();
    }

    /**
     * Set form
     */
    private function setForm()
    {
        $this->form = $this->formFactory->createBuilder(FragmentType::class);
    }

    /**
     * Get form
     * 
     * 
     */
    private function getForm()
    {
        return $this->form->getForm();
    }

    /**
     * Set hasForm flag
     * 
     * @param bool $hasForm
     */
    public function open()
    {
        $this->openForm = true;
    }

    /**
     * Get if form will render form tag
     * 
     * @return bool
     */
    public function isFormOpen()
    {
        return $this->openForm;
    }

    /**
     * Add a node to the form
     * 
     * @param string    $name
     * @param string    $type
     * @param array     $args
     */
    public function add($name, $type, $args = [])
    {
        $node = new stdClass();
        $node->name = $name;
        $node->type = $type;
        $node->args = $args;

        array_push($this->nodes, $node);
    }

    /**
     * Create form view
     */
    public function createView()
    {
        $this->prepareFormNodes();

        return $this->getForm()->createView();
    }

    /**
     * Prepare form nodes
     */
    private function prepareFormNodes()
    {
        foreach($this->nodes as $node){
            $this->form->add($node->name, $node->type, $node->args);
        }
    }

}