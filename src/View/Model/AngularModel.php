<?php

namespace MIABase\View\Model;

/**
 * Description of AngularModel
 *
 * @author matiascamiletti
 */
class AngularModel extends \Zend\View\Model\ViewModel
{
    /**
     * Almacena el path del archivo de angular
     * @var string
     */
    protected $filePath = '';
    /**
     * JSON probably won't need to be captured into a
     * a parent container by default.
     *
     * @var string
     */
    protected $captureTo = null;
    /**
     * JSON is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;
    
    /**
     * Constructor
     * @param string $path Ruta del archivo de angular
     */
    public function __construct($path)
    {
        // Llamar al constructor padre
        parent::__construct();
        // Almacenar el path
        $this->filePath = $path;
    }
    /**
     * Serialize to String
     *
     * @return string
     */
    public function serialize()
    {
        // Devolver HTML del archivo
        return file_get_contents($this->filePath);
    }
    
}