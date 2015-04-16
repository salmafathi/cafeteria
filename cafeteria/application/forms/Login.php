<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('class','form col-md-12 center-block');
        
        /* Form Elements & Other Definitions Here ... */
        $id=new Zend_Form_Element_Hidden("id");
        ?>
                    <div class="form-group">
                            <?php
        $email = new Zend_Form_Element_Text("email");
        $email->setRequired();
        $email->setAttrib("class", "form-control input-lg");
        $email->setAttrib("placeholder", "Enter Email");
        $email->addValidator(new Zend_Validate_EmailAddress());
        ?>
                    </div>
                    <div class="form-group">
                            <?php
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setAttrib("class", "form-control input-lg");
        $password->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));
        ?>
                    </div>
                    <div class="form-group">
                            <?php
        
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setAttrib("class", "btn btn-primary btn-lg btn-block");
        ?>
            </div>                            <?php
        $this->addElements(array( $email, $password,$submit));
    }


}

