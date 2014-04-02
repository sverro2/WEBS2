<?php

class model_login extends model{
    public function get_admin_account_credentials(){
        return $details = array('username' => 'admin', 'password'=>'password');
    }
}

