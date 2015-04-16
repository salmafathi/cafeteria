<?php

class ProductController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
         $authorization = Zend_Auth::getInstance();
        if(!$authorization->hasIdentity() && $this->_request->getActionName() != "loginuser"&& $this->_request->getActionName() != "forgetpassword")
         {
            $this->redirect('user/loginuser');
         }  

    }

    public function indexAction() {
        // action body
    }

    public function addAction() {
        // action body
        $form = new Application_Form_Product();
       
      $catmodel = new Application_Model_Category();
        $catogeries= $catmodel->listallCat();
      foreach ($catogeries as $val){
      $form->getElement('cid')->addMultiOption($val['id'],$val['name']);
             
      }
       $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                      $ext = end(explode('.' , $form->getElement('pic')->getValue()));
                    //echo $this->baseUrl();
                    $path ='/var/www/html/blog/public/images/'.rand(0, 2000).$ext;
                    //echo $path;
                     $form->getElement('pic')->addFilter('Rename',array('target'=>$path,'overwrite'=>true));
                    
                     $form->getElement('pic')->receive();

                $data = $form->getValues();
                $this->view->data = $data;
                $productmodel = new Application_Model_Product();
                $productmodel->addproduct($data);

              // $this->view->product = $productmodel->listproduct();
               $this->redirect("product/list");
            }
        }
    }

    public function listAction() {
        $productmodel = new Application_Model_Product();

        $this->view->product = $productmodel->listproduct();
    }

    public function deleteAction() {
        $productmodel = new Application_Model_Product();
        $id = $this->getRequest()->getParam("id");

        $productmodel->deleteproduct($id);
        $this->view->product = $productmodel->deleteproduct($id);
        // $usermodel->listusers();
        $this->redirect("product/list");
        //echo $id;
    }

    public function editAction() {
         $form = new Application_Form_Product();
        $id = $this->getRequest()->getParam("id");
        $product = new Application_Model_Product();
        $catmodel = new Application_Model_Category();
        $catogeries= $catmodel->listallCat();
      foreach ($catogeries as $val){
      $form->getElement('cid')->addMultiOption($val['id'],$val['name']);
             
      }
       $product_data = $product->getProductById($id);
       
        $this->view->form = $form;
        $form->populate($product_data[0]);
        if ($this->getRequest()->isPost()) {
            $ext = end(explode('.' , $form->getElement('pic')->getValue()));
                $path ='/var/www/html/blog/public/images/'.rand(0, 2000).$ext;
                $form->getElement('pic')->addFilter('Rename',array('target'=>$path,'overwrite'=>true));
                $form->getElement('pic')->receive();
            
                $this->redirect("product/list");
            }
        
    }
    /*
    public function loginAction() {
        $form = new Application_Form_Login();
        $this->view->form = $form;
        
        $name = $this->_request->getParam('name');
        $password = $this->_request->getParam('password');
        echo $name;
        $db =Zend_Db_Table::getDefaultAdapter(); 
        $authAdapter = new Zend_Auth_Adapter_DbTable($db,'users','name','password');
        $authAdapter->setIdentity($name);
        $authAdapter->setCredential(md5($password));
        $result = $authAdapter->authenticate();
        if ($result->isValid())
        {
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name')));
        
             $this->redirect('user/listpostcomments');
        }else {
             $this->redirect('user/login');

                       
        }
    }
*/
}
