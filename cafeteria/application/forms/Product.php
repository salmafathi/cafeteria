<?php

class Application_Form_Product extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $id=new Zend_Form_Element_Hidden("id");
        $name=new Zend_Form_Element_Text("name");
        $name->setLabel("name: ");
        $name->setRequired();
        $name->addFilter(new Zend_Filter_StripTags());
        
        
        $price=new Zend_Form_Element_Text("price");
        $price->setLabel("price: ");
        $price->setRequired();
        $price->addValidator(new Zend_Validate_Int());
        
        $quntity= new Zend_Form_Element_Text("quntity");
        $quntity->setRequired();
        $quntity->setLabel("Quntity: ");
        $quntity->addValidator(new Zend_Validate_Int());
        
        
        $cid= new Zend_Form_Element_Select("cid");
        $cid->setRequired();
        $cid->setLabel("cid: ");

       // $cid->addMultiOption($option, $value);
        
        $picture= new Zend_Form_Element_File("pic");
        $picture->setRequired();
        $picture->setValueDisabled(TRUE);
        $picture->setLabel("Picture : ");
        $picture->addValidator(new Zend_Validate_File_IsImage());
        
        $submit = new Zend_Form_Element_Submit("submit");
        
        
        $this->addElements(array($name, $price,$quntity, $cid,$picture,$submit));
    }


}

