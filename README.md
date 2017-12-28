# mia-base-zf3
The library for Zend Framework 3

# Recursos para la creación de WebServices/APIs
## Creación de controlador

1. Estructura inicial para el controlador que se encarga del ABM.
```php
namespace Api\Controller;

class RankingController extends \MIABase\Controller\Api\CrudController
{
    protected $tableName = \Application\Table\RankingTable::class;
}
```

. El archivo de la tabla debe heredar de: \MIABase\Table\Base

2. Llamando al indexAction, se obtiene un listado todos los registros de esa tabla:
```json
{
    "success":true,
    "response":[
        //...
    ]
}
```

3. Se puede personalizar la Query con la cual el Controlador obtiene los resultados a mostrar:
```php
    /**
     * Configura la query, para casos especiales
     * @param \Zend\Db\Sql\Select $select
     * @return \Zend\Db\Sql\Select
     */
    public function configSelect($select)
    {
        // Todo lo que requieras hacer...

        // Devolvemos select personalizado
        return $select;
    }
```

# Recursos para la creación de ABM para Backend/Panel de administración:
## Creación del controlador

1. Estructura inicial para el controlador que se encarga del ABM.
```php
namespace Backend\Controller;

class EventController extends \MIABase\Controller\CrudController
{
    protected $tableName = \Application\Table\EventTable::class;

    protected $formName = \Backend\Form\Event::class;

    protected $template = 'mia-layout-lte';

    protected $route = 'event';
    
    public function columns()
    {
        return array(
            array('type' => 'int', 'title' => 'ID', 'field' => 'id', 'is_search' => true),
            array('type' => 'string', 'title' => 'Nombre', 'field' => 'firstname', 'is_search' => true),
            array('type' => 'string', 'title' => 'Apellido', 'field' => 'lastname', 'is_search' => true),
            array('type' => 'string', 'title' => 'Email', 'field' => 'email', 'is_search' => true),
            array('type' => 'image', 'title' => 'Foto', 'field' => 'photo', 'is_search' => true),
            array('type' => 'string', 'title' => 'Telefono', 'field' => 'phone', 'is_search' => true),
            //array('type' => 'actions', 'title' => 'Acciones', 'more' => $this->getMoreActions())
        );
    }
}
```

. El archivo de la tabla debe heredar de: \MIABase\Table\Base
. El archivo del formulario debe heredar de: \MIABase\Form\Base

2. Se puede agregar funcionalidad extra despues de la creación de un nuevo registro, generando el siguiente metodo:
```php
    /**
     * Funcion que se llama despues de guardar un elemento
     * @param \MIABase\Entity\Base $element
     */
    public function modelSaved($element)
    {
        // La funcion que se requiera realizar
    }
```

3. Configurar la Query para obtener los datos del listado:
```php
    /**
     * Configura la query para el listado
     * @param \Zend\Db\Sql\Select $select
     * @return \Zend\Db\Sql\Select
     */
    public function configSelect($select)
    {
        // Lo que requieras realizar:
        
        // Devolvemos select personalizado
        return $select;
    }
```

# Helper para las vistas
1. "miaDate", Helper para imprimir fechas, ejemplo:
```php
    // Fecha, Formato de salida, Formato de entrada (Opcional)
    <?php echo $this->miaDate($event['start_date'], 'l d \d\e M\. - H:i'); ?>
```