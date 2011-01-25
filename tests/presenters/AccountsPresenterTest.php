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
        
        $model = $this->getMock('Crm\\Model\\AccountsModel', array('getAll'));
        $model->expects($this->once())->method('getAll')
                ->will($this->returnValue($table));
        
        $this->provider->setModel('accounts', $model);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'GET', array());
        $res = $this->presenter->run($req);
        
        $this->assertType('Nette\Application\RenderResponse', $res);
        $this->assertArrayHasKey('accounts', $this->provider->requiredModels);
        
        $this->assertEquals(array('test'), $this->presenter->template->accounts);
    }
    
    public function testAddForm()
    {
        $this->disableSessions();
        
        $form = $this->presenter->getComponent('addForm');
        
        $this->assertEquals('ajax', $form->getElementPrototype()->class);
        
        $form->validate();
        $this->assertFalse($form->isValid());
        
        $form['name']->setValue('test');
        $form->validate();
        $this->assertTrue($form->isValid());
        
        $onSubmit = $form->onSubmit;
        $callback = $onSubmit[0];
        $this->assertTrue(is_callable($callback));
        if ($callback instanceof Nette\Callback) {
            $callback = $callback->getNative();
        }
        $this->assertType('AccountsPresenter', $callback[0]);
        $this->assertEquals('addFormSubmited', $callback[1]);
    }
    
    public function testAddFormSubmit()
    {
        $p = new AccountsPresenter();
        $csrfToken = $p['addForm'][Nette\Forms\Form::PROTECTOR_ID]->value;
        
        $model = $this->getMock('Crm\\Model\\AccountsModel', array('add'));
        $model->expects($this->once())->method('add')->with(array('name' => 'testing account'))
            ->will($this->returnValue(123));
        $this->provider->setModel('accounts', $model);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'POST', array('do' => 'addForm-submit'),
                array(
                    'name' => 'testing account',
                    'ok' => 'Create',
                    Nette\Forms\Form::PROTECTOR_ID => $csrfToken,
                ));
        $res = $this->presenter->run($req);
        $this->assertType('\\Nette\\Application\\RedirectingResponse', $res);
    }
    
    public function testDetail()
    {
        $account = array(array('name' => 'account'));
        $accountsModel = $this->getMock('Crm\\Model\\AccountsModel', array('getById'));
        $accountsModel->expects($this->once())->method('getById')
                ->with(123)
                ->will($this->returnValue($account));
        $contacts = array(array('first_name' => 'John', 'last_name' => 'Doe', 'office_phone' => null, 'mobile_phone' => null));
        $contactsModel = $this->getMock('Crm\\Model\\ContactsModel', array('setAccountId', 'getAll'));
        $contactsModel->expects($this->once())->method('setAccountId')
                ->with(123)
                ->will($this->returnValue($contactsModel));
        $contactsModel->expects($this->once())->method('getAll')
                ->will($this->returnValue($contacts));
        
        $this->provider->setModel('accounts', $accountsModel);
        $this->provider->setModel('contacts', $contactsModel);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'GET', array(
            'action' => 'show',
            'id' => 123,
        ));
        $res = $this->presenter->run($req);
        
        $this->assertType('Nette\Application\RenderResponse', $res);
        $this->assertArrayHasKey('accounts', $this->provider->requiredModels);
        $this->assertArrayHasKey('contacts', $this->provider->requiredModels);
        
        $this->assertEquals($account, $this->presenter->template->account);
        $this->assertEquals($contacts, $this->presenter->template->contacts);
    }
    
    public function testDetailRedirectsOnNonexistingAccount()
    {
        $model = $this->getMock('Crm\\Model\\AccountsModel', array('getById'));
        $model->expects($this->once())->method('getById')
                ->with(123)
                ->will($this->returnValue(false));
        
        $this->provider->setModel('accounts', $model);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'GET', array(
            'action' => 'show',
            'id' => 123,
        ));
        $res = $this->presenter->run($req);
        
        $this->assertType('Nette\Application\RedirectingResponse', $res);
        $this->assertArrayHasKey('accounts', $this->provider->requiredModels);
    }
}
