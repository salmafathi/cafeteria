<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $name = new Zend_Form_Element_Text("name");
        $name->setLabel("Name: ");
        $name->setRequired();
        $name->addFilter(new Zend_Filter_StripTags());
        
        
        $email = new Zend_Form_Element_Text("email");
        $email->setLabel("Email: ");
        $email->setRequired();
        $email->setAttrib("class", "form-control");
        $email->setAttrib("placeholder", "Enter Email");
        $email->addValidator(new Zend_Validate_EmailAddress());
        
         $picture= new Zend_Form_Element_File("picture");
        $picture->setRequired();
        $picture->setValueDisabled(TRUE);
        $picture->setLabel("Picture : ");
        $picture->addValidator(new Zend_Validate_File_IsImage());
        
        $room_number = new Zend_Form_Element_Text("room");
        $room_number->setLabel("Room Number : ");
        //room number can be one or two digits 
        $room_number->addValidator(new Zend_Validate_StringLength(array('min'=>1,'max'=>2)));
        $room_number->addValidator(new Zend_Validate_Int());
        
        $ext = new Zend_Form_Element_Text("ext");
        $ext->setLabel("Ext. :");
        //ext is only 4 digits 
         $ext->addValidator(new Zend_Validate_StringLength(array('min'=>4,'max'=>4)));
         $ext->addValidator(new Zend_Validate_Int());
         
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setLabel("Password: ");
        $password->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));
        
         $confirm_password = $this->createElement("password", "confirm_password");
        $confirm_password->setRequired();
        $confirm_password->setLabel("Confirm password: ");
        $confirm_password->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));
        
//        
//      $captchaElement = new Zend_Form_Element_Captcha(
//      'signup',
//      array('captcha' => array(
//        'captcha' => 'Image',
//          'font' => 'fonts/OpenSans-Bold.ttf',
//        'wordLen' => 6,
//        'timeout' => 600,
//          'imgDir'=>'/var/www/html/blog/public/captcha',
//          'imgUrl'=>'../captcha')
//              
//    ));
//    $captchaElement->setLabel('Please type in the words below to continue:');

        
        $submit = new Zend_Form_Element_Submit("Save");
        $reset = new Zend_Form_Element_Reset("Reset");
        
        
        $this->addElements(array($name, $email, $picture,$room_number, $ext, 
            $password,$confirm_password,$submit, $reset));
    }



}

