<?php
/**
 * Description of PersonFormTest
 *
 * @author matej
 */
class PersonFormTest extends BaseTest
{
    /** @var \Crm\PersonForm */
    private $form;
    
    public function setUp()
    {
        $this->form = new \Crm\PersonForm();
    }
    
    public function testControls()
    {
        $this->assertType('\\Nette\\Forms\\TextInput', $this->form['first_name']);
        $this->assertType('\\Nette\\Forms\\TextInput', $this->form['last_name']);
        $this->assertType('\\Nette\\Forms\\TextInput', $this->form['office_phone']);
        $this->assertType('\\Nette\\Forms\\TextInput', $this->form['mobile_phone']);
        $this->assertType('\\Nette\\Forms\\SubmitButton', $this->form['ok']);
    }
    
    public function testValidation()
    {
        $this->form->validate();
        $this->assertFalse($this->form->isValid());
        
        $this->form['first_name']->setValue('test');
        $this->form->validate();
        $this->assertFalse($this->form->isValid());
        
        $this->form['last_name']->setValue('test');
        $this->form->validate();
        $this->assertTrue($this->form->isValid());
    }
    
    public function testEditFormHasCancelButton()
    {
        $this->form = new \Crm\PersonForm(null, null, true);
        $this->assertType('\\Nette\\Forms\\SubmitButton', $this->form['cancel']);
    }
}
