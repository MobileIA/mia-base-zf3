<?php

namespace MIABase\Action\Api;

/**
 * Description of Base
 *
 * @author matiascamiletti
 */
abstract class Base extends \MIABase\Action\Base
{
    /**
     * Genera un modelo JSON como respuesta correcta
     * @param mixed $data
     * @return \Zend\View\Model\JsonModel
     */
    public function executeSuccess($data)
    {
        return new \Zend\View\Model\JsonModel(array(
            'success' => true, 
            'response' => $data
        ));
    }
    /**
     * Genera un modelo JSON como respuesta incorrecta
     * @param mixed $data
     * @return \Zend\View\Model\JsonModel
     */
    public function executeError($data)
    {
        return new \Zend\View\Model\JsonModel(array(
            'success' => false, 
            'response' => $data
        ));
    }
}