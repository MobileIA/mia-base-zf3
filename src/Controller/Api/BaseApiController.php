<?php

namespace MIABase\Controller\Api;

/**
 * Description of CrudController
 *
 * @author matiascamiletti
 */
abstract class BaseApiController extends \MIABase\Controller\BaseController
{
    /**
     * 
     * @var array
     */
    protected $values = array();
    /**
     *
     * @var boolean
     */
    protected $hasValidateParams = false;
    
    /**
     * Obtiene un parametro de donde sea que fue recibido
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    protected function getParam($name, $default = '')
    {
        // Procesar los parametros si es enviado como JSON.
        if(!$this->hasValidateParams){
            $this->validateParams();
            $this->hasValidateParams = true;
        }
        
        if(is_object($this->values) && $this->values->{$name} != $default){
            return $this->values->{$name};
        }
        if(is_array($this->values) && array_key_exists($name, $this->values)){
            return $this->values[$name];
        }
        $post = $this->params()->fromPost($name, $default);
        if($post != $default){
            return $post;
        }
        $query = $this->params()->fromQuery($name, $default);
        if($query != $default){
            return $query;
        }
        
        return $default;
    }
    /**
     * Obtiene el JSON y lo procesa.
     */
    protected function validateParams()
    {
        $body = $this->getRequest()->getContent();
        
        if($body == ''){
            return false;
        }
        
        try {
            $this->values = \Zend\Json\Json::decode($body);
        } catch (Exception $exc) {}

        return true;
    }
}
