<?php

namespace MIABase\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of BaseController
 *
 * @author matiascamiletti
 */
class BaseController extends AbstractActionController
{
    /**
     * Almacena el nombre de la clase de la tabla
     * @var string
     */
    protected $tableName = '';
    /**
     * Instancia de la tabla
     * @var \MIABase\Table\Base
     */
    protected $table = null;
    /**
     * Almanena el nombre de la clase del formulario
     * @var string
     */
    protected $formName = '';
    /**
     * Instancia del formulario
     * @var \MIABase\Form\Base
     */
    protected $form = null;
    
    /**
     * 
     * @return \MIABase\Table\Base
     */
    public function getTable()
    {
        if($this->table === null){
            $this->table = $this->getServiceManager()->get($this->tableName);
        }
        return $this->table;
    }
    
    public function getForm()
    {
        if($this->form === null){
            $this->form = new $this->formName();
            $this->form->setServiceManager($this->getServiceManager());
        }
        return $this->form;
    }
    
    /**
     * 
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }
}
