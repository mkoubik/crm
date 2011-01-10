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
    
    public function getModel($name)
    {
        $this->requiredModels[$name] = true;
        $model = new MockModel();
        $model->name = $name;
        return $model;
    }
}
