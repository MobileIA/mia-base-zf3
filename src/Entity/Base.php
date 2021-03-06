<?php

namespace MIABase\Entity;

/**
 * Description of Base
 *
 * @author matiascamiletti
 */
class Base
{
   /**
     *
     * @var int
     */
    public $id;
    /**
     *
     * @var int
     */
    public $createdAt;
    /**
     *
     * @var int
     */
    public $updatedAt;
    /**
     *
     * @var \Zend\InputFilter\InputFilter
     */
    protected $inputFilter;
    /**
     *
     * @var boolean
     */
    protected $hasCreatedAt = true;
    /**
     *
     * @var boolean
     */
    protected $hasUpdatedAt = true;
    
    /**
     * 
     */
    public function __construct()
    {
        $date = new \DateTime();
        $this->createdAt = $date->format('Y-m-d H:i:s');
        $this->updatedAt = $date->format('Y-m-d H:i:s');
    }
    /**
     * 
     * @return array
     */
    public function toArray()
    {
        $data = get_object_vars($this);
        // Verificar si tiene fecha de creación
        if($this->hasCreatedAt){
            $data['created_at'] = $this->createdAt;
        }
        // Verificar si tiene fecha de actualización
        if($this->hasUpdatedAt){
            $data['updated_at'] = $this->updatedAt;
        }
        // Eliminar innecesarios
        unset($data['createdAt']);
        unset($data['updatedAt']);
        unset($data['hasCreatedAt']);
        unset($data['hasUpdatedAt']);
        unset($data['inputFilter']);
        return $data;
    }
    
    public function exchange($data)
    {
        if(is_array($data)){
            $this->exchangeArray($data);
        }else{
            $this->exchangeObject($data);
        }
    }
    
    public function exchangeArray(array $data)
    {
        $date = new \DateTime();
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        // Verificar si tiene fecha de creación
        if($this->hasCreatedAt){
            $this->createdAt = (!empty($data['created_at'])) ? $data['created_at'] : $date->format('Y-m-d H:i:s');
        }
        // Verificar si tiene fecha de actualización
        if($this->hasUpdatedAt){
            $this->updatedAt = (!empty($data['updated_at'])) ? $data['updated_at'] : $date->format('Y-m-d H:i:s');
        }
        // Obtener todas las propiedades
        $properties = get_object_vars($this);
        // Recorremos las propiedades
        foreach($properties as $property => $value){
            if(!empty($data[$property])){
                $this->{$property} = $data[$property];
            }
        }
    }
    
    public function exchangeObject($data)
    {
        if(isset($data->id)){
            $this->id = $data->id;
        }
        if(isset($data->createdAt)){
            $this->createdAt = $data->createdAt;
        }
        if(isset($data->updatedAt)){
            $this->updatedAt = $data->updatedAt;
        }
        // Obtener todas las propiedades
        $properties = get_object_vars($this);
        // Recorremos las propiedades
        foreach($properties as $property => $value){
            if(isset($data->{$property})){
                $this->{$property} = $data->{$property};
            }
        }
    }
    
    public function refreshUpdate()
    {
        // Verificar si tiene fecha de actualización
        if(!$this->hasUpdatedAt){
            return false;
        }
        $date = new \DateTime();
        $this->updatedAt = $date->format('Y-m-d H:i:s');
    }
}
