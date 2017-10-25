<?php

namespace MIABase\View\Renderer;

use Zend\View\Exception;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use MIABase\View\Model\AngularModel;

/**
 * Description of AngularRenderer
 *
 * @author matiascamiletti
 */
class AngularRenderer implements Renderer, \Zend\View\Renderer\TreeRendererInterface
{

    /**
     * @var Resolver
     */
    protected $resolver;
    
    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @todo   Determine use case for resolvers when rendering JSON
     * @param  Resolver $resolver
     * @return Renderer
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Renders file as String
     *
     * @param  string|Model $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess $values Values to use during rendering
     * @return string The HTML output.
     */
    public function render($nameOrModel, $values = null)
    {
        // Verificar si el model es de Angular
        if ($nameOrModel instanceof AngularModel) {
            return $nameOrModel->serialize();
        }
        
        return "";
    }

    /**
     * Can this renderer render trees of view models?
     *
     * Yes.
     *
     * @return true
     */
    public function canRenderTrees()
    {
        return false;
    }
}