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
        //Search
        $this->executeSearch($select);
        
        return $select;
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