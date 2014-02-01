<?php
class Model {
	public function __construct(){}
	static public function load($model){
		if(!file_exists(ROOT.'./app/models/'.$model.'.php'))
			error::system_error('model '.$model.' not found');
		require ROOT.'./app/models/'.$model.'.php';
		$obj = new $model();
		return $obj;
	}
	static public function table($name){
		global $_config;
		return $_config['db']['prefix'].$name;
	}
	public function __destruct(){}
}