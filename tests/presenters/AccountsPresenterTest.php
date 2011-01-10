<?php
/**
 * Description of AccountsPresenterTest
 *
 * @author matej
 */
class AccountsPresenterTest extends BaseTest
{
    public function testListOfAccounts()
    {
        $presenter = new AccountsPresenter(null, 'Accounts');
        $presenter->autoCanonicalize = false;
        
        $provider = new MockModelProvider();
        $presenter->setModelProvider($provider);
        
        $req = new \Nette\Application\PresenterRequest('Accounts', 'GET', array());
        $res = $presenter->run($req);
        
        $this->assertType('Nette\Application\RenderResponse', $res);
        $this->assertArrayHasKey('accounts', $provider->requiredModels);
        $model = $provider->requiredModels['accounts'];
        $this->assertEquals('getAll', $model->calledMethods[0]['name']);
        $this->assertEquals('order', $model->calledMethods[1]['name']);
        $this->assertEquals('name', $model->calledMethods[1]['arguments'][0]);
        
        // MockModel has returned itself to presenter, check if pressenter has passed it to the template
        $this->assertType('MockModel', $res->getSource()->accounts);
    }
}
