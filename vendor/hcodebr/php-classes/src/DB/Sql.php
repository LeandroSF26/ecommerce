<?php 

namespace Hcode\DB;

class Sql {

	const HOSTNAME = "127.0.0.1";					
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "db_ecommerce";

	private $conn;														// Variável de conexão

	// Método construtor
	public function __construct()
	{
		
		$this->conn = new \PDO("mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, Sql::USERNAME,Sql::PASSWORD);  // Conexão com o banco de dados
	}

	// Seta os valores recebidos em cada variavel atrávés do bindParam
	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	// Adiciona os valores recebidos em cada parametro a ser adicionando no banco de dados
	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);							// Seta o valor recebido em cada variavel recebida

	}

	// Recebe a query a ser executada e seus respectivos parametros
	public function query($rawQuery, $params = array())
	{
		
		$stmt = $this->conn->prepare($rawQuery);						// Prepara a query para execução
		
		$this->setParams($stmt, $params);								// Chama o método para setar os parâmetros nas respectivas variaveis
		
		$stmt->execute();												// Executa a query

	}

	// Faz o select da query 
	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>