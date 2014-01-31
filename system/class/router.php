<?php
class Router {
	static public $routes;
	public function __construct(){
		self::$routes = array();
	}
	static public function get($router,$action){
		$action = explode('.',$action);
		$controller = $action['0'];
		$function = $action['1'];
		self::$routes['get'][$router] = array('controller'=>$controller,'function'=>$function);
	}
	static public function post($router,$action){
		$action = explode('.',$action);
		$controller = $action['0'];
		$function = $action['1'];
		self::$routes['post'][$router] = array('controller'=>$controller,'function'=>$function);
	}
	static public function any($router,$action){
		$action = explode('.',$action);
		$controller = $action['0'];
		$function = $action['1'];
		self::$routes['get'][$router] = array('controller'=>$controller,'function'=>$function);
		self::$routes['post'][$router] = array('controller'=>$controller,'function'=>$function);
	}

	static public function route($method,$route){
		if(!@self::$routes[$method][$route])
			error::system_error('router '.$route.' not found');
		$router = self::$routes[$method][$route];
		require ROOT.'./app/controllers/'.$router['controller'].'.php';
		$controller = $router['controller'];
		$function = $router['function'];
		$controller::$function();
	}
	public function __destruct(){}
}