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
        // Verificar si tiene customizaciones del formulario
        if(method_exists($this->controller, 'prepareCustomForm')){
            $this->controller->prepareCustomForm($this, $this->form);
        }
        $this->model->exchangeArray($this->form->getData());
        $this->table->save($this->model);
        if(method_exists($this->controller, 'modelSaved')){
            $this->controller->modelSaved($this->model);
        }
        
        return $this->controller->redirect()->toRoute($this->route . '/list');
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
