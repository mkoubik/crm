<?php

require_once dirname(__FILE__) . '/../DummySession.php';

/**
 * Description of BaseFormTest
 *
 * @author matej
 */
class BaseFormTest extends BaseTest
{
    /** @var Crm\BaseForm */
    private $form;
    
    public function  setUp()
    {
        \Nette\Environment::getContext()->removeService('Nette\\Web\\Session');
        \Nette\Environment::getContext()->addService('Nette\\Web\\Session', new DummySession());
        $this->form = new Crm\BaseForm();
    }
    
    public function testHasCSRFProtection()
    {
        $protector = $this->form[Nette\Forms\Form::PROTECTOR_ID];
        $this->assertType('Nette\\Forms\\HiddenField', $protector);
    }
    
    public function testDelegatesParentAndName()
    {
        $parent = new FakeControl();
        $form = new Crm\BaseForm($parent, 'testForm');
        $this->assertTrue($form->getParent() === $parent);
        $this->assertEquals('testForm', $form->getName());
    }
}

class FakeControl extends Nette\Application\Control {}
