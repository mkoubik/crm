<?php
namespace Crm\Model;

/**
 * Description of BaseModel
 *
 * @author matej
 * @property-read \Nette\Database\Connection $db
 */
abstract class BaseModel extends \Nette\Object
{
    /** @var \Nette\Database\Connection */
    private static $connection;
    
    /** @return \Nette\Database\Connection */
    public function getDb()
    {
        if (self::$connection === null) {
            $config = \Nette\Environment::getConfig('database');
            self::$connection = new \Nette\Database\Connection("$config->driver:host=$config->host;dbname=$config->dbname", $config->user, $config->password);
        }
        return self::$connection;
    }
}
