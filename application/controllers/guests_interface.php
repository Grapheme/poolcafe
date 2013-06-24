<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	
	function __construct(){

		parent::__construct();
	}
	
	public function index(){
		
		$this->load->helper('date');
		$this->load->model(array('news','events'));
		$pagevar = array(
			'news' => $this->news->limit(2,0),
			'events' => $this->events->limit(2,0)
		);
		$category = array('Концерт','Выставка','Другое');
		for($i=0;$i<count($pagevar['events']);$i++):
			$pagevar['events'][$i]['category_title'] = $category[$pagevar['events'][$i]['category']];
		endfor;
		$this->load->view("guests_interface/index",$pagevar);
	}
	
	public function news(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->helper('date');
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination('news',3,$this->news->countAllResults(),$this->per_page),
		);
		$this->load->view("guests_interface/news",$pagevar);
	}
	
	public function events(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->helper('date');
		$this->load->model('events');
		$pagevar = array(
			'events' => $this->events->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination('events',3,$this->events->countAllResults(),$this->per_page),
		);
		$category = array('Концерт','Выставка','Другое');
		for($i=0;$i<count($pagevar['events']);$i++):
			$pagevar['events'][$i]['category_title'] = $category[$pagevar['events'][$i]['category']];
		endfor;
		$this->load->view("guests_interface/events",$pagevar);
	}
	
	public function aquarium(){
		
		$this->load->model('menu');
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->menu->getWhere(NULL,array('group'=>4),TRUE),
		);
		$this->load->view("guests_interface/aquarium",$pagevar);
	}
	
	public function menu(){
		
		$this->load->model('menu');
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->menu->getWhere(NULL,array('group'=>1),TRUE),
		);
		$this->load->view("guests_interface/menu",$pagevar);
	}
	
	/******************************************* Авторизация и регистрация ***********************************************/
	
	public function signIN(){
		
		$this->load->view("guests_interface/accounts/signin");
	}
	
	public function logoff(){
		
		$this->clearSession(FALSE);
		$this->session->unset_userdata(array('logon'=>'','profile'=>'','account'=>'','backpath'=>''));
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
}