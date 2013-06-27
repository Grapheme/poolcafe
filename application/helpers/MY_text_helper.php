<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function blog_limiter($content){
		
		if(!empty($content)):
			$pattern = "/\<cut text\=\"(.+?)\">/i";
			$replacement = "<a href=\"#\" class=\"no-clickable advanced muted\">\$1</a> <cut>";
			return preg_replace($pattern, $replacement,$content);
		else:
			return '';
		endif;
	}
	
	function getMenuProperty($property){
		
		if(!empty($property)):
			list($size,$value) = explode(' ',$property);
			return '<span class="elem-weight-value">'.$size.'</span> '.$value;
		else:
			return '';
		endif;
	}
	
?>