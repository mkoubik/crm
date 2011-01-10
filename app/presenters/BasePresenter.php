<?php

/**
 * Description of BasePresenter
 *
 * @author matej
 * @property-read Crm\Model\AccountsModel $accountsModel
 */
abstract class BasePresenter extends Nette\Application\Presenter
{
    /** @var Crm\Model\Provider\IModelProvider */
    private $modelProvider;
    
    /** @var array */
    private $models = array();
    
    /** @return Crm\Model\Provider\IModelProvider */
    public function getModelProvider()
    {
        if ($this->modelProvider === null) {
            $this->modelProvider = $this->getApplication()->getContext()->getService('Crm\\Model\\Provider\\IModelProvider');
        }
        return $this->modelProvider;
    }
    
    /**
     * @param Crm\Model\Provider\IModelProvider $provider
     * @return BasePresenter
     */
    public function setModelProvider(Crm\Model\Provider\IModelProvider $provider)
    {
        $this->modelProvider = $provider;
        return $this;
    }
    
    public function  getModel($name)
    {
        if (!isset($this->models[$name])) {
            $this->models[$name] = $this->getModelProvider()->getModel($name);
        }
        return $this->models[$name];
    }

    /** @return Crm\Model\AccountsModel */
    public function getAccountsModel()
    {
        return $this->getModel('accounts');
    }
}
