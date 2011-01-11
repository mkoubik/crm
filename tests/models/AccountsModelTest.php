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
}
