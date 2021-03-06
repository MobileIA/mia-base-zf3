<?php

namespace MIABase\Action\Remove;

/**
 * Description of Relation
 *
 * @author matiascamiletti
 */
class Relation extends \MIABase\Action\Remove
{
    /**
     * Nombre de la columna que se va a tener en cuenta
     * @var string
     */
    protected $relationColumn = '';
    
    public function execute()
    {
        $item = $this->getModel();
        if($item === null){
            return;
        }
        // Verificamos si existe una funcionalidad extra al ser eliminado
        if(method_exists($this->controller, 'modelDeleted')){
            $this->controller->modelDeleted($item);
        }
        $this->table->deleteById($item->id);
        
        return $this->controller->redirect()->toRoute($this->route . '/list', array('id' => $item->{$this->relationColumn}));
    }
    
    public function setRelationColumn($column){ $this->relationColumn = $column; }
}