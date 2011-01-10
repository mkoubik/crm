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
}
