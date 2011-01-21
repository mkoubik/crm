<?php
namespace Crm;

/**
 * Description of BaseForm
 *
 * @author matej
 */
class BaseForm extends \Nette\Application\AppForm
{
    public function __construct(Nette\IComponentContainer $parent = NULL, $name = NULL)
    {
        parent::__construct();
        $this->addProtection();
    }
}
