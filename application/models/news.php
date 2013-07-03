<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model{

	protected $table = "news";
	protected $primary_key = "id";
	protected $fields = array("id","title","photo_report","translit","anonce","content","date_publish");
	protected $order_by = 'date_publish DESC';

	function __construct(){
		parent::__construct();
	}
}