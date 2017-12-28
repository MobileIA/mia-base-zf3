<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace MIABase;

use Zend\ServiceManager\Factory\InvokableFactory;

return array(
    'service_manager' => [
        'factories' => [
            Library\GoogleMaps::class => Library\GoogleMapsFactory::class,
            View\Strategy\AngularStrategy::class => View\Strategy\AngularStrategyFactory::class
        ]
    ],
    'view_helpers' => [
        'aliases' => [
            'googleMapsKey' => View\Helper\GoogleMapsKey::class,
            'miaDate' => View\Helper\MiaDate::class,
        ],
        'factories' => [
            View\Helper\GoogleMapsKey::class => View\Helper\GoogleMapsKeyFactory::class,
            View\Helper\MiaDate::class => InvokableFactory::class
        ],
    ],
    'view_manager' => array(
        'strategies' => array(
            View\Strategy\AngularStrategy::class
        ),
    ),
);