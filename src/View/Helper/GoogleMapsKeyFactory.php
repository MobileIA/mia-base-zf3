<?php

namespace MIABase\View\Helper;

/**
 * Description of GoogleMapsKeyFactory
 *
 * @author matiascamiletti
 */
class GoogleMapsKeyFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        // Obtenemos Servicio de Google Maps
        $googleMaps = $container->get(\MIABase\Library\GoogleMaps::class);
        // Creamos objeto
        return new GoogleMapsKey($googleMaps->apiKey);
    }
}
