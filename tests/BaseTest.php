<?php
/**
 * Description of BaseTest
 *
 * @author matej
 */
abstract class BaseTest extends PHPUnit_Framework_TestCase
{
    protected function disableSessions()
    {
        \Nette\Environment::getContext()->removeService('Nette\\Web\\Session');
        \Nette\Environment::getContext()->addService('Nette\\Web\\Session', new DummySession());
    }
    
    protected function prepareDb()
    {
        $model = new FakeModel();
        $db = $model->getDb();
        
        $db->exec('TRUNCATE accounts');
        $db->table('accounts')->insert(array(
            'id' => 1,
            'name' => 'account_1',
        ));
    }
}
