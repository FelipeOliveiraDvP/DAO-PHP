<?php 
require_once 'config.php';
/* carregando um usuario
$user = new Usuario();
$user->loadById(2);
echo $user;
*/

/*Carregando uma lista de usuarios
$lista = Usuario::getList();
echo json_encode($lista);
*/

/* carrega uma lista buscando pelo login 
$search = Usuario::search("pe");
echo json_encode($search);
*/

/* Fazendo login no sistema 
$usuario = new Usuario();
$usuario->login("Joao", "guest555");

echo $usuario;
*/

/* inserindo um usuario novo no banco 
$aluno = new Usuario();
$aluno->setDeslogin("Aluno2");
$aluno->setDessenha("abc4455");
$aluno->insert();

echo $aluno;
*/

/* ATualizando um registro no banco */
$user = new Usuario();
$user->loadById(2);
$user->update("Professor","guest66998");

echo $user;
 ?>