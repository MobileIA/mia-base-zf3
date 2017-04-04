<?php

namespace MIABase\Action\Add;

/**
 * Description of Relation
 *
 * @author matiascamiletti
 */
class Relation extends \MIABase\Action\Add
{
    /**
     * Nombre de la columna que se va a tener en cuenta
     * @var string
     */
    protected $relationColumn = '';
    
    protected function save()
    {
        $this->model->exchangeArray($this->form->getData());
        $this->table->save($this->model);
        
        return $this->controller->redirect()->toRoute($this->route . '/list', array('id' => $this->model->{$this->relationColumn}));
    }
    
    public function setRelationColumn($column){ $this->relationColumn = $column; }
}