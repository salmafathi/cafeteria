<?php

class Application_Model_orderdetails extends Zend_Db_Table_Abstract
{

    protected $_name="orders";
    
    function addorderdetails($order){
        return $this->insert($order[0]);
    }
    
    
}

