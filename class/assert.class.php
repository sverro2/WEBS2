<?php
/**
 * Description of assert
 *
 * @author sven
 */

class assert {
    private $error = array();                   //collects all errors
    
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
