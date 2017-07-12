<?php

namespace MIABase\Library;

/**
 * Description of GoogleMapsFactory
 *
 * @author matiascamiletti
 */
class GoogleMapsFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        // Obtenemos configuración
        $config = $container->get('Config');
        // Creamos variable que almacenara el ApiKey
        $apiKey = '';
        // Verificamos que exista la key
        if(array_key_exists('google_maps', $config) && array_key_exists('api_key', $config['google_maps'])){
            // Iniciamos un array, ya que no se encontro una configuración
            $apiKey = $config['google_maps']['api_key'];
        }
        // Creamos objeto
        return new GoogleMaps($apiKey);
    }
}
