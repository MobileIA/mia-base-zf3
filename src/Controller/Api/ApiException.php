<?php

namespace MIABase\Controller\Api;

/**
 * Description of ApiException
 *
 * @author matiascamiletti
 */
class ApiException extends \Exception
{
    /**
     * 
     * @param array $data
     */
    public function __construct($data)
    {
        if(array_key_exists('message', $data)){
            $this->message = $data['message'];
        }
        if(array_key_exists('code', $data)){
            $this->code = $data['code'];
        }
    }
}