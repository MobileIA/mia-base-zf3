<?php

namespace MIABase\Action\Api;

/**
 * Description of View
 *
 * @author matiascamiletti
 */
class View extends Base
{
    public function execute()
    {
        // Obtenemos data del modelo
        $data = $this->getModel()->toArray();
        // Verificar si tiene configuración de los datos
        if(method_exists($this->controller, 'configViewData')){
            $data =  $this->controller->configViewData($data);
        }
        // Generamos el respuesta
        return $this->executeSuccess($data);
    }
    /**
     * Obtiene el modelo que se quiere ver
     * @return 
     */
    public function getModel()
    {
        if($this->model == null){
            $itemId = $this->controller->getParam('id', 0);
            $this->model = $this->table->fetchById($itemId);
        }
        return $this->model;
    }
}