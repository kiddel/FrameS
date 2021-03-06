<?php
class DEBUG{
	static public function INIT(){
		$GLOBALS['debug']['time_start'] = self::getmicrotime();
		$GLOBALS['debug']['query_num'] = 0;
	}
	static public function getmicrotime(){
		list($usec, $sec) = explode(' ',microtime());
		return ((float)$usec + (float)$sec);
	}
	static public function output(){
		$return[] = 'MySQL 请求 '.$GLOBALS['debug']['query_num'].' 次';
		$return[] = '运行时间：'.number_format((self::getmicrotime() - $GLOBALS['debug']['time_start']), 6).'秒';
		return implode(' , ', $return);
	}
	static public function query_counter(){
		$GLOBALS['debug']['query_num']++;
	}
	static public function MSG($string){
		if($_GET['debug']) echo "{$string}\r\n";
	}
}