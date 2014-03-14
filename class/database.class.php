<?php

/**
 * This is my first database class!
 *
 * @author sven
 */
class Database {
    private $my_sqli_connect;
    private $result;
    
    function __construct($schema) {
        $mysqli = new mysqli("databases.aii.avans.nl", "sbrettsc", "sven", $schema);
        
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
 
        $this->my_sqli_connect = $mysqli;
    }
    
    public function do_sql($query){
        $this->result = $this->my_sqli_connect->query($query);
    }
    
    public function get_array_from_query($query){
        $this->result = $this->my_sqli_connect->query($query);

        if( ! $this->result )
        {
            echo $this->my_sqli_connect->connect_error;
            echo 'An error occured when processing an important query. Exited...';
            exit;
        }

        $aResult = array();

        while( $r = $this->result->fetch_assoc() )
        {
            $aResult[] = $r;
        }
        
        return $aResult;
    }
    
    public function check_login($username, $password){
        $username = $this->my_sqli_connect->real_escape_string($username);
        $password = $this->my_sqli_connect->real_escape_string($password);
        
        $inlog_check_query = "SELECT count(customer_username) as accepted FROM Account WHERE customer_username=? AND customer_pass=?";
        
        $stmt = $this->my_sqli_connect->stmt_init();
        
        if($stmt->prepare($inlog_check_query)){
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            return $result->fetch_object()->accepted;
            
        }else{
            echo "It was not possible to prepare check_login statement";
        }
        
                
    }
    
    public function get_record(){
        if($this->result){
            return $this->result->fetch_object();
        }else{
            return false;
        }
    }
    
    public function __destruct() {
        //$this->result->close();
        $this->my_sqli_connect->close();
    }
}