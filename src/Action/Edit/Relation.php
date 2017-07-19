<?php

namespace MIABase\Action\Edit;

/**
 * Description of Relation
 *
 * @author matiascamiletti
 */
class Relation extends \MIABase\Action\Edit
{
    /**
     * Nombre de la columna que se va a tener en cuenta
     * @var string
     */
    protected $relationColumn = '';
    
    protected function save()
    {
        // Copiamos datos antes de editar
        $this->old->exchange($this->getModel()->toArray());
        $this->model->exchangeArray($this->form->getData());
        $this->table->save($this->model);
        // Verificamos si existe una funcionalidad extra al ser editado
        if(method_exists($this->controller, 'modelEdited')){
            $this->controller->modelEdited($this->old, $this->model);
        }
        
        return $this->controller->redirect()->toRoute($this->route . '/list', array('id' => $this->model->{$this->relationColumn}));
    }
    
    public function setRelationColumn($column){ $this->relationColumn = $column; }
}