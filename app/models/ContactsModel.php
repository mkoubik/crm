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
    
    /** @throws \LogicException */
    private function checkAccountId()
    {
        if ($this->account_id === null) {
            throw new \LogicException('Set accountId first.');
        }
    }
    
    /** @return \Nette\Database\Selector\TableSelection */
    public function getAll()
    {
        $this->checkAccountId();
        return $this->db->table('accounts_contacts_view')->where('account_id', $this->account_id);
    }
    
    /**
     * @param array $data (first_name, last_name, office_phone, mobile_phone)
     * @return int person id
     */
    public function add(array $data)
    {
        $this->checkAccountId();
        $this->db->beginTransaction();
        try {
            $row = $this->db->table('people')->insert($data);
            $this->db->table('accounts_contacts')->insert(array(
                'account_id' => $this->account_id,
                'person_id' => $row->id,
            ));
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
        return $row->id;
    }
}
