<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	$config = array(
		'signin' =>array(
			array('field'=>'login','label'=>'Логин','rules'=>'required|trim'),
			array('field'=>'password','label'=>'Пароль','rules'=>'required|trim')
		),
		'news' =>array(
			array('field'=>'title','label'=>'Название','rules'=>'required|trim'),
			array('field'=>'anonce','label'=>'Анонс новости','rules'=>'required|trim'),
			array('field'=>'content','label'=>'Текст новости','rules'=>'required|trim'),
			array('field'=>'date','label'=>'Дата','rules'=>'required|trim')
		),
		'event' =>array(
			array('field'=>'category','label'=>'Категория','rules'=>'required|trim'),
			array('field'=>'title','label'=>'Название','rules'=>'required|trim'),
			array('field'=>'tags','label'=>'Теги','rules'=>'trim'),
			array('field'=>'anonce','label'=>'Анонс события','rules'=>'required|trim'),
			array('field'=>'content','label'=>'Текст события','rules'=>'required|trim'),
			array('field'=>'age','label'=>'Возраст','rules'=>'required|trim'),
			array('field'=>'time','label'=>'Время проведения','rules'=>'trim'),
			array('field'=>'price','label'=>'Цена','rules'=>'trim'),
			array('field'=>'date','label'=>'Дата','rules'=>'required|trim')
		)
	);
?>