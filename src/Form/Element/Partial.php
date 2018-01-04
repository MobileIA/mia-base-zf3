<?php

namespace MIABase\Form\Element;

/**
 * Description of Partial
 *
 * @author matiascamiletti
 */
class Partial extends \Zend\Form\Element
{
    /**
     * Almacena los parametros que se enviaran a la vistas
     * @var array
     */
    protected $params = array();
    /**
     * Almacena el nombre de la vista a cargar
     * @var string
     */
    protected $viewName = '';
    /**
     * Agrega un parametro a la vista
     * @param string $key
     * @param mixed $value
     */
    public function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }
    /**
     * Setea un array de parametros a la vista
     * @param array $values
     */
    public function setParams($values)
    {
        $this->params = $values;
    }
    /**
     * Devuelve los parametros para la vista
     * @return array
     */
    public function getAllParams()
    {
        return $this->params;
    }
    /**
     * Setea la vista a imprimir
     * @param string $name
     */
    public function setViewName($name)
    {
        $this->viewName = $name;
    }
    /**
     * Devuelve la vista
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }
}