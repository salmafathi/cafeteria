<?php

class OrderController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();

        if(!$authorization->hasIdentity() && $this->_request->getActionName() != "loginuser"&& $this->_request->getActionName() != "forgetpassword")
         {
            $this->redirect('user/loginuser');
         }  
    }

    public function indexAction()
    {
        // action body
    }


}

