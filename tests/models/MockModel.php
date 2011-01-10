<?php
/**
 * Description of MockModel
 *
 * @author matej
 */
class MockModel
{
    public $calledMethods = array();
    
    public $name;
    
    public function  __call($name, $arguments)
    {
        $this->calledMethods[] = array(
            'name' => $name,
            'arguments' => $arguments,
        );
        return $this;
    }
}
