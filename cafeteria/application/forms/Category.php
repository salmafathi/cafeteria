<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $newcat = new Zend_Form_Element_Text("name");
        $newcat->setLabel("New Category Name : ");
        $newcat->setRequired();
        $newcat->addFilter(new Zend_Filter_StripTags());
      
        
        $submit = new Zend_Form_Element_Submit("Add Category");
        
        
        $this->addElements(array($newcat,$submit));
    }


}

