<?php

namespace MIABase\Action;

/**
 * Description of Delete
 *
 * @author matiascamiletti
 */
class Remove extends Base
{
    public function getModel()
    {
        $itemId = $this->controller->params()->fromRoute('id');
        return $this->table->fetchById($itemId);
    }
    
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
        
        return $this->controller->redirect()->toRoute($this->route . '/list');
    }

}