<?php

namespace MIABase\Action;

/**
 * Description of Delete
 *
 * @author matiascamiletti
 */
class Remove extends Base
{
    protected function getModel()
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
        $this->table->deleteById($item->id);
        
        return $this->controller->redirect()->toRoute($this->route . '/list');
    }

}