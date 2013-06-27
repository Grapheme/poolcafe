<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function existEmail(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$statusval = array('status'=>FALSE);
		if($parametr = trim($this->input->post('parametr'))):
			if(!$this->accounts->search('email',$parametr)):
				$statusval['status'] = TRUE;
			endif;
		else:
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	private function splitPostData($data){
		
		$result = array();
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$temp = preg_split("/=/",$data[$i]);
			$result[$temp[0]] = $temp[1];
		endfor;
		if(!empty($result)):
			return $result;
		else:
			return FALSE;
		endif;
	}
	
	public function redactorUploadImage(){
		
		$uploadPath = getcwd().'/download/';
		$fileName = $this->uploadSingleImage($uploadPath);
		$file = array(
			'filelink'=>base_url('download/'.$fileName)
		);
		echo stripslashes(json_encode($file));
	}
	/******************************************** guests interface *******************************************************/
	
	public function loginIn(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signin') == TRUE):
			if($user = $this->accounts->authentication($this->input->post('login'),$this->input->post('password'))):
				if($user['active']):
					$account = json_encode(array('id'=>$user['id']));
					$this->session->set_userdata(array('logon'=>md5($this->input->post('login')),'account'=>$account));
					$json_request['redirect'] = site_url(ADMIN_START_PAGE);
					$json_request['status'] = TRUE;
				else:
					$json_request['responseText'] = 'Аккаунт не активирован';
				endif;
			else:
				$json_request['responseText'] = 'Неверный логин или пароль';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}

	/********************************************* admin interface *******************************************************/
	
	public function insertNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('news') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($newsID = $this->ExecuteCreatingNews($_POST)):
			if($this->uploadNewsPhoto($newsID)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Новость добавлена';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/news');
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function updateNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('news') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingNews($this->uri->segment(4),$_POST)):
			$json_request['responsePhotoSrc'] = $this->uploadNewsPhoto($this->uri->segment(4));
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Новость cохранена';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/news');
		endif;
		echo json_encode($json_request);
	}
	
	public function insertEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('event') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($eventID = $this->ExecuteCreatingEvent($_POST)):
			if($this->CropToSquare(array('filepath'=>$_FILES['photo']['tmp_name'],'edgeSize'=>500))):
				
			endif;
			if($this->uploadEventPhoto($eventID)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Cобытие добавлено';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/events');
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function updateEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('event') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingEvent($this->uri->segment(4),$_POST)):
			if($this->CropToSquare(array('filepath'=>$_FILES['photo']['tmp_name'],'edgeSize'=>500))):
				$json_request['responsePhotoSrc'] = $this->uploadEventPhoto($this->uri->segment(4));
				$json_request['status'] = TRUE;
			endif;
			$json_request['responseText'] = 'Событие cохранено';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/events');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteCreatingNews($post){
		
		/**************************************************************************************************************/
		$news = array("title"=>$post['title'],"anonce"=>$post['anonce'],"content"=>$post['content'],'date_publish'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']));
		/**************************************************************************************************************/
		if($newsID = $this->insertItem(array('insert'=>$news,'translit'=>$news['title'],'model'=>'news'))):
			return $newsID;
		endif;
		return FALSE;
	}
	
	private function ExecuteUpdatingNews($id,$post){
		
		/**************************************************************************************************************/
		$news = array("id"=>$id,"title"=>$post['title'],"anonce"=>$post['anonce'],"content"=>$post['content'],'translit'=>$post['title'],'date_publish'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']));
		/**************************************************************************************************************/
		$this->updateItem(array('update'=>$news,'translit'=>$news['title'],'model'=>'news'));
		return TRUE;
	}
	
	private function ExecuteCreatingEvent($post){
		
		/**************************************************************************************************************/
		$event = array("category"=>$post['category'],"title"=>$post['title'],"tags"=>$post['tags'],"anonce"=>$post['anonce'],"content"=>$post['content'],"age"=>$post['age'],"time"=>$post['time'],"price"=>$post['price'],'date_publish'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']));
		/**************************************************************************************************************/
		if($newsID = $this->insertItem(array('insert'=>$event,'translit'=>$event['title'],'model'=>'events'))):
			return $newsID;
		endif;
		return FALSE;
	}
	
	private function ExecuteUpdatingEvent($id,$post){
		
		/**************************************************************************************************************/
		$event = array("id"=>$id,"category"=>$post['category'],"title"=>$post['title'],"tags"=>$post['tags'],"anonce"=>$post['anonce'],"content"=>$post['content'],"age"=>$post['age'],"time"=>$post['time'],"price"=>$post['price'],'date_publish'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']));
		/**************************************************************************************************************/
		$this->updateItem(array('update'=>$event,'translit'=>$event['title'],'model'=>'events'));
		return TRUE;
	}
	
	private function uploadEventPhoto($eventID){
		
		if(isset($_FILES['photo'])):
			if($_FILES['photo']['error'] != 4):
				if($photo = file_get_contents($_FILES['photo']['tmp_name'])):
					$this->load->model('events');
					$this->events->updateField($eventID,'photo',$photo);
					$this->load->helper('string');
					return site_url('loadimage/events/'.$eventID.'?'.random_string('alpha',5));
				endif;
			endif;
		endif;
		return FALSE;
	}

	private function uploadNewsPhoto($newsID){
		
		if(isset($_FILES['photo'])):
			if($_FILES['photo']['error'] != 4):
				if($photo = file_get_contents($_FILES['photo']['tmp_name'])):
					$this->load->model('news');
					$this->news->updateField($newsID,'photo',$photo);
					$this->load->helper('string');
					return site_url('loadimage/news/'.$newsID.'?'.random_string('alpha',5));
				endif;
			endif;
		endif;
		return FALSE;
	}

	/* -------------------------------------------------------------- */

	public function saveGroup(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->postDataValidation('update_menu_title') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingGroupMenu($this->input->post('id'),$this->input->post('title')) !== FALSE):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Сохранено';
		endif;
		echo json_encode($json_request);
	}
	
	public function manageCategory(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->input->get('mode') == 'update'):
			if($this->postDataValidation('update_menu_title') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			if($this->ExecuteUpdatingCategoryMenu($this->input->post('id'),$this->input->post('title')) !== FALSE):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Сохранено';
			endif;
		elseif($this->input->get('mode') == 'insert'):
			if($this->postDataValidation('insert_menu_title') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			if($categoryID = $this->ExecuteInsertCategoryMenu($this->input->post('parent'),$this->input->post('title'))):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = '<li data-item="'.$categoryID.'">';
				if($this->input->post('parent') == 0):
					$json_request['responseText'] .= '<span class="title view-subcategory text-info">'.$this->input->post('title').'</span>';
				else:
					$json_request['responseText'] .= '<span class="title">'.$this->input->post('title').'</span>';
				endif;
				$json_request['responseText'] .= '<button class="btn btn-link edit-category-menu"><i class="icon-edit"></i></button>';
				$json_request['responseText'] .= '<button class="btn btn-link remove-category-menu"><i class="icon-remove"></i></button>';
				if($this->input->post('parent') == 0):
					$json_request['responseText'] .= '<ul class="ul-children hidden" data-parent="'.$categoryID.'">';
					$json_request['responseText'] .= '<li class="li-parent">';
					$json_request['responseText'] .= '<input type="text" class="input-title" name="category" placeholder="Добавить подкатегорию">';
					$json_request['responseText'] .= '<button class="btn btn-link save-category-menu"><i class="icon-plus-sign"></i></button>';
					$json_request['responseText'] .= '</li>';
					$json_request['responseText'] .= '</ul>';
				endif;
				$json_request['responseText'] .= '</li>';
			endif;
		elseif($this->input->get('mode') == 'remove'):
			if($this->postDataValidation('remove_menu_title') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			$this->load->model('categories');
			if($category = $this->categories->getWhere($this->input->post('id'))):
				if($category['parent'] == 0):
					$this->deleteProductsMenu(NULL,$category['id']);
					$this->categories->delete(NULL,array('parent'=>$category['id']));
				endif;
				$this->categories->delete($this->input->post('id'));
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Удалено';
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function manageMenu(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->uri->segment(3) == 'insert'):
			if($this->postDataValidation('insert_product_menu') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			if($productID = $this->ExecuteCreatingProductMenu($_POST)):
				$json_request['responsePhotoSrc'] = $this->uploadProductMenuPhoto($productID);
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Сохранено';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/menu'.getUrlLink());
			endif;
		elseif($this->uri->segment(3) == 'update'):
			if($this->postDataValidation('update_product_menu') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			if($this->ExecuteUpdatingProductMenu($_POST) !== FALSE):
				$json_request['responsePhotoSrc'] = $this->uploadProductMenuPhoto($this->input->get('product'));
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Сохранено';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/menu'.getUrlLink());
			endif;
		elseif($this->uri->segment(3) == 'remove'):
			if($this->postDataValidation('remove_product_menu') === FALSE):
				$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
				echo json_encode($json_request);
				return FALSE;
			endif;
			if($this->deleteProductsMenu($this->input->post('id')) !== FALSE):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Удалено';
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	private function deleteProductsMenu($id = NULL,$category = NULL){
		
		$this->load->model('menu');
		if(!is_null($id)):
			$this->menu->delete($id);
			return TRUE;
		endif;
		if(!is_null($category)):
			if($childCategories = $this->categories->getWhere(NULL,array('parent'=>$category),TRUE)):
				$categoryIDs = $this->getValuesInArray($childCategories);
				$this->menu->deleteWhereIN(array('field'=>'category','where_in'=>$categoryIDs));
			endif;
			$this->menu->delete(NULL,array('category'=>$category));
			return TRUE;
		endif;
		return FALSE;
	}
	
	private function ExecuteUpdatingGroupMenu($id,$title){
		
		/**************************************************************************************************************/
		$group = array("id"=>$id,"title"=>$title);
		/**************************************************************************************************************/
		$this->updateItem(array('update'=>$group,'model'=>'group'));
		return TRUE;
	}
	
	private function ExecuteUpdatingCategoryMenu($id,$title){
		
		/**************************************************************************************************************/
		$category = array("id"=>$id,"title"=>$title);
		/**************************************************************************************************************/
		$this->updateItem(array('update'=>$category,'model'=>'categories'));
		return TRUE;
	}
	
	private function ExecuteInsertCategoryMenu($parent,$title){
		
		/**************************************************************************************************************/
		$category = array("title"=>$title,'parent'=>$parent);
		/**************************************************************************************************************/
		return $this->insertItem(array('insert'=>$category,'model'=>'categories'));
	}
	
	private function ExecuteCreatingProductMenu($post){
		
		/**************************************************************************************************************/
		$product = array("group"=>$this->input->get('group'),'category'=>0,'property'=>$post['property'],'photo_exist'=>0,'price'=>$post['price'],'title'=>$post['title'],'description'=>$post['description']);
		/**************************************************************************************************************/
		if($this->input->get('category') !== FALSE):
			$product['category'] = $this->input->get('category');
			if($this->input->get('subcategory') !== FALSE):
				$product['category'] = $this->input->get('subcategory');
			endif;
			if($productID = $this->insertItem(array('insert'=>$product,'model'=>'menu'))):
				return $productID;
			endif;
		endif;
		return FALSE;
	}
	
	private function uploadProductMenuPhoto($productID){
		
		if(isset($_FILES['photo'])):
			if($_FILES['photo']['error'] != 4):
				if($photo = file_get_contents($_FILES['photo']['tmp_name'])):
					$this->load->model('menu');
					$this->menu->updateField($productID,'photo',$photo);
					$this->menu->updateField($productID,'photo_exist',1);
					$this->load->helper('string');
					return site_url('loadimage/menu/'.$productID.'?'.random_string('alpha',5));
				endif;
			endif;
		endif;
		return FALSE;
	}
	
	private function ExecuteUpdatingProductMenu($post){
		
		/**************************************************************************************************************/
		$product = array("id"=>$this->input->get('product'),"group"=>0,'category'=>0,'property'=>$post['property'],'title'=>$post['title'],'price'=>$post['price'],'description'=>$post['description']);
		/**************************************************************************************************************/
		if($this->input->get('product') !== FALSE && $this->input->get('group') !== FALSE):
			$product['group'] = $this->input->get('group');
			if($this->input->get('category') !== FALSE):
				$product['category'] = $this->input->get('category');
				if($this->input->get('subcategory') !== FALSE):
					$product['category'] = $this->input->get('subcategory');
				endif;
				$this->updateItem(array('update'=>$product,'model'=>'menu'));
				return TRUE;
			endif;
		endif;
		return FALSE;
	}
	
	/* -------------------------------------------------------------- */
}