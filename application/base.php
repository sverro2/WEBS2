<?php
// almost nothing to see here... just basic mvc stuff
class application
{
	public $uri; 

	function __construct( $uri = null )
	{
                ini_set('display_errors', 1);
		$this->uri = $uri;

		$this->loadController( $uri['controller'] );
                
                if(!isset($_SESSION['shopping_cart'])){
                    $_SESSION['shopping_cart'] = new session();
                }else{
                    //session_destroy();
                }
	}

	function loadController( $class )
	{
		$file = "application/controllers/".$this->uri['controller'].".php";

		if(!file_exists($file)) die( "controller not found at $file" );

		require_once($file);

		$controller = new $class();

		if( method_exists( $controller, $this->uri['method'] ) ){
			$controller->{$this->uri['method']}( $this->uri['var'] );
		} 
		else {
			$controller->index();
		}
	}
}

class model
{ 
	function __construct(){}
}

class controller
{
	function loadModel( $model )
	{
		require_once( 'application/models/'. $model .'.php' );
		return new $model;
	} 

	function loadView( $view, $vars="" )
	{
		if(is_array($vars) && count($vars) > 0) extract($vars, EXTR_PREFIX_SAME, "wddx");
		require_once( 'application/views/'.$view.'.php' );
	}
	
	function set_login( $vars="" )
	{
		if(is_array($vars) && count($vars) > 0) extract($vars, EXTR_PREFIX_SAME, "wddx");
		require_once( 'application/models/session.class.php' );
		
		$_SESSION["user_data"] = new Session();
		
		if(isset($_SESSION["user_data"])){
			$_SESSION["user_data"]->set_accountinfo($user_data["id"], $user_data["first_name"], $user_data["last_name"]);
			$_SESSION["user_data"]->set_email($user_data["email"]);
			
		}
		else		{
			echo "error set";
		}
		
		header( "Location: ../index.php" );
	}
	

	function redirect( $uri )
	{
		header( "Location: index.php?route=$uri" );
		
		die();
	}
}
