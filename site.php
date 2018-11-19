<?php

use \Hcode\PageAdmin;

// Rota para raiz do projeto
$app->get('/', function() {				
    
	$page = new Page();					// Método construtor da classe Page adiciona o header da página

	$page->setTpl("index");				// Adiciona o conteúdo da página do sistema

});



?>