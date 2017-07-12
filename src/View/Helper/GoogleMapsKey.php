<?php

namespace MIABase\View\Helper;
/**
 * Description of GoogleMaps
 *
 * @author matiascamiletti
 */
class GoogleMapsKey extends \Zend\View\Helper\AbstractHelper
{
    /**
     *
     * @var string APP_KEY
     */
    protected $apiKey = '';
    
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    public function __invoke()
    {
        return $this->apiKey;
    }
}