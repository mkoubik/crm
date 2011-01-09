<?php
/**
 * Description of BaseModelTest
 *
 * @author matej
 */
class BaseModelTest extends BaseTest
{
    
    public function testModelProvidesDbConnection()
    {
        $model = new FakeModel();
        $this->assertTrue($model->getConnection() instanceof \Nette\Database\Connection);
    }
}

class FakeModel extends Crm\Model\BaseModel
{
    public function getConnection()
    {
        return $this->db;
    }
}
