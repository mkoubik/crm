<?php
namespace Crm\Model\Provider;

/**
 *
 * @author matej
 */
interface IModelProvider
{
    /**
     * @param string Model name
     * @return mixed
     * @throws Crm\Model\Provider\ModelNotFoundException
     */
    public function getModel($name);
    
    /** @return Crm\Model\AccountsModel */
    public function getAccountsModel();
    
    /** @return Crm\Model\ContactsModel */
    public function getContactsModel();
}
