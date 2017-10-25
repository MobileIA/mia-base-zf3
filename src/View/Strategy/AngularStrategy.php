<?php

namespace MIABase\View\Strategy;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\ViewEvent;
use MIABase\View\Model\AngularModel;
use MIABase\View\Renderer\AngularRenderer;

/**
 * Description of AngularStrategy
 *
 * @author matiascamiletti
 */
class AngularStrategy implements ListenerAggregateInterface
{
    protected $listeners = array();
     
    public function attach(EventManagerInterface $events, $priority = 1)
    {                               
       $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
       $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }
     
    public function selectRenderer(ViewEvent $e)
    {
        if($e->getModel() instanceof AngularModel){
            return new AngularRenderer();
        }
        return null;
    }
     
    public function injectResponse(ViewEvent $e)
    {
        // Obtener resultado
        $result   = $e->getResult();
        // Obtener response
        $response = $e->getResponse();
        // Setear el resultado
        $response->setContent($result);
    }
     
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
}