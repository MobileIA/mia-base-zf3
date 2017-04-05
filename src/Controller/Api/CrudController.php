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
}
