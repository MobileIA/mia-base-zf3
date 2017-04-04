<?php

namespace MIABase\Action;

/**
 * Description of Edit
 *
 * @author matiascamiletti
 */
class Edit extends Add
{
    protected function prepareForm()
    {
        $this->form->populateValues($this->getModel()->toArray());
        $this->form->get('submit')->setValue('Guardar');
        return $this->form;
    }
    
    protected function getModel()
    {
        if($this->model == null){
            $itemId = $this->controller->params()->fromRoute('id');
            $this->model = $this->table->fetchById($itemId);
        }
        return $this->model;
    }
}