<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
      $authorization = Zend_Auth::getInstance();

      if (!$authorization->hasIdentity() && $this->_request->getActionName() != "loginuser" && $this->_request->getActionName() != "forgetpass") {
            $this->redirect('user/loginuser');
        } else if ($authorization->hasIdentity() && $this->_request->getActionName() == "loginuser") {
            $this->redirect('user/list');
        }
    }

    public function indexAction()
    {
        // action body
    }
    public function userAction(){
        $auth = Zend_Auth::getInstance();
         $id=$auth->getIdentity()->id;
        if($id!=1)
        {
          $this->redirect('userorder/listproducts');

        }
 else {
        
         $form = new Application_Form_User();
        $this->view->form = $form;
         // submit button
        if($this->getRequest()->isPost()){
           
        if($form->isValid($this->getRequest()->getParams())){
//            $res = $form->getElement('password')->getValue();
//            echo $res;
//            $conf = $form->getElement('confirm_password')->getValue();
//            echo $conf;
            
            if($form->getElement('password')->getValue()!= $form->getElement('confirm_password')->getValue())
                {
                    echo "password and confirm password not matched";
                }
            else{
                
                  
                    //unset($data['confirm_password']);
                    $form->removeElement("confirm_password");
                    $ext = end(explode('.' , $form->getElement('picture')->getValue()));
                    //echo $this->baseUrl();
                    $path ='/var/www/html/blog/public/images/'.rand(0, 2000).$ext;
                    //echo $path;
                     $form->getElement('picture')->addFilter('Rename',array('target'=>$path,'overwrite'=>true));
                    
                     $form->getElement('picture')->receive();
                    //$form->addElement($img);
                    $data = $form->getValues();
                    //var_dump($data);
                     $user_model = new Application_Model_User();
                     
                     if($user_model->adduser($data))
                    {
                         $this->redirect("user/list");
                    }
                    
                    
                  
                 }
            }
        
        }
        }
    } public function forgetpassAction(){
                $form = new Application_Form_Login();
                $form->removeElement('password');
                $this->view->form = $form;
                $My_model = new Application_Model_User();

                                        
                if($this->getRequest()->isPost()){
                    if($form->isValid($this->getRequest()->getParams()))
                    {
                        $email= $this->_request->getParam('email'); 

                        //configration
                        $config = array('ssl' => 'tls', 'port' => 587, 'auth' => 'login', 'user' => 'halimahanafy@gmail.com', 'password' => '1234');
                        $smtpConnection = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
                        
                        //random password;
                        $newPassword = substr((mt_rand()), 0, 15);
                        echo $newPassword;                 
                        
                                
                        //mail 
                        $mail = new Zend_Mail();
                        $mail->addTo($email, 'Some Recipient');
                        $mail->setBodyText('This is your new password for cafeteria site: '+$newPassword+'');
                        $mail->setFrom('haliamhanafy@gmail.com', 'Some Sender');
                        $mail->setSubject('Cafeteria Password Recover');
                        $mail->send($smtpConnection);
                        
                        
                        //change in database 
                        $this->view->users = $My_model->Updatepass($email, $newPassword);
                        echo 'the email sent with new password';
                        $this->redirect('user/loginuser');

                           
                        }else {
                            $this->redirect('user/forgetpass'); 
                            



                   }
            
            
        }
                

        }

    
        public function logoutuserAction(){
            
            $auth=  Zend_Auth::getInstance();
            $auth->clearIdentity();
            $this->redirect('user/loginuser');
        }
     
    public function loginuserAction(){
        
        
        $form = new Application_Form_Login();
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getParams()))
            {
                 $email= $this->_request->getParam('email');
                 $id= $this->_request->getParam('id');
                $password = $this->_request->getParam('password');
                $db =Zend_Db_Table::getDefaultAdapter(); 
        
        $authAdapter = new Zend_Auth_Adapter_DbTable($db,'users','email','password');
        
        $authAdapter->setIdentity($email);
        $authAdapter->setCredential($password);
        
         $result = $authAdapter->authenticate();
         
         
        if($result->isValid())
        {
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name', 'picture', 'ext')));
        
            $this->redirect('user/user');
            
        }else {
             $this->redirect('user/loginuser');
        
        }
                
    }
  }
       
       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
    public function listAction(){
        
        $test_model = new Application_Model_User();
        $this->view->users = $test_model->listUser();
        
    }
    
    public function addAction(){
//         $user_model = new Application_Model_User();
//        $this->view->users = $user_model->addUser($data);
//        
        
    }
    public function deleteAction(){
        $id = $this->getRequest()->getParam("id");
        $test_model = new Application_Model_User();
        $this->view->users = $test_model->deleteUser($id);
        $this->redirect("user/list");
        
    }
    
    
    public function editAction(){
        //get id from url
        $id= $this->getRequest()->getParam("id");
        $user=new Application_Model_User(); 
        $user_data=$user->getUserById($id); 
        
        $form= new Application_Form_User(); 
        
        $this->view->form = $form; 
        $form->removeElement("confirm_password");
        //populate btb3t l data ll form 
        $form->populate($user_data[0]);
        $form->password->setRequired(false);
        //submit button
        if ($this->getRequest()->isPost()) { 
            $password = $user_data[0]['password'];
            if ($form->isValid($this->getRequest()->getParams())) { 
                
                
                $ext = end(explode('.' , $form->getElement('picture')->getValue()));
                $path ='/var/www/html/blog/public/images/'.rand(0, 2000).$ext;
                $form->getElement('picture')->addFilter('Rename',array('target'=>$path,'overwrite'=>true));
                $form->getElement('picture')->receive();
               //$data = $form->getValues();
                //$user_model = new Application_Model_User();
                //$user_model->addUser($data);
                //$this->redirect("user/list");
          
                //get new values (userdata)
                $userdata=$form->getValues();
                    if(empty($userdata['password'])) { 
                        $userdata['password'] = $password;
                        //unset($userdata['password']); 
                         //$this->redirect("user/list");
                 } 
                $userdata['password']= $userdata['password']; 
                 $user->editUser($id, $userdata); 
                 $this->redirect("user/list"); }
            
              
            
          } 
                  $this->render('user');

                 
        }


}

