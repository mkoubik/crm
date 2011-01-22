<?php
/**
 * Description of BasePresenterTest
 *
 * @author matej
 */
class BasePresenterTest extends BaseTest
{
    public function testModelProviderGetterAndSetter()
    {
        $presenter = new TestPresenter();
        $provider = new MockModelProvider();
        $presenter->setModelProvider($provider);
        $this->assertTrue($provider === $presenter->getModelProvider());
    }
    
    /**
     * @expectedException \FatalErrorException
     */
    public function testModelProviderSetterOnlyAcceptsIModelProvider()
    {
        $presenter = new TestPresenter();
        $provider = 'This is not instance of IModelProvider but a string.';
        $presenter->setModelProvider($provider);
    }
    
    public function testModelProviderGetterReturnsIModelProvider()
    {
        $presenter = new TestPresenter();
        $provider = $presenter->getModelProvider();
        $this->assertTrue($provider instanceof Crm\Model\Provider\IModelProvider);
    }
    
    // Tests that $this->getModel('modelName'); is aviable inside presenter
    public function testGetModel()
    {
        $presenter = new TestPresenter();
        $provider = new MockModelProvider();
        $provider->setModel('fooBar', array());
        $presenter->setModelProvider($provider);
        $model = $presenter->getTestModel();
        $this->assertEquals(array(), $model);
    }
    
    public function testGetModelCachesModels()
    {
        $presenter = new TestPresenter();
        $provider = new MockModelProvider();
        $provider->setModel('fooBar', array());
        $presenter->setModelProvider($provider);
        $presenter->getTestModel();
        $presenter->getTestModel();
        $this->assertEquals(1, $provider->requiredModels['fooBar']);
    }
    
    public function testModelProperties()
    {
        $presenter = new TestPresenter();
        $provider = new MockModelProvider();
        $provider->setModel('accounts', array());
        $presenter->setModelProvider($provider);
        $model = $presenter->getAccountsModelByProperty();
        $this->assertEquals(array(), $model);
    }
}

class TestPresenter extends BasePresenter
{
    public function getTestModel()
    {
        return $this->getModel('fooBar');
    }
    
    public function getAccountsModelByProperty()
    {
        return $this->accountsModel;
    }
}
