<?php

namespace MIABase\Helper;

/**
 * Description of CSVHelper
 *
 * @author matiascamiletti
 */
class CSVHelper 
{
    /**
     *
     * @var \Zend\Mvc\Controller\AbstractActionController
     */
    protected $controller;
    /**
     *
     * @var string
     */
    protected $filename;
    protected $delimiter = ',';
    protected $enclosure = '"';
    
    public function __construct($controller)
    {
        $this->controller = $controller;
    }
    
    public function render($filename, $rows)
    {
        // Guardamos nombre del archivo
        $this->filename = $filename;
        if (!method_exists($this->controller, 'getResponse')) {
            return false;
        }
        /** @var \Zend\Http\PhpEnvironment\Response $response */
        $response = $this->controller->getResponse();
        $fp = fopen('php://output', 'w');
        ob_start();
        //fputcsv($fp, $this->header, $this->delimiter, $this->enclosure);
        foreach ($rows as $i => $item) {
            try {
                /*$fields = $this->callback ? call_user_func($this->callback, $item) : $item;
                if (!is_array($fields)) {
                    throw new \RuntimeException('CsvExport can only accept arrays, ' . gettype($fields) . ' provided at index ' . $i . '. Either use arrays when setting the records or use a callback to convert each record into an array.');
                }*/
                fputcsv($fp, $item, $this->delimiter, $this->enclosure);
            } catch (\Exception $ex) {
                ob_end_clean();
                throw $ex;
            }
        }
        fclose($fp);
        echo ob_get_clean();
        //$response->setContent(ob_get_clean());
        /*$response->getHeaders()->addHeaders(array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename="' . str_replace('"', '\\"', $this->filename) . '"',
        ));*/
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=" . $this->filename);
        header("Pragma: no-cache");
        header("Expires: 0");
    }
    
    /**
     * Prepare the response with the CSV export and return it
     *
     * @return HttpResponse
     * @throws \Exception if any exceptions are thrown within the content callback
     */
    public function getResponse() {
        
        return $response;
    }
}
