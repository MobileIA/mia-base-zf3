<?php

namespace MIABase\Controller;

/**
 * Description of CrudController
 *
 * @author matiascamiletti
 */
abstract class CrudController extends BaseController
{
    /**
     * Route para acceder a las paginas
     * @var string
     */
    protected $route = '';
    /**
     * Setea el template a usar
     * @var string
     */
    protected $template = '';
    
    /**
     * Para cambiar el part de agregar facilmente
     * @var string
     */
    protected $partAddName = '\MIABase\Action\Add';
    /**
     * Para cambiar el part de agregar facilmente
     * @var string
     */
    protected $partEditName = '\MIABase\Action\Edit';
    /**
     * Para cambiar el part de agregar facilmente
     * @var string
     */
    protected $partRemoveName = '\MIABase\Action\Remove';
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        parent::onDispatch($e);
        $this->dispatchTemplate();
    }
    
    public function indexAction()
    {
        $action = new \MIABase\Action\ListAction();
        $action->setTable($this->getTable());
        $action->setController($this);
        $action->setRoute($this->route);
        $action->addOption('columns', $this->columns());
        $action->addOption('has_search', true);
        $this->configAction($action);
        
        $view = $action->execute();
        $view->setVariable('route', $this->route);
        $view->setTemplate($this->template . '/table/simple');
        
        return $view;
    }
    
    public function addAction()
    {
        $action = new $this->partAddName();
        $action->setTable($this->getTable());
        $action->setController($this);
        $action->setRoute($this->route);
        $action->setForm($this->getForm());
        $this->configAction($action);
        
        $view = $action->execute();
        $view->setTemplate($this->template . '/form/simple');
        
        return $view;
    }
    
    public function editAction()
    {
        $action = new $this->partEditName();
        $action->setTable($this->getTable());
        $action->setController($this);
        $action->setForm($this->getForm());
        $action->setRoute($this->route);
        $this->configAction($action);
        
        $view = $action->execute();
        $view->setVariable('route', $this->route);
        $view->setTemplate($this->template . '/form/simple');
        
        return $view;
    }
    
    public function deleteAction()
    {
        $action = new $this->partRemoveName();
        $action->setTable($this->getTable());
        $action->setController($this);
        $action->setRoute($this->route);
        $this->configAction($action);
        
        $action->execute();
    }
    
    protected function dispatchTemplate()
    {
        if($this->template == ''){
            return false;
        }
        
        $this->layout()->setTemplate($this->template);
    }
    
    protected function configAction($action){}
    
    abstract function columns();
    abstract function fields();
}