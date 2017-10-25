<?php

namespace MIABase\View\Strategy;

/**
 * Description of AngularStrategyFactory
 *
 * @author matiascamiletti
 */
class AngularStrategyFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        // Creamos objeto
        //return new AngularStrategy($container->get('ViewRenderer'));
        return new AngularStrategy();
    }
}