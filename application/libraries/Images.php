<?php if(!defined('BASEPATH')) exit('no direct scripting allowed');

class Images{

	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->library('image_lib');
	}

	public function cropToSquare($source,$base_width,$base_height,$x = 4,$y = 3,$dest = FALSE){
		// $config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config['maintain_ratio'] = FALSE;
		if($dest):
			$config['new_image'] = $dest;
		endif;
		list($width,$height,$type) = getimagesize($source);
		$config['x_axis'] = 0; $config['y_axis'] = 0;
		if($width > $base_width):
			$this->resizeImage($source,$base_width,$base_height);
		elseif($height > $base_height):
			$this->resizeImage($source,$base_width,$base_height,'height');
		endif;
		list($width,$height,$type) = getimagesize($source);
		if($width > $height):
			$config['x_axis'] = ($width/2)-($height/2);
			$config['width'] = $config['height'] = $height;
		elseif($width < $height):
			$config['y_axis'] = ($height/2)-($width/2);
			$config['width'] = $config['height'] = $width;
		endif;
		$this->CI->image_lib->initialize($config);
		if(!$this->CI->image_lib->crop()):
			$this->CI->image_lib->clear();
			return FALSE;
		else:
			$this->CI->image_lib->clear();
			return TRUE;
		endif;
	}

	public function resizeImage($source,$width,$height,$dim = 'width',$dest = FALSE){
		
		$config['source_image'] = $source;
		if($dest):
			$config['new_image'] = $dest;
		endif;
		$config['master_dim'] = $dim;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->CI->image_lib->initialize($config);
		if(!$this->CI->image_lib->resize()):
			$this->CI->image_lib->clear();
			return FALSE;
		else:
			$this->CI->image_lib->clear();
			return TRUE;
		endif;
	}
}
?>