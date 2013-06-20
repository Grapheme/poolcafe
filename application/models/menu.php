<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Model{

	protected $table = "menu";
	protected $primary_key = "id";
	protected $fields = array("id","title","photo_exist","property","group","category","description","price","date_publish");
	protected $order_by = 'title';

	function __construct(){
		parent::__construct();
	}
}