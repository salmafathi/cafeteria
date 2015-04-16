<?php

class Application_Model_Order extends Zend_Db_Table_Abstract
{
    protected  $_name = "orders" ;
     
     
     function  checkorder($start,$end)
    {
        $result= $this->select()->from(array('o' => 'orders'), array('total' => 'SUM(total)','uid' => 'uid'))
                ->join(array('user'=>'users'),'user.id = o.uid',array('name'))
                ->where("date between '".$start."' and '".$end."'")
                ->group('name') ;
        return $this->fetchAll($result->setIntegrityCheck(false))->toArray();
      
    }
    function  checkordersel($start,$end,$userid)
    {
        $result= $this->select()->from(array('o' => 'orders'), array('total' => 'SUM(total)'))
                ->join(array('user'=>'users'),'user.id = o.uid',array('name'))
                ->where('o.date >= ?',$start,'o.date <= ? ',$end)
                ->where('o.uid=?',$userid)
                ->group('name') ;
        return $this->fetchAll($result->setIntegrityCheck(false))->toArray();
      
    }
    function checkdates($start,$end,$userid) {
        $result = $this->select()->from( 'orders',array('id','date', 'total'))
                ->where("date between '".$start."' and '".$end."'")
                ->where('uid=?',$userid);
       
        return $this->fetchAll($result)->toArray();
    }
   function getOrders($date1, $date2, $id) {

        $select = $this->select()
                ->from(array('o' => 'orders'), //t1
                        array('date', 'uid', 'status', 'id'))  //select cols from table
                ->join(array('r' => 'order_details'), //t2
                        'o.id = r.order_id')
                ->where('o.date >= ?', $date1)
                ->where('o.status != ?', 'canceled')
                ->where('o.date <= ?', $date2)
                ->where('o.uid = ?', $id);

        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
    }

//    function deleteOrders($id_orders, $id_prod_order) {
//        
//        $pro = new Application_Model_Prductorder();
//        $pro->deleteProductOrders($id_prod_order);
//        return $this->delete("id=$id_orders");
//        
//    }
    function cancelOrder($id_orders) {
         return $this->update(array('status' => 'canceled'), "id=$id_orders");
        
    }
    
     function getProductOrder($order_date,$user_id){
        $select = $this->select();
        $select->from(array('o' => $this->_name), array())
        ->join(array('po' => 'order_details'), 'o.id=po.order_id', array("quntity","total"))
        ->join(array('p' => 'product'), 'p.id = po.pid', array("name","pic"))
        ->where("date= ?" , $order_date)
        ->where("uid= ?" ,$user_id)->setIntegrityCheck(false);
        
        return $this->fetchAll($select)->toArray();
    }


function getOrders($datefrom, $dateto, $id) {

        $select = $this->select()
                ->from(array('o' => 'orders'), //t1
                        array('date', 'uid', 'status', 'ID','total'=>'SUM(`total`)'))  //select cols from table
                ->join(array('r' => 'order_details'), //t2
                        'o.ID = r.order_id')
                ->where('o.date >= ?', $datefrom)
                ->where('o.status!= ?', 'cancel')
                ->where('o.date <= ?', $dateto)
                
                ->where('o.uid = ?', $id)
                ->group('o.date');

        $select->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();
        return $row;
    }

    function cancelOrder($id_orders) {
         return $this->update(array('status' => 'cancel'), "ID =$id_orders");
        
    }
    
     function getProductOrder($date,$U_id){
        $select = $this->select();
        $select->from(array('o' => $this->_name), array())
        ->join(array('orderd' => 'order_details'), 'o.ID=orderd.order_id', array("quntity"))
        ->join(array('p' => 'product'), 'p.id = orderd.pid', array("name","pic","price"))
        ->where("date= ?" , $date)
        ->where("uid= ?" ,$U_id)->setIntegrityCheck(false);
        
        return $this->fetchAll($select)->toArray();
    }

   

}

