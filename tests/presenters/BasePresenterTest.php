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
        $presenter->setModelProvider(new MockModelProvider());
        $model = $presenter->getTestModel();
        $this->assertTrue($model instanceof MockModel);
        $this->assertEquals('fooBar', $model->name);
    }
    
    public function testGetModelCachesModels()
    {
        $presenter = new TestPresenter();
        $presenter->setModelProvider(new MockModelProvider());
        $model1 = $presenter->getTestModel();
        $model2 = $presenter->getTestModel();
        $this->assertTrue($model1 === $model2);
    }
    
    public function testModelProperties()
    {
        $presenter = new TestPresenter();
        $presenter->setModelProvider(new MockModelProvider());
        $model = $presenter->getAccountsModelByProperty();
        $this->assertTrue($model instanceof MockModel);
        $this->assertEquals('accounts', $model->name);
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
