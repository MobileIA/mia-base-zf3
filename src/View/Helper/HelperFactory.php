<?php

namespace MIABase\View\Helper;

/**
 * Description of HelperFactory
 *
 * @author matiascamiletti
 */
class HelperFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        // Creamos objeto
        return new $requestedName($container);
    }
}