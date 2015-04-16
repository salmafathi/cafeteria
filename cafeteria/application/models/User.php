<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{

   protected $_name = "users";
    
    public function addUser($data){
          $validator = new Zend_Validate_Db_RecordExists(
            array(
            'table' => 'users',
            'field' => 'email',
            ));
          
            if($validator->isValid($data['email']))
            {
               echo $data['email']."Email already exist";
            }
            else {
            return $this->insert($data);
            } 
       
    }
    
     public function getUserById($id) {
                return $this->find($id)->toArray(); 
               // return $user_info; 
            
            } 
    public function editUser($id, $user_data){
         $this->update($user_data, "id=$id"); 
    }
    /////////////////////
    public function checkEmail(){
          $this->fetchAll($this->select)->where('emil');
    }
    ///////////////////////////

    public function listUser(){
        
        return $this->fetchAll()->toArray();
    }
    public function Updatepass($email,$newPassword){
        
        return $this->update(array('password'=>$newPassword),"email=".$email);
    }
    

    public function deleteUser($id){
        return $this->delete("id = $id ");
        
    }

}

