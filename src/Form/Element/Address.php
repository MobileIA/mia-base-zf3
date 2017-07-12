<?php

namespace MIABase\Form\Element;

/**
 * Description of Address
 *
 * @author matiascamiletti
 */
class Address extends \Zend\Form\Element
{
    /**
     * @param  null|int|string  $name    Optional name for the element
     * @param  array            $options Optional options for the element
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('id', $name);
        //$this->setAttribute('onfocus', 'geolocate()');
    }
}