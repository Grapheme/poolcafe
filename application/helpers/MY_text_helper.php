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
			$propertyMenu = explode(' ',$property);
			if(!isset($propertyMenu[0]) || empty($propertyMenu[0])):
				$propertyMenu[0] = '';
			endif;
			if(!isset($propertyMenu[1]) || empty($propertyMenu[1])):
				$propertyMenu[1] = '';
			endif;
			return '<span class="elem-weight-value">'.$propertyMenu[0].'</span> '.$propertyMenu[1];
		else:
			return '';
		endif;
	}
	
?>