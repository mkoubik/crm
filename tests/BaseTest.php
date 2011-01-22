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
}
