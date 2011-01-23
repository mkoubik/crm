<?php
/**
 * Description of AccountsPresenter
 *
 * @author matej
 */
class AccountsPresenter extends BasePresenter
{
    public function renderDefault()
    {
        $this->template->accounts = $this->accountsModel->getAll()->order('name');
    }
    
    public function renderShow($id)
    {
        $account = $this->getAccountsModel()->getById($id);
        if ($account === false) {
            $this->redirect('default');
        }
        $this->template->account = $account;
    }
    
    protected function createComponentAddForm($name)
    {
        $form = new Crm\BaseForm($this, $name);
        $form->getElementPrototype()->class = 'ajax';
        $form->addText('name', 'Account name')->setRequired();
        $form->addSubmit('ok', 'Create');
        $form->onSubmit[] = callback($this, 'addFormSubmited');
    }
    
    public function addFormSubmited(\Nette\Application\AppForm $form)
    {
        $this->getAccountsModel()->add($form->values);
        $this->redirect('this');
    }
}
