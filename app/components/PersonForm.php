<?php

namespace Crm;

/**
 * Description of PersonForm
 *
 * @author matej
 */
class PersonForm extends BaseForm
{
    public function __construct(\Nette\IComponentContainer $parent = NULL, $name = NULL, $edit = false)
    {
        parent::__construct($parent, $name);
        $this->addText('first_name', 'First name')->setRequired();
        $this->addText('last_name', 'Last name')->setRequired();
        $this->addText('office_phone', 'Office phone');
        $this->addText('mobile_phone', 'Mobile phone');
        if ($edit) {
            $this->addSubmit('cancel', 'Cancel');
            $this->addSubmit('ok', 'Save');
        } else {
            $this->addSubmit('ok', 'Create');
        }
    }
}
