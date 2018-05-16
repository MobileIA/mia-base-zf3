<?php

namespace MIABase\View\Helper;

/**
 * Description of BaseHelper
 *
 * @author matiascamiletti
 */
class BaseHelper extends \Zend\View\Helper\AbstractHelper
{
    /**
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceManager = null;
    
    /**
     * Constructor que recibe el ServiceManager
     * @param array $serviceManager
     */
    public function __construct($serviceManager = null)
    {
        $this->serviceManager = $serviceManager;
    }
    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $container
     */
    public function setServiceManager($container)
    {
        $this->serviceManager = $container;
    }
    /**
     * 
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}