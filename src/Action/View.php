<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MIABase\Action;

/**
 * Description of View
 *
 * @author matiascamiletti
 */
class View extends Base
{
    public function execute()
    {
        // Generamos el viewModel
        return new \Zend\View\Model\ViewModel(array(
            'item' => $this->getModel()
        ));
    }
    /**
     * Obtiene el modelo que se quiere ver
     * @return 
     */
    public function getModel()
    {
        if($this->model == null){
            $itemId = $this->controller->params()->fromRoute('id');
            $this->model = $this->table->fetchById($itemId);
        }
        return $this->model;
    }
}