<?php

namespace MIABase\View\Helper;

/**
 * Description of MiaDate
 *
 * @author matiascamiletti
 */
class MiaDate extends \Zend\View\Helper\AbstractHelper
{
    public function __invoke($date, $formatOut, $formatIn = 'Y-m-d H:i:s')
    {
        // Creamos objeto de fecha
        $datetime = new \DateTime($date);
        // Devolvemos formato de fecha
        return $datetime->format($formatOut);
    }
}