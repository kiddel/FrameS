<?php
require ROOT.'./app/controllers/BaseController.php';
class HomeController extends BaseController {
	public function __construct(){
		parent::__construct();
	}
	static public function index(){
		$vars = array(
			'test'=>'test123',
			'hello' => 'Hello World!',
		);
		View::load('index',$vars);
	}
}