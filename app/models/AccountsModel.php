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
        return $this->db->table('accounts_list_view');
    }
    
    /**
     * @param int $id
     * @return \Nette\Database\Selector\TableRow|bool
     */
    public function getById($id)
    {
        return $this->db->table('accounts')->where('id = ?', $id)->fetch();
    }
    
    public function add(array $data)
    {
        $row = $this->db->table('accounts')->insert(array(
            'name' => $data['name'],
        ));
        return $row->id;
    }
}
