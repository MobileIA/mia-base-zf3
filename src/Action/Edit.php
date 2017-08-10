<?php

namespace MIABase\Action;

/**
 * Description of Edit
 *
 * @author matiascamiletti
 */
class Edit extends Add
{
    /**
     *
     * @var \MIABase\Entity
     */
    protected $old = null;
    
    protected function prepareForm()
    {
        $this->form->populateValues($this->getModel()->toArray());
        // Verificar si tiene customizaciones del formulario
        if(method_exists($this->controller, 'prepareCustomForm')){
            $this->controller->prepareCustomForm($this, $this->form);
        }
        $this->form->get('submit')->setValue('Guardar');
        return $this->form;
    }
    
    protected function save()
    {
        // Copiamos datos antes de editar
        $this->old->exchange($this->getModel()->toArray());
        // Cargamos nuevos datos
        $this->model->exchangeArray($this->form->getData());
        // Guardamos en la DB
        $this->table->save($this->model);
        // Verificamos si existe una funcionalidad extra al ser editado
        if(method_exists($this->controller, 'modelEdited')){
            $this->controller->modelEdited($this->old, $this->model);
        }
        
        return $this->controller->redirect()->toRoute($this->route . '/list');
    }
    
    public function getModel()
    {
        if($this->model == null){
            $itemId = $this->controller->params()->fromRoute('id');
            $this->model = $this->table->fetchById($itemId);
            // Crear objeto para almacenar los datos viejos
            $className = $this->table->getEntityClass();
            $this->old = new $className;
        }
        return $this->model;
    }
}