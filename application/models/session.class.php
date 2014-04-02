<?php

/**
 * Session saves all important information that is needed to 
 *
 * @author sven
 */
class session {
    private $is_admin = false;                  //is the person a coordinator?
    
    private $account_id = -1;                 //database should look for things related to this person
    private $account_name = "Guest";            //accountname just for quick reference
    
    private $error = array();                   //collects all errors
    
    private $cart = array();

    //setters
    public function set_admin($bool){
        $this->is_admin = $bool;
    }
    
    public function set_accountinfo($id, $name){
        if(id > 0 && strlen($name) > 0 && is_string($name) && account_id == -1 && is_int($id)){
            $this->account_id = $id;
            $this->account_name = $name;
        }else{
            if($this->account_id != -1){
                $this->throw_error(1, "An account session id has already been set!");
            }else{
                $this->throw_error(1, "An account session id has already been set!");
            }
        }
        
    }
    
    //getters
    public function is_admin(){
        return $this->is_admin;
    }
    
    public function get_name(){
        return $this->account_name;
    }
    
    public function get_id(){
        return $this->account_id;
    }

    public function get_cart(){
        return $this->cart;
    }
    
    
    /*
    public function add_cart($id){
        if(array_key_exists($id, $this->cart))
        {
            $val = $this->cart[$id];
            $this->cart[$id] = ($val + 1);
        }else{
            $this->cart[$id] = 1;
        }
        
    }

    public function remove_cart($id){
        if(array_key_exists($id, $this->cart))
        {
            $val = $this->cart[$id];
            if($val > 1)
            {
                $this->cart[$id] = ($val - 1);
            }else{
                unset($this->cart[$id]);
            }
            
        } 
    }*/
    
    public function amount_cart($id, $value){
        
        if ($value == 0){
            unset($this->cart[$id]);
        }  elseif ($value <= 10 && $value>0) {
            $this->cart[$id] = $value;
        }
    }
    
    public function exists_cart($id){
        if(array_key_exists($id, $this->cart)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * All errors occuring during a session can be saved. An error number and description will be saved.
     * Errors are just registered once.
     * 
     * When you like to have more errors with the same number, but would like to have different descriptions,
     * you can by using an error number <= 0
     * 
     * @param int $error_number
     * @param string $error_string
     */
    public function throw_error($error_number, $error_string){
        $error_already_exists = false;
        foreach ($this->error as $error_item){
            if($error_number == $error_item[0] && $error_item[0] <= 0){
                $error_already_exists = true;
            }
        }
        if(!$error_already_exists){
            $this->error[] = array($error_number, $error_string);
        }
    }
    
    public function get_errors(){
        return $this->error;
    }
    
}
