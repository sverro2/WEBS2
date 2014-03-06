<?php

/**
 * Session saves all important information that is needed to 
 *
 * @author sven
 */
class session {
    private $is_admin = false;                  //is the person a coordinator?
    private $is_coordinator = false;            //is the person a coordinator?
    
    private $account_id = -1;                 //database should look for things related to this person
    private $account_name = "Guest";            //accountname just for quick reference
    
    private $error = array();                   //collects all errors
    
    //setters
    public function set_admin(){
        $this->is_admin = true;
    }
    
    public function set_coordinator(){
        $this->is_coordinator = true;
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
    
    /**
     * adds a new experience (one by one)
     */
    public function add_experience_id($experience){
        if(!in_array($experience, $this->experience)){
            $this->experience[] = $experience;
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
