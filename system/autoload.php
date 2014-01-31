<?php
error_reporting(E_ALL ^ E_NOTICE);
define('IN_FRAMES', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('TIMESTAMP', time());
define('FRAMES_VERSION','Alpha');
require SYSTEM_ROOT.'./class/router.php';
require SYSTEM_ROOT.'./core.php';
require SYSTEM_ROOT.'./class/controller.php';
require SYSTEM_ROOT.'./class/model.php';
require SYSTEM_ROOT.'./class/view.php';
require ROOT.'./app/routes.php';
$system = new System();