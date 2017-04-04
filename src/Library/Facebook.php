<?php

namespace MIABase\Library;

use Zend\Json\Decoder;

/**
 * Description of Facebook
 *
 * @author matiascamiletti
 */
class Facebook
{
    /**
     *
     * @var string APP ID
     */
    public $appID = '';
    /**
     *
     * @var string APP Secret
     */
    public $appSecret = '';
    
    public function __construct($appId, $appSecret)
    {
        $this->appID = $appId;
        $this->appSecret = $appSecret;
    }
    
    /**
     * Verificar si un access_token es valido de un usuario
     * @param string $access_token Access Token del usuario.
     * @param int $facebook_id ID del usuario en Facebook para verificar
     */
    public function verifyUserAccesToken($access_token, $facebook_id = 0)
    {
        $url = 'https://graph.facebook.com/me?fields=id&access_token=' . $access_token;
        $string = file_get_contents($url);
        $json = Decoder::decode($string);
        
        if($json == null || !is_object($json)){
            return false;
        }
        
        if(!isset($json->id)){
            return false;
        }
        
        if($facebook_id != 0 && intval($facebook_id) != intval($json->id)){
            return false;
        }
        
        return true;
    }
}