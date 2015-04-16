<?php

class Application_Model_Userorder extends Zend_Db_Table_Abstract
{

    protected $_name="product";
    
    function listallProducts(){
        return $this->fetchAll()->toArray();
    }
    
    function getPriceById($id){
        return $this->find($id)->toArray();   
    }
    
    function insertorder($order){
        return $this->insert($order);
    }
    
    
}

