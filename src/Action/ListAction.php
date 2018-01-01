<?php

namespace MIABase\Action;

use Zend\Paginator\Adapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

/**
 * Description of List
 *
 * @author matiascamiletti
 */
class ListAction extends Base
{
    /** 
     * Almacena Predicate para las consultas SQL
     * @var array 
     */
    protected $wheres = array();
    
    protected $joins = array();
    /**
     * Almacena para ordenar la Query
     * @var string|array
     */
    protected $order = null;
    /**
     * Limite para la consulta SQL
     * @var int
     */
    protected $limit = -1;
    
    protected function createPaginator()
    {
        $adapter = new Adapter\DbSelect($this->createSelect(), $this->table->getAdapter());
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($this->controller->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(20);
        return $paginator;
    }
    
    protected function createSelect()
    {
        $select = $this->table->select();
        // Validar los joins si existen
        foreach($this->joins as $join){
            $select->join($join['name'], $join['on'], $join['columns']);
        }
        // Agregar wheres personalizados
        foreach($this->wheres as $predicate){
            $select->where->addPredicate($predicate);
        }
        // Configurar el orden
        if($this->order !== null){
            $select->order($this->order);
        }
        //Search
        $this->executeSearch($select);
        // Procesar si existen filtros
        $this->executeFilters($select);
        // Verificar si los registros se eliminan por columna
        if($this->table->hasDeleted()){
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression($this->table->getTableName() . '.deleted = 0'));
        }
        // Verificamos si hay una configuración del controlador para el select
        if(method_exists($this->controller, 'configSelect')){
            // Configuramos select para customizaciones
            return $this->controller->configSelect($select);
        }else{
            return $select;
        }
    }
    
    /**
     * Funcion que se encarga de procesar si existen filtros
     * @param \Zend\Db\Sql\Select $select
     */
    protected function executeFilters(\Zend\Db\Sql\Select $select)
    {
        // Obtenemos todos los parametros enviados
        $params = $this->controller->params()->fromQuery();
        // Recorremos los parametros
        foreach($params as $param => $value){
            // Verificar si es para un filtro
            if(stripos($param, '_filter') === false){
                continue;
            }
            // Verificar si el value es correcto
            if($value == ''||$value == '-1'||$value == '0'){
                continue;
            }
            // Convertirmos el parametro en la columna
            $column = str_replace('_filter', '', $param);
            // Agregamos busqueda en la query
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression($column . ' = ?', $value));
            // Almacenamos el valor para que se pueda obtener en la vista
            $this->addOption($param, $value);
        }
    }
    
    protected function executeSearch(\Zend\Db\Sql\Select $select)
    {
        $query = $this->controller->params()->fromQuery('q');
        
        if($query == ''){
            return false;
        }
        
        $sql = '';
        $first = true;
        foreach($this->getOption('columns', array()) as $column){
            if(array_key_exists('is_search', $column) && $column['is_search'] === true){
                if($first){
                    $first = false;
                }else{
                    $sql .= ' OR ';
                }
                $sql .= $column['field'] . ' LIKE "%'.$query.'%"';
            }
        }
        
        $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression($sql));
    }
    
    protected function fetchAll()
    {
        return $this->table->fetchAll();
    }

    public function execute()
    {
        return new ViewModel(array(
            'service' => $this,
            'paginator' => $this->createPaginator(),
            'items' => $this->fetchAll()
        ));
    }
    
    public function addWhere($predicate)
    {
        $this->wheres[] = $predicate;
    }
    
    public function addJoin($name, $on, $columns)
    {
        $this->joins[] = array(
            'name' => $name,
            'on' => $on,
            'columns' => $columns
        );
    }
    /**
     * Configura el orden del SQL
     * @param string|array $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }
    /**
     * Configura el limite del SQL
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
}