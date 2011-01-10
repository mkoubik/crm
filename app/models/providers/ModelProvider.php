<?php
namespace Crm\Model\Provider;

/**
 * Description of ModelProvider
 *
 * @author matej
 */
class ModelProvider extends \Nette\Object implements IModelProvider
{
    private $namespace = 'Crm\\Model';
    
    /**
     * @param string Model name
     * @return mixed
     * @throws Crm\Model\Provider\ModelNotFoundException
     */
    public function getModel($name)
    {
        $classname = $this->constructClassName($name);
        if (!\class_exists($classname)) {
            throw new ModelNotFoundException("Class '$classname' not found.");
        }
        return new $classname;
    }
    
    /** @return Crm\Model\AccountsModel */
    public function getAccountsModel()
    {
        return $this->getModel('accounts');
    }
    
    /**
     * @param string Model name
     * @return string Class name with namespace
     */
    public function constructClassName($name)
    {
        $class = \ucfirst($name) . 'Model';
        if (empty ($this->namespace)) {
            return $class;
        }
        return "$this->namespace\\$class";
    }
    
    /** @return string */
    public function getModelNamespace()
    {
        return $this->namespace;
    }
    
    /**
     * @param string $namespace
     * @return ModelProvider
     */
    public function setModelNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }
}
