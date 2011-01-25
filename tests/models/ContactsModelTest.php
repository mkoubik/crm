<?php
/**
 * Description of ContactsModelTest
 *
 * @author matej
 */
class ContactsModelTest extends BaseTest
{
    /** @var \Crm\Model\ContactsModel */
    private $model;
    
    public function setUp()
    {
        $this->model = new \Crm\Model\ContactsModel();
    }
    
    public function testAccountIdProperty()
    {
        $this->model->setAccountId(123);
        $this->assertEquals(123, $this->model->getAccountId());
        
        // test fluent interface
        $model = $this->model->setAccountId(456);
        $this->assertType('\Crm\Model\ContactsModel', $model);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAccountIdAcceptsOnlyInteger()
    {
        $this->model->setAccountId(array());
    }
    

    public function testGetAllReturnsTableSelection()
    {
        $this->model->setAccountId(123);
        $all = $this->model->getAll();
        $this->assertTrue($all instanceof \Nette\Database\Selector\TableSelection);
    }
    
    public function testGetAllSql()
    {
        $this->model->setAccountId(123);
        $all = $this->model->getAll();
        $this->assertEquals('SELECT * FROM `accounts_contacts_view` WHERE (`account_id` = ?)', $all->getSql());
    }
    
    /**
     * @expectedException \LogicException
     */
    public function testGetAllRequiresAccountIdSet()
    {
        // no $this->model->setAccountId(123);
        $this->model->getAll();
    }
}
