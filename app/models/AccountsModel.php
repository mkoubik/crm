<?php
namespace Crm\Model;

/**
 * Description of AccountsModel
 *
 * @author matej
 */
class AccountsModel extends BaseModel
{
    /** @return \Nette\Database\Selector\TableSelection */
    public function getAll()
    {
        return $this->db->table('accounts');
    }
}
