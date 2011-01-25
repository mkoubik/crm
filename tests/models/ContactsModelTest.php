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
        $this->model->getDb()->exec('TRUNCATE accounts_contacts');
        $this->model->getDb()->exec('TRUNCATE people');
    }
    
    public function  tearDown()
    {
        $this->model->getDb()->exec('TRUNCATE accounts_contacts');
        $this->model->getDb()->exec('TRUNCATE people');
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
    
    public function testAdd()
    {
        $this->prepareDb();
        $this->model->setAccountId(1);
        
        $contact = array(
            'first_name' => 'John',
            'last_name' => 'Doe',
        );
        $id = $this->model->add($contact);
        $result = $this->model->db->fetch('SELECT * FROM people WHERE id = ?', $id);
        $this->assertEquals($contact['first_name'], $result->first_name);
        $this->assertEquals($contact['last_name'], $result->last_name);
        
        $result = $this->model->db->fetch('SELECT COUNT(id) AS count FROM accounts_contacts WHERE account_id = 1 AND person_id = ?', $id);
        $this->assertEquals(1, $result->count);
    }
    
    /**
     * @expectedException \LogicException
     */
    public function testAddRequiresAccountIdSet()
    {
        // no $this->model->setAccountId(123);
        $this->model->Add(array(
        ));
    }
}
