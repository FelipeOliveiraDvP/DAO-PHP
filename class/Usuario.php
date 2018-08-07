<?php 

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	// getters setters
	public function getIdusuario()
	{
	    return $this->idusuario;
	}
	 
	public function setIdusuario($idusuario)
	{
	    $this->idusuario = $idusuario;	    
	}

	public function getDeslogin()
	{
	    return $this->deslogin;
	}
	 
	public function setDeslogin($deslogin)
	{
	    $this->deslogin = $deslogin;	    
	}

	public function getDessenha()
	{
	    return $this->dessenha;
	}
	 
	public function setDessenha($dessenha)
	{
	    $this->dessenha = $dessenha;	    
	}

	public function getDtcadastro()
	{
	    return $this->dtcadastro;
	}
	 
	public function setDtcadastro($dtcadastro)
	{
	    $this->dtcadastro = $dtcadastro;	    
	}
	//------------------------------------------------
	//Metodos da classe
	// carrega um registro no banco atraves de um id
	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE IDUSUARIO = :ID",array(':ID'=>$id));
		
		if (isset($results[0])) {
			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
	// listando usuarios
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY deslogin");
	}
	// pesquisando valores
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM TB_USUARIOS WHERE deslogin LIKE :SEARCH",array(
			':SEARCH'=>"%".$login."%"
		));
	}
	// sistema de login basico
	public function login($login,$password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE deslogin=:LOGIN AND dessenha=:PASS",array(
			':LOGIN'=>$login,
			':PASS'=>$password
		));
		if (isset($results[0])) {
			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}else{
			throw new Exception("Login ou Senha invalidos");			
		}

	}
	// To string
	public function __toString(){

		return json_encode(array(
			'idusuario'=>$this->getIdusuario(),
			'deslogin'=>$this->getDeslogin(),
			'dessenha'=>$this->getDessenha(),
			'dtcadastro'=>$this->getDtcadastro()->format("d/m/Y")
		));
	}

}

 ?>