<?php

class CategoryController extends Zend_Controller_Action
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
    public function addcatAction()
    {
        // action body
        $form = new Application_Form_Category();
        $this->view->form = $form;
         if($this->getRequest()->isPost())
         {
           if($form->isValid($this->getRequest()->getParams()))
            {
                $catname = $form->getValues();
                $cat_model = new Application_Model_Category();
                if($cat_model->addCat($catname))
                    {
                        $this->redirect("category/listall");
                    }
                
            }
         }
         
    }

    public function listallAction()
    {
        // action body
        $model = new Application_Model_Category();
        $this->view->allcategories = $model->listallCat();
        
    }

    public function deletecatAction()
    {
        // action body
        $id = $this->getRequest()->getParam("id");
        $model = new Application_Model_Category();
        $model->deleteCat($id);

        $this->redirect("category/listall");
    }

    public function editcatAction()
    {
        // action body
        $id = $this->getRequest()->getParam("id");
        $model = new Application_Model_Category();
        $data = $model->getCatById($id);
        
        //use add category form elements
        $form = new Application_Form_Category();
        $form->populate($data[0]);
        
        $this->view->form = $form;
        $this->render('addcat');
      
        //change form elements:
        $form->setDefault('catname', 'Edit category name :');
        
        //update by the new values
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                
                $catname = $form->getValues();            
                $cat_model = new Application_Model_Category();
                if($cat_model->editCat($catname,$id))
                    {
                        $this->redirect("category/listall");
                    }
                 
            }
        }
    }


}

