<?php
/**
 * Description of AccountsPresenterTest
 *
 * @author matej
 */
class AccountsPresenterTest extends BaseTest
{
    /** @var AccountsPresenter */
    private $presenter;
    
    /** @var \Crm\Model\Provider\ModelProvider */
    private $provider;
    
    public function setUp()
    {
        $this->presenter = new AccountsPresenter(null, 'Accounts');
        $this->presenter->autoCanonicalize = false;
        
        $this->provider = new MockModelProvider();
        $this->presenter->setModelProvider($this->provider);
    }
    
    public function testListOfAccounts()
    {
        $table = $this->getMock('\\Nette\\Database\\Selector\\TableSelection', array('order'), array(), '', false);
        $table->expects($this->once())->method('order')->with('name')
                ->will($this->returnValue(array('test')));
        
        $model = $this->getMock('AccountsModel', array('getAll'));
        $model->expects($this->once())->method('getAll')
                ->will($this->returnValue($table));
        
        $this->presenter->getModelProvider()->setModel('accounts', $model);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'GET', array());
        $res = $this->presenter->run($req);
        
        $this->assertType('Nette\Application\RenderResponse', $res);
        $this->assertArrayHasKey('accounts', $this->provider->requiredModels);
        
        $this->assertEquals(array('test'), $res->getSource()->accounts);
    }
    
    }
}
