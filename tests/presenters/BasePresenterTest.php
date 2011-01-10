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
        $presenter = new FakePresenter();
        $provider = new FakeModelProvider();
        $presenter->setModelProvider($provider);
        $this->assertEquals($provider, $presenter->getModelProvider());
    }
    
    /**
     * @expectedException \FatalErrorException
     */
    public function testModelProviderSetterOnlyAcceptsIModelProvider()
    {
        $presenter = new FakePresenter();
        $provider = 'This is not instance of IModelProvider but a string.';
        $presenter->setModelProvider($provider);
    }
    
    public function testModelProviderGetterReturnsIModelProvider()
    {
        $presenter = new FakePresenter();
        $provider = $presenter->getModelProvider();
        $this->assertTrue($provider instanceof Crm\Model\Provider\IModelProvider);
    }
}

class FakePresenter extends BasePresenter {}

class FakeModelProvider extends \Crm\Model\Provider\ModelProvider {}
