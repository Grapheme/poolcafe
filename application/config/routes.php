<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';

/*************************************************** AJAX INTRERFACE ***********************************************/
/******************guest interface ********************/
$route['login-in'] = "ajax_interface/loginIn";
$route['valid/exist-email'] = "ajax_interface/existEmail";
$route['redactor/upload'] = "ajax_interface/redactorUploadImage";
/**************** remove items ********************/
$route['remove/project'] = "ajax_interface/removeItems";
/******************load view ********************/

/*********** news ***************/
$route[ADMIN_START_PAGE.'/news/insert'] = "ajax_interface/insertNews";
$route[ADMIN_START_PAGE.'/news/update/:num'] = "ajax_interface/updateNews";

$route[ADMIN_START_PAGE.'/events/insert'] = "ajax_interface/insertEvent";
$route[ADMIN_START_PAGE.'/events/update/:num'] = "ajax_interface/updateEvent";
/*********** menu ***************/
$route[ADMIN_START_PAGE.'/save-group'] = "ajax_interface/saveGroup";
$route[ADMIN_START_PAGE.'/manage-category'] = "ajax_interface/manageCategory";
$route[ADMIN_START_PAGE.'/menu/insert'] = "ajax_interface/manageMenu";
$route[ADMIN_START_PAGE.'/menu/update'] = "ajax_interface/manageMenu";
$route[ADMIN_START_PAGE.'/menu/remove'] = "ajax_interface/manageMenu";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['clear-session'] = "guests_interface/clearSession";
$route['admin'] = "guests_interface/signIN";
$route['log-off'] = "guests_interface/logoff";
/********** loading resources *************/
$route['loadimage/:any/:num'] = "guests_interface/loadimage";
/*************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/control_panel";
$route[ADMIN_START_PAGE.'/news/edit/:num'] = "admin_interface/editNews";
$route[ADMIN_START_PAGE.'/news/add'] = "admin_interface/addNews";
$route[ADMIN_START_PAGE.'/news/delete/:num'] = "admin_interface/deleteNews";
$route[ADMIN_START_PAGE.'/news(\/:any)*?'] = "admin_interface/news";

$route[ADMIN_START_PAGE.'/events/edit/:num'] = "admin_interface/editEvent";
$route[ADMIN_START_PAGE.'/events/add'] = "admin_interface/addEvent";
$route[ADMIN_START_PAGE.'/events/delete/:num'] = "admin_interface/deleteEvent";
$route[ADMIN_START_PAGE.'/events(\/:any)*?'] = "admin_interface/events";

$route[ADMIN_START_PAGE.'/categories'] = "admin_interface/categories";
$route[ADMIN_START_PAGE.'/menu'] = "admin_interface/menu";
$route[ADMIN_START_PAGE.'/menu/add'] = "admin_interface/addProductMenu";
$route[ADMIN_START_PAGE.'/menu/edit'] = "admin_interface/editProductMenu";