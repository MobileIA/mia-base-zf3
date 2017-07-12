<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MIABase\Form\Element;

/**
 * Description of GoogleMapsFieldset
 *
 * @author matiascamiletti
 */
class GoogleMapsFieldset extends \Zend\Form\Fieldset
{
    /**
     * @param  null|int|string  $name    Optional name for the element
     * @param  array            $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        
        $this->add([
            'name' => 'address',
            'type' => Address::class,
            'options' => [
                'label' => 'Dirección'
            ],
            'attributes' => [
                'id' => 'address',
                'placeholder' => 'Escribe una dirección'
            ]
        ]);
        $this->add(['name' => 'latitude','type' => 'hidden','attributes' => ['id' => 'latitude']]);
        $this->add(['name' => 'longitude','type' => 'hidden','attributes' => ['id' => 'longitude']]);
        $this->add(['name' => 'street_number','type' => 'hidden','attributes' => ['id' => 'street_number']]);
        $this->add(['name' => 'route','type' => 'hidden','attributes' => ['id' => 'route']]);
        $this->add(['name' => 'locality','type' => 'hidden','attributes' => ['id' => 'locality']]);
        $this->add(['name' => 'state','type' => 'hidden','attributes' => ['id' => 'state']]);
        $this->add(['name' => 'country','type' => 'hidden','attributes' => ['id' => 'country']]);
    }
}