<?php

//require_once dirname(__FILE__) . '/JustForTestingExampleOfExistingModel.php';

/**
 * Description of ModelProviderTest
 *
 * @author matej
 */
class ModelProviderTest extends BaseTest
{
    private $provider;
    
    public function setUp()
    {
        $this->provider = new \Crm\Model\Provider\ModelProvider();
    }
    
    public function testConstructClassName()
    {
        $classname = $this->provider->constructClassName('foo');
        $this->assertEquals('Crm\\Model\\FooModel', $classname);
    }
    
    public function testConstructClassNameWithCamelCase()
    {
        $classname = $this->provider->constructClassName('fooAndBar');
        $this->assertEquals('Crm\\Model\\FooAndBarModel', $classname);
    }
    
    public function testConstructClassNameWithoutNamespace()
    {
        $this->provider->setModelNamespace('');
        $classname = $this->provider->constructClassName('fooAndBar');
        $this->assertEquals('FooAndBarModel', $classname);
    }
    
    public function testModelNampespaceGetterAndSetter()
    {
        $this->provider->setModelNamespace('Testing\\Namespace');
        $ns = $this->provider->getModelNamespace();
        $this->assertEquals('Testing\\Namespace', $ns);
    }
    
    public function testDefaultModelNamespace()
    {
        $ns = $this->provider->getModelNamespace();
        $this->assertEquals('Crm\\Model', $ns);
    }
    
    public function testProvidesExistingModel()
    {
        $model = $this->provider->getModel('Accounts');
        $this->assertTrue($model instanceof Crm\Model\AccountsModel);
    }
    
    /**
     * @expectedException Crm\Model\Provider\ModelNotFoundException
     */
    public function testDoesntProvideNonExistingModel()
    {
        $this->provider->getModel('definitelyNotExisting');
    }
    
    public function testProvidesDefinedModels()
    {
        $provider = new FakeProvider();
        $provider->getAccountsModel();
        $this->assertArrayHasKey('accounts', $provider->requiredModels);
    }
}

class JustForThisTesExampleOfExistingModel {}

class FakeProvider extends \Crm\Model\Provider\ModelProvider
{
    public $requiredModels = array();
    
    public function getModel($name)
    {
        $this->requiredModels[$name] = true;
    }
}