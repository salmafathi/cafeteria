<?php

class ChecksController extends Zend_Controller_Action
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
    /*
    public function checksAction(){
        $checks_model = new Application_Model_Checks();
        $start_date = '2015-10-01 00:00:00';
        $end_date = '2015-10-05 00:00:00';
        $this->view->checks = $checks_model->selectUsers($start_date, $end_date);
        $this->render("checks");
    }
    
    public function checksformAction(){
        $form = new Application_Form_Checks();
        $this->view->form = $form;
        $this->render("checksform");
    }
    */
     public function checksformAction(){
       //   if($check=file_get_contents("php://input")){ 
         
                $check = json_decode($check);
                $ordermodel=new Application_Model_Order();
                $selectresult=$ordermodel->checkorder($check->startdate, $check->enddate);
                echo($res = json_encode($selectresult));
              
                exit();
 
            
       //  }  
   
            
    }
        public function checksuserformAction(){
          if($check=file_get_contents("php://input")){ 
         
                $check = json_decode($check);
                $ordermodel=new Application_Model_Order();
                $selectresult=$ordermodel->checkordersel($check->startdate, $check->enddate,$check->usercheckid);
                echo($res = json_encode($selectresult));
              
                exit();
 
            
         }  
   
            
    }
     public function checksdatesAction(){
          if($check=file_get_contents("php://input")){ 
                $check = json_decode($check);
                $ordermodel=new Application_Model_Order();
                $selectresult=$ordermodel->checkdates($check->startdate, $check->enddate,$check->usercheckid);
                echo($secres = json_encode($selectresult));
              
                exit();
 
            
         }  
   
            
    }
    public function checksproductAction(){
          if($check=file_get_contents("php://input")){ 
                $check = json_decode($check);
                $productmodel=new Application_Model_Product();
                $selectresult=$productmodel->checkproducts($check->ordercheckid);
                echo($thirdres = json_encode($selectresult));
              
                exit();
 
            
         } 
         
   
            
    }

    

    public function checksAction()
    {
        $user = new Application_Model_User();
        $this->view->users = $user->listUser();
             
        
       
    }
    

}

