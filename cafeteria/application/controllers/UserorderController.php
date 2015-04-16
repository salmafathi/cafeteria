<?php

class UserorderController extends Zend_Controller_Action
{
   //  var $sumoforders = 2 ;
    public function init()
    {
        /* Initialize action controller here */
              //  $sumoforders = 0;

        
    }

    public function indexAction()
    {
        // action body
    }

    public function listproductsAction()
    {
        // action body
        //list all products 
        $model = new Application_Model_Userorder();
        
        
        //when make an order 
      //  $id = $this->getRequest()->getParam("id");
      //  $productdata = $model->getPriceById($id);
        
        //send values to view 
        $this->view->allproducts = $model->listallProducts();
 //$this->view->param = $this->_getParam('param')
        
     //   $this->view->abc = $this->getRequest('a') ;
       // var_dump($this->getRequest()->getParam('a')) ;
    
        
        
  
    }
    
    
   public function addorderAction() {
       
       
       $myrequest = file_get_contents("php://input");
       $ord = json_decode($myrequest, true);
       
      $model = new Application_Model_Order();              
      $model->addorder($ord['orderss']);
       
       //echo '<pre>';
       //
      // var_dump($ord['orderss']);
       //echo '</pre>';
       exit();
   
       
       
      // $request = $this->getRequest();
       // $names = $request->getPost();
        //echo $names;
        
    }
    
    public function addorderdetailAction() {
        
       $myrequest = file_get_contents("php://input");
       $ord = json_decode($myrequest,true);
      
      // var_dump($ord);
      $model = new Application_Model_orderdetails();              
      $model->addorderdetails($ord['order_detail']);
     
      $a= $model->getorderid();
      //var_dump($a);
      $arr = array('a'=>$a);
      //var_dump($id);
      //var_dump($arr);
      
    //   $this->render('listproducts') = $a ;
     var_dump($this->dispatch("listproductsAction",$arr));
      exit();
        
    }
    


}



