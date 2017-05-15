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
        return array(
            'id' => $this->id,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        );
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
        $this->createdAt = (!empty($data['created_at'])) ? $data['created_at'] : $date->format('Y-m-d H:i:s');
        $this->updatedAt = (!empty($data['updated_at'])) ? $data['updated_at'] : $date->format('Y-m-d H:i:s');
    }
    
    public function exchangeObject($data)
    {
        $this->id = $data->id;
        if($data->createdAt){
            $this->createdAt = $data->createdAt;
        }
        if($data->updatedAt){
            $this->updatedAt = $data->updatedAt;
        }
    }
    
    public function refreshUpdate()
    {
        $date = new \DateTime();
        $this->updatedAt = $date->format('Y-m-d H:i:s');
    }
}
