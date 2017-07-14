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
     * Para cambiar el part de listado facilmente
     * @var string
     */
    protected $partListName = '\MIABase\Action\ListAction';
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
        $action = new $this->partListName();
        $action->setTable($this->getTable());
        $action->setController($this);
        $action->setRoute($this->route);
        $action->addOption('columns', $this->columns());
        $action->addOption('has_search', true);
        $this->configAction($action);
        
        $view = $action->execute();
        $view->setVariable('route', $this->route);
        $view->setVariable('string', $this->getStrings());
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
        $view->setVariable('route', $this->route);
        $view->setVariable('string', $this->getStrings());
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
        $view->setVariable('string', $this->getStrings());
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
    
    protected function getStrings()
    {
        return array(
            'main_title' => 'Nombre APP',
            'main_caption' => 'Administración del listado',
            'title' => 'Listado',
            'main_title_add' => 'Nuevo',
            'main_caption_add' => 'Administración del listado',
        );
    }
    
    protected function configAction($action){}
    
    abstract function columns();
    abstract function fields();
}