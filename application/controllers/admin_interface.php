<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus):
			redirect('');
		endif;
	}
	
	/******************************************** cabinet *******************************************************/
	public function control_panel(){
		
		$pagevar = array(
		
		);
		$this->load->view("admin_interface/cabinet/control-panel",$pagevar);
	}
	
	public function changePassword(){
		
		$this->load->view("admin_interface/cabinet/profile");
	}
	
	public function pages(){
		
		$this->load->model('pages');
		$this->load->view("admin_interface/cabinet/pages",array('contents'=>$this->pages->getAll()));
	}
	
	public function pagesResources(){
		
		$this->load->model('page_resources');
		if($this->input->get('mode') == 'slideshow'):
			$pagevar = array(
				'resources1'=>$this->page_resources->getWhere(NULL,array('page'=>1),TRUE),
				'resources2'=>$this->page_resources->getWhere(NULL,array('page'=>2),TRUE),
				'resources3'=>$this->page_resources->getWhere(NULL,array('page'=>3),TRUE)
			);
		elseif($this->input->get('mode') == 'single'):
			$pagevar = array(
				'resources'=>$this->page_resources->getWhere(NULL,array('page'=>$this->input->get('id')),TRUE),
			);
		endif;
		$this->load->view("admin_interface/cabinet/page-resources",$pagevar);
	}
	
	/********************************************* news *********************************************************/
	public function news(){
		
		$this->offset = intval($this->uri->segment(4));
		$this->load->helper(array('date','text'));
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination(ADMIN_START_PAGE.'/news',4,$this->news->countAllResults(),$this->per_page),
		);
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/news/list",$pagevar);
	}
	
	public function addNews(){
		
		$this->load->helper('form');
		$this->load->view("admin_interface/news/add");
	}
	
	public function editNews(){
		
		$this->load->helper(array('date','form'));
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->getWhere($this->uri->segment(4)),
		);
		if(empty($pagevar['news'])):
			show_error('В доступе отказано');
		endif;
		$pagevar['news']['date_publish'] = swap_dot_date_without_time($pagevar['news']['date_publish']);
		$this->load->view("admin_interface/news/edit",$pagevar);
	}
	
	public function deleteNews(){
		
		$this->load->model('news');
		$this->news->delete($this->uri->segment(4));
		redirect(ADMIN_START_PAGE.'/news');
	}
	/********************************************* events ********************************************************/
	public function events(){
		
		$this->offset = intval($this->uri->segment(4));
		$this->load->helper(array('date','text'));
		$this->load->model('events');
		$pagevar = array(
			'events' => $this->events->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination(ADMIN_START_PAGE.'/events',4,$this->events->countAllResults(),$this->per_page),
		);
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/events/list",$pagevar);
	}
	
	public function addEvent(){
		
		$this->load->helper('form');
		$this->load->view("admin_interface/events/add");
	}
	
	public function editEvent(){
		
		$this->load->helper(array('date','form'));
		$this->load->model('events');
		$pagevar = array(
			'event' => $this->events->getWhere($this->uri->segment(4)),
		);
		if(empty($pagevar['event'])):
			show_error('В доступе отказано');
		endif;
		$pagevar['event']['date_publish'] = swap_dot_date_without_time($pagevar['event']['date_publish']);
		$this->load->view("admin_interface/events/edit",$pagevar);
	}
	
	public function deleteEvent(){
		
		$this->load->model('events');
		$this->events->delete($this->uri->segment(4));
		redirect(ADMIN_START_PAGE.'/events');
	}
	
	public function profile(){
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			if($this->postDataValidation('password') == TRUE):
				$update = $this->input->post();
				$msgs = 'Профиль сохранен.';
				if($_FILES['photo']['error'] != 4):
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
					$update['photo'] = file_get_contents($_FILES['photo']['tmp_name']);
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,64,64);
					$update['thumbnail'] = file_get_contents($_FILES['photo']['tmp_name']);
				endif;
				$update['id'] = $this->user['uid'];
				$this->users->update_record($update);
				if(!empty($update['password'])):
					$this->users->update_field($this->user['uid'],'password',md5($update['password']),'users');
					$msgs .= ' Пароль изменен.';
				endif;
				$this->session->set_userdata('msgs',$msgs);
				redirect($this->uri->uri_string());
			else:
				$json_request['message'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
			endif;
		endif;
		$pagevar = array(
			'languages' => $this->manual_languages->visible_languages(),
			'profile' => $this->users->read_record($this->user['uid'],'users'),
		);
		$this->load->view("admin_interface/cabinet/profile",$pagevar);
	}
	/***************************************** categories menu **************************************************/
	public function categories(){
		
		$this->load->model('group');
		$pagevar = array(
			'group' => $this->group->getAll(),
			'categories' => array()
		);
		if($parentsCategories = $this->getParentsCategoriesMenu()):
			if($categoriesHierarchy = $this->getHierarchyCategoriesMenu($parentsCategories)):
				$pagevar['categories'] = $categoriesHierarchy;
			endif;
		endif;
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/menu/categories",$pagevar);
	}
	
	public function categoriesGroup(){
		
		$this->load->model('group');
		$pagevar = array(
			'group' => $this->group->getAll(),
		);
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/menu/categories-group",$pagevar);
	}
	
	public function categoriesEditGroup(){
		
		$this->load->model('group');
		$this->load->helper('form');
		$pagevar = array(
			'group' => $this->group->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/menu/edit-category-group",$pagevar);
	}
	
	public function categoriesMenu(){
		
		$this->load->model(array('group','categories'));
		$pagevar = array(
			'group' => $this->group->getAll(),
			'categories' => array()
		);
		if($this->input->get('group') === FALSE || !is_numeric($this->input->get('group'))):
			$pagevar['categories'] = $this->getParentsCategoriesMenu();
		else:
			$pagevar['categories'] = $this->categories->getWhere(NULL,array('group'=>$this->input->get('group')),TRUE);
		endif;
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/menu/categories-menu",$pagevar);
	}
	
	public function addCategoryMenu(){
		
		$this->load->model('group');
		$this->load->helper('form');
		$pagevar = array(
			'group' => $this->group->getAll()
		);
		$this->load->view("admin_interface/menu/add-category-menu",$pagevar);
	}
	
	public function editCategoryMenu(){
		
		$this->load->model(array('group','categories'));
		$this->load->helper('form');
		$pagevar = array(
			'group' => $this->group->getAll(),
			'category' => $this->categories->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/menu/edit-category-menu",$pagevar);
	}
	
	public function categoriesSubMenu(){
		
		$this->load->model('categories');
		$pagevar = array(
			'categories' => $this->getParentsCategoriesMenu(),
			'sub_categories' => array()
		);
		if($this->input->get('category') === FALSE || !is_numeric($this->input->get('category'))):
			$pagevar['sub_categories'] = $this->categories->getWhere(NULL,array('parent >'=>0),TRUE);
		else:
			$pagevar['sub_categories'] = $this->categories->getWhere(NULL,array('parent'=>$this->input->get('category')),TRUE);
		endif;
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/menu/categories-sub-menu",$pagevar);
	}

	public function addCategorySubMenu(){
		
		$this->load->helper('form');
		$pagevar = array(
			'categories' => $this->getParentsCategoriesMenu(),
		);
		$this->load->view("admin_interface/menu/add-sub-category-menu",$pagevar);
	}
	
	public function editCategorySubMenu(){
		
		$this->load->model('categories');
		$this->load->helper('form');
		$pagevar = array(
			'categories' => $this->getParentsCategoriesMenu(),
			'category' => $this->categories->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/menu/edit-category-sub-menu",$pagevar);
	}
	
	/********************************************* menu ********************************************************/
	public function menu(){
		
		if($this->input->get('group') === FALSE || !is_numeric($this->input->get('group')) || $this->input->get('group') > 4):
			redirect(ADMIN_START_PAGE.'/menu?group=1');
		endif;
		$this->load->model('group');
		$pagevar = array(
			'group' => $this->group->getAll(),
			'categories' => array(),
			'menu' => array()
		);
		if($parentsCategories = $this->getParentsCategoriesMenu()):
			if($categoriesHierarchy = $this->getHierarchyCategoriesMenu($parentsCategories)):
				$pagevar['categories'] = $this->TranspondIDtoIndex($categoriesHierarchy);
			endif;
		endif;
		$pagevar['menu'] = $this->getProductsMenu();
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/menu/list",$pagevar);
	}
	
	public function addProductMenu(){
		
		$this->load->model('group');
		$this->load->helper('form');
		$pagevar = array(
			'group' => $this->group->getAll(),
			'categories' => array(),
		);
		if($parentsCategories = $this->getParentsCategoriesMenu()):
			if($categoriesHierarchy = $this->getHierarchyCategoriesMenu($parentsCategories)):
				$pagevar['categories'] = $this->TranspondIDtoIndex($categoriesHierarchy);
			endif;
		endif;
		$this->load->view("admin_interface/menu/add",$pagevar);
	}
	
	public function editProductMenu(){
		
		if($this->input->get('product') === FALSE || !is_numeric($this->input->get('product'))):
			redirect(ADMIN_START_PAGE.'/menu'.getUrlLink());
		endif;
		$this->load->model(array('group','menu'));
		$this->load->helper('form');
		$pagevar = array(
			'group' => $this->group->getAll(),
			'categories' => array(),
			'menu' => $this->menu->getWhere($this->input->get('product'))
		);
		if($parentsCategories = $this->getParentsCategoriesMenu()):
			if($categoriesHierarchy = $this->getHierarchyCategoriesMenu($parentsCategories)):
				$pagevar['categories'] = $this->TranspondIDtoIndex($categoriesHierarchy);
			endif;
		endif;
		$this->load->view("admin_interface/menu/edit",$pagevar);
	}
	
	private function getProductsMenu(){
		
		$menu = array();
		if($this->input->get('group') !== FALSE):
			$this->load->model('menu');
			if($groupMenu = $this->menu->getWhere(NULL,array('group'=>$this->input->get('group')),TRUE)):
				if($this->input->get('category') !== FALSE && is_numeric($this->input->get('category'))):
					$category = $this->input->get('category');
					if($this->input->get('subcategory') !== FALSE):
						$category = $this->input->get('subcategory');
					endif;
					for($i=0;$i<count($groupMenu);$i++):
						if($groupMenu[$i]['category'] == $category):
							$menu[] = $groupMenu[$i];
						endif;
					endfor;
				else:
					$menu = $groupMenu;
				endif;
			endif;
		endif;
		return $menu;
	}
	
	/***********************************************************************************************************/
}