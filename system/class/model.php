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
	public function __destruct(){}
}