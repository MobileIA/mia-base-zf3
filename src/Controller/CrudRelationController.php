<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MIABase\Controller;

/**
 * Description of CrudRelationController
 *
 * @author matiascamiletti
 */
abstract class CrudRelationController extends CrudController
{
    /**
     * Nombre de la columna que se va a tener en cuenta
     * @var string
     */
    protected $relationColumn = '';
    /**
     * Valor a tener en cuenta para la relación
     * @var mixed
     */
    protected $relationValue = 0;
    
    protected $partAddName = '\MIABase\Action\Add\Relation';
    
    protected $partEditName = '\MIABase\Action\Edit\Relation';
    
    protected $partRemoveName = '\MIABase\Action\Remove\Relation';
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        // Obligamos a obtener el valor de relacion
        $this->setRelationValue();
        // Configuramos el formulario
        $this->configForm();
        // Dispatch normal
        parent::onDispatch($e);
    }
    
    public function indexAction()
    {
        $view = parent::indexAction();
        $view->setVariable('is_relation', true);
        $view->setVariable('relation_value', $this->relationValue);
        return $view;
    }
    
    protected function configForm()
    {
        $this->getForm()->get($this->relationColumn)->setValue($this->relationValue);
    }
    
    protected function configAction($action)
    {
        if($action instanceof \MIABase\Action\ListAction){
            $action->addWhere(new \Zend\Db\Sql\Predicate\Expression($this->relationColumn . ' = ' . $this->relationValue));
        }else if($action instanceof \MIABase\Action\Add\Relation || $action instanceof \MIABase\Action\Edit\Relation || $action instanceof \MIABase\Action\Remove\Relation){
            $action->setRelationColumn($this->relationColumn);
        }
    }
    
    abstract protected function setRelationValue();
}