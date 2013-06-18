<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Model{

	protected $table = "events";
	protected $primary_key = "id";
	protected $fields = array("id","title","translit","anonce","content","date_publish","tags","category","age","time","price");

	function __construct(){
		parent::__construct();
	}
}