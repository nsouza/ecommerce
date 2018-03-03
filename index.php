<?php 
session_start();
require_once("vendor/autoload.php");


ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(E_ALL);



use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
	
	$page = new Page();

	$page->setTpl("index");

});

$app->get('/admin', function() {
	
	User::verifyLogin();


	$page = new PageAdmin();

	$page->setTpl("index");

});


$app->get('/admin/login', function() {
	
	$page = new PageAdmin([
            "header"=>false,
            "footer"=>false
        ]);

	$page->setTpl("login");

});

$app->post('/admin/login', function(){
	User::login($_POST["login"], $_POST["password"]);
	header("Location: /admin");
	exit;
});


$app->get('/admin/logout', function()
{
	User::logout();
	header("Location: /admin/login");
	exit;
});

$app->get('/admin/users',function(){

	User::verifyLogin();
	$page = new PageAdmin();

	$users = User::listAll();

	$page->setTpl("users", array(
		"users"=>$users
	));
	
});

$app->get('/admin/users/create',function(){

	User::verifyLogin();
	$page = new PageAdmin();

	$page->setTpl("users-create");
	
});

$app->get('/admin/users/:iduser/delete',function($iduser){

	User::verifyLogin();
});

$app->get('/admin/users/:iduser',function($iduser){

	User::verifyLogin();
	$page = new PageAdmin();

	$page->setTpl("users-update");
	
});

$app->post('/admin/users/create',function(){

	User::verifyLogin();
	
});

$app->post('/admin/users/:iduser',function($iduser){

	User::verifyLogin();
});




$app->run();

 ?>



