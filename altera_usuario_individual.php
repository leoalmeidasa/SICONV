<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_usuario = $_GET['id_usuario'];
$nome_usuario = $_GET['nome'];
$email_usuario = $_GET['email'];
$login_usuario = $_GET['login'];
$senha_usuario = $_GET['senha'];


if($tipo_usuario=='adm'){
	$tipo_usuario = 'Administrativo';
}
else if($tipo_usuario=='superadm'){
	$tipo_usuario = 'Super Adm';	
}

if($senha_usuario=='')
{
	$altera_senha = '';
}
else
{
	$senha_usuario = md5($senha_usuario);
	$altera_senha = "senha_usuario='$senha_usuario'";
}

$altera_usuario = mysqli_query($conexao,"update usuarios set nome_usuario='$nome_usuario',email_usuario='$email_usuario',usuario_usuario='$login_usuario',$altera_senha where id_usuario='$id_usuario'");



$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{
	echo "1";
}
else
{
	echo "0";	
}

?>
