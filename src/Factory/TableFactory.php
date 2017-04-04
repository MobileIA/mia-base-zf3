<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MIABase\Factory;

/**
 * Description of TableFactory
 *
 * @author matiascamiletti
 */
class TableFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, mixed $options = null)
    {
        return new $requestedName($container->get('Zend\Db\Adapter\Adapter'));
    }
}