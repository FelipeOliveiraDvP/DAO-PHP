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

/* Fazendo login no sistema */
$usuario = new Usuario();
$usuario->login("Joao", "guest555");

echo $usuario;
 ?>