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
    public function getParam($name, $default = '')
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
        
        if($body == '' || (substr($body, 0, 1) != '{' && (substr($body, 0, 1) != '['))){
            // Buscamos parametros por POST o Query
            $this->values = array_merge($this->params()->fromQuery(), $this->params()->fromPost());
            return true;
        }
        
        try {
            $this->values = \Zend\Json\Json::decode($body);
        } catch (Exception $exc) {}

        return true;
    }
    
    public function getAllParams()
    {
        return $this->values;
    }
    /**
     * Genera un modelo JSON como respuesta correcta
     * @param mixed $data
     * @return \Zend\View\Model\JsonModel
     */
    public function executeSuccess($data)
    {
        return new \Zend\View\Model\JsonModel(array(
            'success' => true, 
            'response' => $data
        ));
    }
    /**
     * Genera un modelo JSON como respuesta incorrecta
     * @param mixed $data
     * @return \Zend\View\Model\JsonModel
     */
    public function executeError($data)
    {
        return new \Zend\View\Model\JsonModel(array(
            'success' => false, 
            'response' => $data
        ));
    }
    /**
     * Genera un modelo JSON como respuesta a un error
     * @param int $code
     * @param string $message
     * @return \Zend\View\Model\JsonModel
     */
    public function executeErrorCode($code, $message)
    {
        return $this->executeError(array('code' => $code, 'message' => $message));
    }
}
