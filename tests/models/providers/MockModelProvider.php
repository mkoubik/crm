<?php

require_once dirname(__FILE__) . '/../MockModel.php';

/**
 * Description of MockModelProvider
 *
 * @author matej
 */
class MockModelProvider extends \Crm\Model\Provider\ModelProvider
{
    public $requiredModels = array();
    
    private $models = array();
    
    public function setModel($name, $model)
    {
        $this->models[$name] = $model;
        return $this;
    }
    
    public function getModel($name)
    {
        if (!isset($this->requiredModels[$name])) {
            $this->requiredModels[$name] = 0;
        }
        $this->requiredModels[$name]++;
        return $this->models[$name];
    }
}
