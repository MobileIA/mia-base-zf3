<?php

namespace MIABase\Form;

/**
 * Description of Base
 *
 * @author matiascamiletti
 */
class Base extends \Zend\Form\Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
    }
    /**
     * Obtiene el tipo de elemento
     * @param \Zend\Form\Element $element
     * @return string
     */
    public function getElementType($element)
    {
        $data = explode('\\', get_class($element));
        return strtolower($data[count($data)-1]);
    }
    /**
     * Devuelve si tiene errores
     * @param \Zend\Form\Element $element
     * @return boolean
     */
    public function hasErrorElement($element)
    {
        $messages = $element->getMessages();
        if (empty($messages)) {
            return false;
        }
        return true;
    }
    /**
     *
     * @param bool $onlyBase
     */
    public function populateValues($data, $onlyBase = false)
    {
        parent::populateValues($data);
        // Popular los FieldSet personalizados que contenga este formulario
        foreach ($this->iterator as $name => $elementOrFieldset) {
            if ($elementOrFieldset instanceof \Zend\Form\FieldsetInterface) {
                $elementOrFieldset->populateValues($data);
            }
        }
    }
}