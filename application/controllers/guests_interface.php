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
			'news' => array(),
			'pagination' => array()
		);
		if($this->input->get('news') === FALSE):
			$pagevar['news'] = $this->news->limit($this->per_page,$this->offset);
			$pagevar['pagination'] = $this->pagination('news',3,$this->news->countAllResults(),$this->per_page);
			$this->load->view("guests_interface/news",$pagevar);
		elseif(is_numeric($this->input->get('news'))):
			$pagevar['news'] = $this->news->getWhere($this->input->get('news'));
			$this->load->view("guests_interface/single-news",$pagevar);
		endif;
	}
	
	public function events(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->helper('date');
		$this->load->model('events');
		$pagevar = array(
			'events' => array(),
			'pagination' => array(),
		);
		$category = array('Концерт','Выставка','Другое');
		if($this->input->get('event') === FALSE):
			$pagevar['events'] = $this->events->limit($this->per_page,$this->offset);
			$pagevar['pagination'] = $this->pagination('events',3,$this->events->countAllResults(),$this->per_page);
			for($i=0;$i<count($pagevar['events']);$i++):
				$pagevar['events'][$i]['category_title'] = $category[$pagevar['events'][$i]['category']];
			endfor;
			$this->load->view("guests_interface/events",$pagevar);
		elseif(is_numeric($this->input->get('event'))):
			$pagevar['events'] = $this->events->getWhere($this->input->get('event'));
			$pagevar['events']['category_title'] = $category[$pagevar['events']['category']];
			$this->load->view("guests_interface/single-event",$pagevar);
		endif;
		
	}
	
	public function aquarium(){
		
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->getMenuByCategories(4),
		);
		$this->load->view("guests_interface/aquarium",$pagevar);
	}
	
	public function menu(){
		
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->getMenuByCategories(1),
		);
		$this->load->view("guests_interface/menu",$pagevar);
	}
	
	public function wineCard(){
		
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->getMenuByCategories(2),
		);
		$this->load->view("guests_interface/wine-card",$pagevar);
	}
	
	public function bar(){
		
		$this->load->helper('text');
		$pagevar = array(
			'menu' => $this->getMenuByCategories(3),
		);
		$this->load->view("guests_interface/bar",$pagevar);
	}
	
	public function kids(){
		
		$pagevar = array(
		);
		$this->load->view("guests_interface/kids",$pagevar);
	}
	
	private function getMenuByCategories($group){
		
		$this->load->model('menu');
		$menu = array(); $categories = array();
		if($AllMenu = $this->menu->getWhere(NULL,array('group'=>$group),TRUE)):
			if($parentsCategories = $this->getParentsCategoriesMenu()):
				if($categoriesHierarchy = $this->getHierarchyCategoriesMenu($parentsCategories)):
					$categories = $categoriesHierarchy;
				endif;
			endif;
			if(!empty($categories)):
				$menu = $categories;
				for($parents=0;$parents<count($categories);$parents++):
					for($m=0;$m<count($AllMenu);$m++):
						if($AllMenu[$m]['category'] == $categories[$parents]['id']):
							$menu[$parents]['products'][] = $AllMenu[$m];
						endif;
					endfor;
					if(isset($categories[$parents]['children'])):
						for($children=0;$children<count($categories[$parents]['children']);$children++):
							for($m=0;$m<count($AllMenu);$m++):
								if($AllMenu[$m]['category'] == $categories[$parents]['children'][$children]['id']):
									$menu[$parents]['children'][$children]['products'][] = $AllMenu[$m];
								endif;
							endfor;
						endfor;
					endif;
				endfor;
			endif;
		endif;
		return $menu;
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