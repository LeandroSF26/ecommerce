<?php

namespace Hcode;

use Rain\Tpl;

class Page{

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	// Método construtor seta o header da página
	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts);      

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,       		// Local onde é armazenado os templates
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/", 	// Local onde é armazenado o cache da página
			"debug"         => false
		);

		Tpl::configure( $config );												// Configura o local dos templates e cache das páginas

		$this->tpl = new Tpl;			

		$this->setData($this->options["data"]);								 

		if($this->options["header"] === true){									// Verifica se tem um header para desenhar
			$this->tpl->draw("header");											// Desenha o header da página principal
		}

	}

	// Cria uma assinatura para passar os dados para o template
	private function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	// Seta o conteúdo da página
	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML); 							// Desenha o conteúdo da página principal

	}

	// Seta o rodapé da página
	public function __destruct(){

		if($this->options["footer"] === true){									// Verificar se tem um footer para desenhar
			$this->tpl->draw("footer");											// Desenha o conteúdo do rodapé
		}
	}
}

?>