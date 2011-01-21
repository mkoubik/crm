<?php
/**
 * Description of DummySession
 *
 * @author matej
 */
class DummySession extends Nette\Web\Session
{
    public function start(){}
    
    public function isStarted()
    {
        return true;
    }
    
    public function close(){}
    
    public function destroy(){}
    
    public function exists()
    {
        return false;
    }
    
    public function regenerateId(){}
}
