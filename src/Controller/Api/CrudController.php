<?php

namespace MIABase\Controller\Api;

/**
 * Description of CrudController
 *
 * @author matiascamiletti
 */
abstract class CrudController extends BaseApiController
{
    public function indexAction()
    {
        $action = new \MIABase\Action\Api\ListAction();
        $action->setTable($this->getTable());
        $action->setController($this);
        return $action->execute();
    }
    
    public function viewAction()
    {
        $action = new \MIABase\Action\Api\View();
        $action->setTable($this->getTable());
        $action->setController($this);
        return $action->execute();
    }
    
    protected function configAction($action){}
    /**
     * Metodo que se encarga de obtener los datos obtenidos antes de enviarlos a convertir a JSON.
     * @param array $data Array con los datos obtenidos
     */
    //public function configListData($data){}
    /**
     * Metodo que se llama antes de editar un registro, para agregar la verificación de permisos por ejemplo.
     * @return boolean
     */
    public function allowModelEdit($entity){ return true; }
    /**
     * Metodo que se llama una vez editado el registro para poder agregar datos extras si fueran necesarios
     * @param Object $entity
     */
    //public function configEditResponse($entity){};
    /**
     * Funcion que se ejecuta para validar los parametros enviados si fuera necesario al momento de agregar un nuevo registro
     * @param array $params
     * @return boolean
     */
    public function validatorParamsInAdd($params){ return true; }
    /**
     * Funcion que se ejecuta para validar los parametros enviados si fuera necesario al momento de editar un registro
     * @param array $params
     * @return boolean
     */
    public function validatorParamsInEdit($params){ return true; }
}
