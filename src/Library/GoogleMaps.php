<?php

namespace MIABase\Library;

/**
 * Description of GoogleMaps
 *
 * @author matiascamiletti
 */
class GoogleMaps 
{
    /**
     *
     * @var string APP_KEY
     */
    public $apiKey = '';
    
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}