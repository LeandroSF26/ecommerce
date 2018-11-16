<?php

namespace Hcode;

class Model{

	private $values = [];								// Variável para armazenar os métodos get e setter

	public function __call($name, $args){

		$method = substr($name, 0, 3);					// Separa o método passado e armazena em $method
		$fieldName = substr($name, 3, strlen($name));	// Separa o campo para o método get ou set

		switch($method)
		{
			case "get":
				return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;
		}

	}

	// Chamada do método set para as informações recebidas do banco de dados
	public function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->{"set" . $key}($value);				//Chama o método set com a informação a ser setada
		}
	}

	// Retorna os métodos gets
	public function getValues(){

		return $this->values;
	}
}

?>