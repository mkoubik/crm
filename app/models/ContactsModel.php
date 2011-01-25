<?php

namespace Crm\Model;

/**
 * Description of ContactsModel
 *
 * @author matej
 */
class ContactsModel extends BaseModel
{
    private $account_id;
    
    /**
     * @param int $account_id
     * @return ContactsModel 
     */
    public function setAccountId($account_id)
    {
        if (!\is_int($account_id)) {
            throw new \InvalidArgumentException('$account_id must be an integer.');
        }
        $this->account_id = $account_id;
        return $this;
    }
    
    /** @return int */
    public function getAccountId()
    {
        return $this->account_id;
    }
    
    /** @return \Nette\Database\Selector\TableSelection */
    public function getAll()
    {
        if ($this->account_id === null) {
            throw new \LogicException('Set accountId first.');
        }
        return $this->db->table('accounts_contacts_view')->where('account_id', $this->account_id);
    }
}
