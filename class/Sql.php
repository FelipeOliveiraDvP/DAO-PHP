<?php 

class Sql extends PDO {

	private $conn;

	// metodo construtor
	public function __construct(){
		// string de connexao
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "xyz", "1234");
	}
	// 
	public function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}
	// executa a query 
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}
	//select retorna campo : valor
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>