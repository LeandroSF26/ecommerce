<?php 

session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);            // Habilita o debug

$app->get('/', function() {				// Executa o código quando estiver na raiz do projeto
    
	$page = new Page();					// Método construtor da classe Page adiciona o header da página

	$page->setTpl("index");				// Adiciona o conteúdo da página do site

});

$app->get('/admin', function() {				// Executa o código quando estiver na raiz do projeto
    
	User::verifyLogin();

	$page = new PageAdmin();					// Método construtor da classe Page adiciona o header da página

	$page->setTpl("index");				// Adiciona o conteúdo da página do site

});


$app->get('/admin/login', function(){

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

$app->get('/admin/logout', function(){

	User::logout();

	header("Location: /admin/login");
	exit;
});

$app->run();							// Roda o template

 ?>