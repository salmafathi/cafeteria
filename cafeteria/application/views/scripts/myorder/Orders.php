<?php

class Application_Model_Order extends Zend_Db_Table_Abstract
{

    protected $_name="order_details";
    
    function addorder($orders){
       
       // echo '<pre>';
        //var_dump($orders);
        //echo '</pre>';
        //exit();
        for($i=0 ; $i<=count($orders); $i++){
            
        $this->insert($orders[$i]);}
        
        return TRUE ;
        
    }
    
    
}

