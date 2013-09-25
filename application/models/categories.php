<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model{

	protected $table = "categories";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'sort,title,parent';

	function __construct(){
		parent::__construct();
	}
}