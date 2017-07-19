<?php

namespace MIABase\Form\Element;

/**
 * Description of DateRangeFieldset
 *
 * @author matiascamiletti
 */
class DateRangeFieldset extends \Zend\Form\Fieldset
{
    /**
     *
     * @var \Zend\Form\Element\Text 
     */
    protected $inputElement = null;
    /**
     *
     * @var \Zend\Form\Element\Hidden
     */
    protected $startElement = null;
    /**
     *
     * @var \Zend\Form\Element\Hidden
     */
    protected $endElement = null;
    /**
     * @param  null|int|string  $name    Optional name for the element
     * @param  array            $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        // Creamos el elemento principal
        $this->inputElement = new \Zend\Form\Element\Text($name, $options);
        // Agregamos elementos al fieldset
        $this->add($this->inputElement);
    }
    
    public function setName($name)
    {
        if($this->inputElement !== null){
            // Seteamos el nuevo nombre al input principal.
            $this->inputElement->setName($name);
            $this->inputElement->setAttribute('id', $name);
        }
        // Llamamos a funcionalidad del padre
        return parent::setName($name);
    }
    
    public function setOptions($options)
    {
        // Seteamos las nuevas opciones al elemento principal
        $this->inputElement->setOptions($options);
        // Verificamos si se cambio el ID de los campos ocultos
        if(array_key_exists('first_element_name', $options)){
            $this->startElement = new \Zend\Form\Element\Hidden($options['first_element_name']);
            $this->startElement->setName($options['first_element_name']);
            $this->startElement->setAttribute('id', $options['first_element_name']);
            $this->add($this->startElement);
        }
        if(array_key_exists('second_element_name', $options)){
            $this->endElement = new \Zend\Form\Element\Hidden($options['second_element_name']);
            $this->endElement->setName($options['second_element_name']);
            $this->endElement->setAttribute('id', $options['second_element_name']);
            $this->add($this->endElement);
        }
        // Llamamos a funcionalidad del padre
        return parent::setOptions($options);
    }
}