<?php
class View {
	public function __construct(){}
	static public function load($view,$vars = array()){
		if(!file_exists(ROOT.'./app/views/'.$view.'.php'))
			error::system_error('view '.$view.' not found');
		foreach($vars as $k=>$v) $$k = $v;
		$tpl = ROOT.'./app/views/'.$view.'.php';
		$cache = self::parse($tpl);
		include $cache;
		unlink($cache);
	}
	static private function parse($file){
		$template = file_get_contents($file);
		$template = '<?php if(!defined("IN_FRAMES")) exit("Access Denied"); ?>'."\n".$template;
		$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);
		$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\-\>\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?php echo \\1; ?>", $template);

		$template = preg_replace("/[\n\r\t]*\{view\s+([a-z0-9_:\/]+)\}/i", "<?php View::load('\\1'); ?>", $template);
		$template = preg_replace("/[\n\r\t]*\{echo\s+(.+?)\}/i", "<?php echo \\1; ?>", $template);

		$template = preg_replace("/\{if\s+(.+?)\}/i", "<?php if(\\1){ ?>", $template);
		$template = preg_replace("/\{elseif\s+(.+?)\}/i", "<?php }elseif(\\1){ ?>", $template);
		$template = preg_replace("/\{else\}/i", "<?php }else{ ?>", $template);
		$template = preg_replace("/\{\/if\}/i", "<?php } ?>", $template);

		$template = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/i", "<?php if(is_array(\\1)) foreach(\\1 as \\2) { ?>", $template);
		$template = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/i", "<?php if(is_array(\\1)) foreach(\\1 as \\2 => \\3) { ?>", $template);
		$template = preg_replace("/\{\/loop\}/i", "<?php } ?>", $template);

		$cache = ROOT.'./app/cache/'.md5($file).'.php';
		$fp = fopen($cache,'w+');
		fwrite($fp,$template);
		fclose($fp);
		return $cache;
	}
	public function __destruct(){}
}