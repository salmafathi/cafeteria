<?php

class Application_Model_Category extends Zend_Db_Table_Abstract

{
    protected $_name="category";
    
    function addCat($data)
    {
        
        $validator = new Zend_Validate_Db_RecordExists(
                array(
                         'table' => 'category',
                          'field' => 'name',
                       )
                
                );

            if($validator->isValid($data['name']))
                {
                    echo $data['name']."  category is already Exist";

                }
                
            else
            {
                return $this->insert($data);
            }
 
    }
    
    
    function deleteCat($id){
        $this->delete("id=$id");
        
    }
    
    function editCat($data,$id){
        print_r($data);  
        return $this->update($data,"id=".$id) ;
    }
    
    function getCatById($id)
    {
       return $this->find($id)->toArray();
    }
    
    function listallCat(){
       
        return $this->fetchAll()->toArray();
    }
    



}

