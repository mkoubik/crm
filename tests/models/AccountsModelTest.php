<?php
/**
 * Description of AccountsModelTest
 *
 * @author matej
 */
class AccountsModelTest extends BaseTest
{
    private $model;

    public function setUp()
    {
        $this->model = new Crm\Model\AccountsModel();
        $this->model->getDb()->exec('TRUNCATE accounts');
    }
    
    public function tearDown()
    {
        $this->model->getDb()->exec('TRUNCATE accounts');
    }

    public function testGetAllReturnsTableSelection()
    {
        $all = $this->model->getAll();
        $this->assertTrue($all instanceof \Nette\Database\Selector\TableSelection);
    }
    
    public function testGetAllSql()
    {
        $all = $this->model->getAll();
        $this->assertEquals('SELECT * FROM `accounts_list_view`', $all->getSql());
    }
    
    public function testAdd()
    {
        $id = $this->model->add(array('name' => 'testing'));
        $row = $this->model->getDb()->fetch('SELECT * FROM accounts');
        $this->assertEquals($id, $row->id);
        $this->assertEquals('testing', $row->name);
    }
    
    public function testGetById()
    {
        $account1 = array('name' => 'testing1');
        $account2 = array('name' => 'testing2');
        $table = $this->model->getDb()->table('accounts');
        $id1 = $table->insert($account1)->id;
        $id2 = $table->insert($account2)->id;
        
        $result1 = $this->model->getById($id1);
        $result2 = $this->model->getById($id2);
        $this->assertEquals($account1['name'], $result1->name);
        $this->assertEquals($account2['name'], $result2->name);
    }
    
    public function testGetByIdReturnsFalseOnNonexistingAccount()
    {
        $result = $this->model->getById(123);
        $this->assertFalse($result);
    }
}
