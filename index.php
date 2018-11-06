<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);            // Habilita o debug

$app->get('/', function() {				// Executa o código quando estiver na raiz do projeto
    
	$page = new Page();					// Método construtor da classe Page adiciona o header da página

	$page->setTpl("index");				// Adiciona o conteúdo da página do site

});

$app->get('/admin', function() {				// Executa o código quando estiver na raiz do projeto
    
	$page = new PageAdmin();					// Método construtor da classe Page adiciona o header da página

	$page->setTpl("index");				// Adiciona o conteúdo da página do site

});

$app->run();							// Roda o template

 ?>