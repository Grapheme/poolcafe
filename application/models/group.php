<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Model{

	protected $table = "group";
	protected $primary_key = "id";
	protected $fields = array("id","title","number");
	protected $order_by = 'number';

	function __construct(){
		parent::__construct();
	}
}