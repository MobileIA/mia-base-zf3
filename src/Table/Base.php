<?php

namespace MIABase\Table;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

/**
 * Description of Base
 *
 * @author matiascamiletti
 */
class Base
{
    /**
     *
     * @var Zend\Db\Adapter\AdapterInterface
     */
    protected $adapter;
    /**
     *
     * @var TableGateway
     */
    protected $tableGateway;
    /**
     * Almacena el nombre de la tabla en la DB
     * @var string
     */
    protected $tableName = '';
    /**
     * Almacena el nombre de la clase de la entidad
     * @var string
     */
    protected $entityClass = '';
    /**
     * 
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->constructGateway();
    }
    /**
     * 
     */
    protected function constructGateway()
    {
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new $this->entityClass());
        $this->tableGateway = new TableGateway($this->tableName, $this->adapter, null, $resultSetPrototype);
    }
    /**
     * 
     * @param \MIABase\Entity\Base $entity
     * @return int
     * @throws \Exception
     */
    public function save(\MIABase\Entity\Base $entity)
    {
        $id = (int) $entity->id;
        if ($id == 0) {
            $this->tableGateway->insert($entity->toArray());
            $last_id = $this->tableGateway->getLastInsertValue();
            $entity->id = $last_id;
            return $last_id;
        } else {
            $entity->refreshUpdate();
            $this->tableGateway->update($entity->toArray(), array('id' => $id));
            return $id;
        }
    }
    /**
     * 
     * @param int $id
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function fetchById($id)
    {
        $rowset = $this->tableGateway->select(array('id' => (int) $id));
        $row = $rowset->current();
        if (!$row) {
            return null;
        }
        return $row;
    }
    /**
     * Funcion que obtiene los registros a traves de los IDs seleccionados
     * @param array $ids Contiene los IDs de los registros a buscar
     * @return ResulSet
     */
    public function fetchAllByIds($ids)
    {
        return $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($ids) {
            $select->where(new \Zend\Db\Sql\Predicate\Expression('id IN ('.implode(',', $ids).')'));
        });
    }
    /**
     * 
     * @return ResultSet
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    /**
     * 
     * @param int $id
     * @return int
     */
    public function deleteById($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
    /**
     * 
     * @return Select
     */
    public function select()
    {
        $select = new Select();
        $select->from($this->tableName);
        return $select;
    }
    /**
     * 
     * @return Zend\Db\Adapter\AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
    /**
     * 
     * @return TableGateway
     */
    public function getTableGateway()
    {
        return $this->tableGateway;
    }
    /**
     * 
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }
}
