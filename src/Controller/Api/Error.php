<?php

namespace MIABase\Controller\Api;

/**
 * Description of Error
 *
 * @author matiascamiletti
 */
class Error 
{
    const INVALID_APP = array('code' => 410, 'message' => 'No se encontro el APP_ID.');
    const REQUIRED_PARAMS = array('code' => 411, 'message' => 'No se han enviado parametros obligatorios');
    const INVALID_CONFIGURATION = array('code' => 412, 'message' => 'La configuración no es la correcta.');
    const INVALID_ACCESS_TOKEN = array('code' => 413, 'message' => 'El accessToken enviado es incorrecto.');
    const USER_NOT_REGISTERED = array('code' => 414, 'message' => 'El usuario no se encuentra registrado.');
    const INVALID_GRANT_TYPE = array('code' => 415, 'message' => 'El grantType enviado no es valido.');
    const INVALID_REGISTER_TYPE = array('code' => 416, 'message' => 'El registerType enviado no es valido.');
    const USER_REGISTERED = array('code' => 417, 'message' => 'El usuario ya se encuentra registrado.');
    const INVALID_PASSWORD = array('code' => 418, 'message' => 'La contraseña indicada no coincide.');
}