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
		if($this->ExecuteCreatingNews($_POST) !== FALSE):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Новость добавлена';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/news');
		endif;
		echo json_encode($json_request);
	}
	
	public function updateNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('news') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingNews($this->uri->segment(4),$_POST)):
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
		if($this->ExecuteCreatingEvent($_POST) !== FALSE):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Cобытие добавлено';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/events');
		endif;
		echo json_encode($json_request);
	}
	
	public function updateEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('event') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingEvent($this->uri->segment(4),$_POST)):
			$json_request['status'] = TRUE;
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
	
}