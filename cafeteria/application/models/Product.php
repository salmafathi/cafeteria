<?php

class Application_Model_Product extends Zend_Db_Table_Abstract {

    protected $_name = 'product';

    function addproduct($data) {
        $validator = new Zend_Validate_Db_RecordExists(
                array(
                         'table' => 'product',
                          'field' => 'name',
                       )
                
                );

            if($validator->isValid($data['name']))
                {
                    echo $data['name']."  Product is already Exist";

                }
                
            else
            {
        
            return $this->insert($data);
        }
    }
    

    function listproduct() {
        return $this->fetchAll()->toArray();
    }


    function deleteproduct($id) {
        return $this->delete("id=$id");
        
    }

    function editProduct($id, $user_data) {
        $this->update($user_data, "id=$id");
        
    }

    function getProductById($id) {
        
        $product_info = $this->find($id)->toArray();
        return $product_info;
    }
    function checkproducts($orderid) {
       $result= $this->select()->from(array('product'), array('name','price','pic'))
                ->join(array('order_details'),'product.id = order_details.pid',array('quntity'))
                ->where('order_details.order_id=?',$orderid)
                ->setIntegrityCheck(false);
       
        return $this->fetchAll($result)->toArray();
    }

}
