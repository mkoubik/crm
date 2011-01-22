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
}
