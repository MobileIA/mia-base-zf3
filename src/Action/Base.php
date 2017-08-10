<?php

namespace MIABase\Action;

/**
 * Description of Base
 *
 * @author matiascamiletti
 */
abstract class Base 
{
    /**
     * Instancia del controlador
     * @var \Zend\Mvc\Controller\AbstractActionController
     */
    protected $controller;
    /**
     * Instancia de la tabla
     * @var \MIABase\Table\Base
     */
    protected $table = null;
    /**
     * Instancia del formulario
     * @var \MIABase\Form\Base
     */
    protected $form = null;
    /**
     * Almacena el nombre del route
     * @var string
     */
    protected $route = '';
    /**
     * Almacenar todas las opciones disponibles
     * @var array
     */
    protected $options = array();
    /**
     *
     * @var \MIABase\Entity\Base
     */
    protected $model;
    
    /**
     * Obtiene el valor guardado
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getOption($key, $default = false)
    {
        if(array_key_exists($key, $this->options)){
            return $this->options[$key]; 
        }
        
        return $default;
    }
    /**
     * Agrega un elemento a un array de las opciones
     * @param string $key
     * @param mixed $value
     */
    public function addOption($key, $value)
    {
        if(!array_key_exists($key, $this->options)){
            $this->options[$key] = array(); 
        }
        $this->options[$key] = $value;
    }
    /**
     * Crea el modelo Entidad
     * @return mixed
     */
    public function getModel()
    {
        if($this->model == null){
            $className = $this->table->getEntityClass();
            $this->model = new $className;
        }
        return $this->model;
    }
    
    abstract function execute();
    
    public function getOptions(){ return $this->options; }
    public function setOption($key, $value){ $this->options[$key] = $value; } 
    public function setOptions($options) { $this->options = $options; } 
    public function setTable($table){ $this->table = $table; }
    public function setForm($form){ $this->form = $form; }
    public function setController($controller){ $this->controller = $controller; }
    public function setRoute($route){ $this->route = $route; }
}