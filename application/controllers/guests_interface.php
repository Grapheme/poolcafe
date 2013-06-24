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
		
		$this->offset = intval($this->uri->segment(4));
		$this->load->helper('date');
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination('news',3,$this->news->countAllResults(),$this->per_page),
		);
		$this->load->view("guests_interface/news",$pagevar);
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