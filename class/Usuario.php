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
	// popula os atributos do objeto
	private function setData($data){
	
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));		
	}
	// carrega um registro no banco atraves de um id
	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE IDUSUARIO = :ID",array(':ID'=>$id));
		
		if (isset($results[0])) {

			$this->setData($results[0]);
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

			$this->setData($results[0]);

		}else{
			throw new Exception("Login ou Senha invalidos");			
		}
	}
	// inserindo dados atraves de procedures
	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_insert_usuario(:LOGIN, :PASS)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASS'=>$this->getDessenha()
		));

		if (isset($results[0])) {
			
			$this->setData($results[0]);

		}
	}
	// Atualizando no banco
	public function update($login, $pass){
		$this->setDeslogin($login);
		$this->setDessenha($pass);

		$sql = new Sql();
		$sql->query("UPDATE TB_USUARIOS SET deslogin=:LOGIN, dessenha=:PASS WHERE idusuario=:ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASS'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
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