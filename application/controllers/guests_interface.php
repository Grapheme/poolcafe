<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		
	}
	
	public function index(){
		
		$this->load->helper('date');
		$this->load->model(array('news','events','pages','page_resources'));
		$pagevar = array(
			'contents'=>$this->pages->getAll(),
			'news' => $this->news->limit(2,0),
			'events' => $this->events->limit(2,0),
			'resources1'=>$this->page_resources->getWhere(NULL,array('page'=>1),TRUE),
			'resources2'=>$this->page_resources->getWhere(NULL,array('page'=>2),TRUE),
			'resources3'=>$this->page_resources->getWhere(NULL,array('page'=>3),TRUE),
			'resources4'=>$this->page_resources->getWhere(NULL,array('page'=>4),TRUE),
			'resources5'=>$this->page_resources->getWhere(NULL,array('page'=>5),TRUE),
			'resources6'=>$this->page_resources->getWhere(NULL,array('page'=>6),TRUE),
			'resources7'=>$this->page_resources->getWhere(NULL,array('page'=>7),TRUE),
			'resources8'=>$this->page_resources->getWhere(NULL,array('page'=>8),TRUE)
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
			'pagination' => array(),
			'linkback' => array('exist'=>FALSE,'link'=>''),
			'linkforward' => array('exist'=>FALSE,'link'=>'')
		);
		if($this->input->get('news') === FALSE):
			$pagevar['news'] = $this->news->limit($this->per_page,$this->offset);
			$pagevar['pagination'] = $this->pagination('news',3,$this->news->countAllResults(),$this->per_page);
			$this->load->view("guests_interface/news",$pagevar);
		elseif(is_numeric($this->input->get('news'))):
			$pagevar['news'] = $this->news->getWhere($this->input->get('news'));
			$pagevar['linkback'] = $this->getBackLink($this->input->get('news'),'news','news');
			$pagevar['linkforward'] = $this->getForwardLink($this->input->get('news'),'news','news');
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
			'linkback' => array('exist'=>FALSE,'link'=>''),
			'linkforward' => array('exist'=>FALSE,'link'=>'')
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
			$pagevar['linkback'] = $this->getBackLink($this->input->get('event'),'events','event');
			$pagevar['linkforward'] = $this->getForwardLink($this->input->get('event'),'events','event');
			$pagevar['events']['category_title'] = $category[$pagevar['events']['category']];
			$this->load->view("guests_interface/single-event",$pagevar);
		endif;
		
	}
	
	public function aquarium(){
		
		$this->load->helper('text');
		$this->load->model(array('group','pages'));
		$pagevar = array(
			'nav_menu' => $this->group->getAll('number'),
			'menu' => array(),
			'contents'=>$this->pages->getAll()
		);
		if($manuAllCategories = $this->getMenuByCategories(3)):
			$pagevar['menu'] = $this->clearingEmptyCategories($manuAllCategories);
		endif;
		$this->load->view("guests_interface/aquarium",$pagevar);
	}
	
	public function menu(){
		
		$this->load->helper('text');
		$this->load->model('group');
		$pagevar = array(
			'nav_menu' => $this->group->getAll(),
			'menu' => array()
		);
		if($manuAllCategories = $this->getMenuByCategories(1)):
			$pagevar['menu'] = $this->clearingEmptyCategories($manuAllCategories);
		endif;
		$this->load->view("guests_interface/menu",$pagevar);
	}
	
	public function wineCard(){
		
		$this->load->helper('text');
		$this->load->model('group');
		$pagevar = array(
			'nav_menu' => $this->group->getAll(),
			'menu' => array()
		);
		if($manuAllCategories = $this->getMenuByCategories(2)):
			$pagevar['menu'] = $this->clearingEmptyCategories($manuAllCategories);
		endif;
		$this->load->view("guests_interface/wine-card",$pagevar);
	}
	
	public function bar(){
		
		$this->load->helper('text');
		$this->load->model('group');
		$pagevar = array(
			'nav_menu' => $this->group->getAll(),
			'menu' => array()
		);
		if($manuAllCategories = $this->getMenuByCategories(4)):
			$pagevar['menu'] = $this->clearingEmptyCategories($manuAllCategories);
		endif;
		$this->load->view("guests_interface/wine-card",$pagevar);
	}
	
	public function kids(){
		
		$this->load->model('pages');
		$this->load->view("guests_interface/kids",array('contents'=>$this->pages->getAll()));
	}

	public function poolRules(){
		
		$this->load->model('pages');
		$this->load->view("guests_interface/pool-rules",array('contents'=>$this->pages->getAll()));
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
	
	private function clearingEmptyCategories($menu){
		
		$newMenu = $this->deleteEmptyParentsAndChildrens($menu);
		return  $this->reIndexMenu($newMenu);
	}
	
	private function deleteEmptyParentsAndChildrens($menu){
		
		$unsetParentMenu = $menu;
		for($parents=0;$parents<count($menu);$parents++):
			if(!isset($menu[$parents]['products']) && !isset($menu[$parents]['children'])):
				unset($unsetParentMenu[$parents]);
			endif;
		endfor;
		$menu = $this->reIndexArray($unsetParentMenu);
		unset($unsetParentMenu);
		$unsetChildrenMenu = $menu;
		for($parents=0;$parents<count($menu);$parents++):
			if(isset($menu[$parents]['children'])):
				for($children=0;$children<count($menu[$parents]['children']);$children++):
					if(!isset($menu[$parents]['children'][$children]['products'])):
						unset($unsetChildrenMenu[$parents]['children'][$children]);
					endif;
				endfor;
			endif;
			if(empty($unsetChildrenMenu[$parents]['children']) && empty($unsetChildrenMenu[$parents]['products'])):
				unset($unsetChildrenMenu[$parents]);
			endif;
		endfor;
		$menu = $unsetChildrenMenu;
		unset($unsetChildrenMenu);
		return $menu;
	}
	
	private function reIndexMenu($menu){
		
		$newMenu = $this->reIndexArray($menu); //Реиндексация родительского массива
		for($parents=0;$parents<count($newMenu);$parents++):
			if(isset($newMenu[$parents]['children'])):
				$newMenu[$parents]['children'] = $this->reIndexArray($newMenu[$parents]['children']);//Реиндексация потомкового массива
			endif;
		endfor;
		for($parents=0;$parents<count($newMenu);$parents++):
			if(isset($newMenu[$parents]['children'])):
				for($children=0;$children<count($newMenu[$parents]['children']);$children++):
					if(!isset($newMenu[$parents]['children'][$children]['products'])):
						$newMenu[$parents]['children'][$children]['products'] = $this->reIndexArray($newMenu[$parents]['children'][$children]['products']);
						//Реиндексация массива продуктов
					endif;
				endfor;
			endif;
		endfor;
		return $newMenu;
	}
	
	private function getBackLink($itemID,$table,$getParam){
		
		$this->load->model($table);
		$items = $this->$table->getAll();
		$itemsIDs = $this->getValuesInArray($items);
		$backLink = array('exist'=>FALSE,'link'=>'');
		$positionID = array_search($itemID,$itemsIDs);
		if($positionID !== FALSE):
			if(isset($itemsIDs[$positionID-1])):
				$backLink['exist'] = TRUE;
				$backLink['link'] = site_url($table.'/'.$items[$positionID-1]['translit'].'?'.$getParam.'='.$items[$positionID-1]['id']);
			endif;
		endif;
		return $backLink;
	}
	
	private function getForwardLink($itemID,$table,$getParam){
		
		$this->load->model($table);
		$items = $this->$table->getAll();
		$itemsIDs = $this->getValuesInArray($items);
		$forwardLink = array('exist'=>FALSE,'link'=>'');
		$positionID = array_search($itemID,$itemsIDs);
		if($positionID !== FALSE):
			if(isset($itemsIDs[$positionID+1])):
				$forwardLink['exist'] = TRUE;
				$forwardLink['link'] = site_url($table.'/'.$items[$positionID+1]['translit'].'?'.$getParam.'='.$items[$positionID+1]['id']);
			endif;
		endif;
		return $forwardLink;
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