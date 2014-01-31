<?php
class System {
	public function __construct(){
		global $_config;
		require SYSTEM_ROOT.'./class/error.php';
		require SYSTEM_ROOT.'./class/debug.php';
		require SYSTEM_ROOT.'./class/database.php';
		DEBUG::INIT();
		$this->headerSet();
		$this->systemInit();
	}
	public function headerSet(){
		ob_start();
		header('Content-type: text/html; charset=utf-8');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-cache');
		header('Pragma: no-cache');
		@date_default_timezone_set('Asia/Shanghai');
	}
	public function systemInit(){
		define('SYSTEM_STARTED', true);
		$uri = $_SERVER['REQUEST_URI'];
		$uri = str_replace('/index.php','',$uri);
		$uri = substr($uri,1);
		if(!$uri) $uri = '/';
		$route = $uri;
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		Router::route($method,$route);
	}
	public function __destruct(){
		if(!defined('SYSTEM_STARTED')) return;
		flush();
		ob_end_flush();
	}
}