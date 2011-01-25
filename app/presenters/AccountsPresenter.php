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
        $this->template->contacts = $this->getContactsModel()->setAccountId((int) $id)->getAll();
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
    
    protected function createComponentAddContactForm($name)
    {
        $form = new \Crm\PersonForm($this, $name);
        $form->getElementPrototype()->class = 'ajax';
        $form->onSubmit[] = callback($this, 'addContactFormSubmited');
    }
    
    public function addContactFormSubmited(\Crm\PersonForm $form)
    {
        $this->getContactsModel()->setAccountId((int) $this->getParam('id'));
        $this->getContactsModel()->add($form->values);
        $this->invalidateControl('contacts');
        if (!$this->isAjax()) {
            $this->redirect('this');
        }
    }
}
