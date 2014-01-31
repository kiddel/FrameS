<?php
$_config = array();

// ------------------ 系统设定 ------------------
define('SYS_KEY', '1234567890');	// 加密密钥
// -------------- END 系统设定 ------------------

// ------------------ 数据库设定 ------------------
$_config['db']['server'] = 'localhost';			// 数据库服务器地址
$_config['db']['port'] = '3306';				// 数据库端口
$_config['db']['username'] = 'root';			// 数据库用户名
$_config['db']['password'] = '123456';			// 数据库密码
$_config['db']['name'] = 'frames';				// 数据库名
// -------------- END 数据库设定 ------------------

// 是否使用 MySQL 持续连接
$_config['db']['pconnect'] = false;

?>