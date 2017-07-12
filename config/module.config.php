<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace MIABase;

return array(
    'service_manager' => [
        'factories' => [
            Library\GoogleMaps::class => Library\GoogleMapsFactory::class,
        ]
    ],
    'view_helpers' => [
        'aliases' => [
            'googleMapsKey' => View\Helper\GoogleMapsKey::class,
        ],
        'factories' => [
            View\Helper\GoogleMapsKey::class => View\Helper\GoogleMapsKeyFactory::class,
        ],
    ]
);