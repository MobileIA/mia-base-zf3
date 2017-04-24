<?php

namespace MIABase\Action\Api;

/**
 * Description of ListAction
 *
 * @author matiascamiletti
 */
class ListAction extends \MIABase\Action\ListAction
{
    
    protected function createSelect()
    {
        // Creamos Select
        $select = $this->table->select();
        // Buscamos si se envio un parametro del cual se empieza a buscar
        $lastUpdatedAt = $this->controller->params()->fromPost('last_updated_at', null);
        // Si existe una fecha enviada buscamos a partir de ahi
        if($lastUpdatedAt !== null){
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('updated_at >= "'. $lastUpdatedAt.'"'));
        }
        return $select;
    }
    
    protected function fetchAll()
    {
        if(method_exists($this->controller, 'configListData')){
            return $this->controller->configListData($this->table->getTableGateway()->selectWith($this->createSelect())->toArray());
        }
        return $this->table->getTableGateway()->selectWith($this->createSelect())->toArray();
    }
    
    public function execute()
    {
        return new \Zend\View\Model\JsonModel(array(
            'success' => true, 
            'response' => $this->fetchAll()
        ));
    }

}
