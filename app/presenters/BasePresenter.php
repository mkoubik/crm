<?php

/**
 * Description of BasePresenter
 *
 * @author matej
 */
abstract class BasePresenter extends Nette\Application\Presenter
{
    /** @var Crm\Model\Provider\IModelProvider */
    private $modelProvider;
    
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
}
