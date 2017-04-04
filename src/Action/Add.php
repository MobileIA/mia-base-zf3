<?php

namespace MIABase\Action;

use Zend\View\Model\ViewModel;

/**
 * Description of Add
 *
 * @author matiascamiletti
 */
class Add extends Base
{
    /**
     *
     * @var \MIABase\Entity\Base
     */
    protected $model;
    
    protected function prepareForm()
    {
        $this->form->get('submit')->setValue('Agregar');
        return $this->form;
    }
    
    protected function prepareRequest()
    {
        $request = $this->controller->getRequest();

        if (! $request->isPost()) {
            return false;
        }
        
        $this->isValid();
    }
    
    protected function isValid()
    {
        $this->form->setInputFilter($this->getModel()->getInputFilter());
        $this->form->setData($this->controller->getRequest()->getPost());

        if (! $this->form->isValid()) {
            return false;
        }

        $this->save();
    }
    
    protected function save()
    {
        $this->model->exchangeArray($this->form->getData());
        $this->table->save($this->model);
        
        return $this->controller->redirect()->toRoute($this->route . '/list');
    }
    
    protected function getModel()
    {
        if($this->model == null){
            $className = $this->table->getEntityClass();
            $this->model = new $className;
        }
        return $this->model;
    }
    
    public function execute()
    {
        // Preparar el formulario con los ajustes minimos
        $this->prepareForm();
        // Verificar si se envio un request POST y procesar
        $this->prepareRequest();
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }

}
