<?php session_start();
//error_reporting(~E_ALL);
include_once("con_bd.php");
// Recupera o login 
$login = ($_GET["login"]);
// Recupera a senha
$senha = ($_GET["senha"]); 

$senha = md5($senha);

error_reporting(~E_ALL);

$rec_user = mysqli_query($conexao,"select * from usuarios where (email_usuario='$login' or usuario_usuario='$login') and senha_usuario='$senha'");

$valida = mysqli_num_rows($rec_user);

if($valida>0)
{
	echo "1";
}
else
{
	echo "<span style='color: red'>Usuário e senha não encontrados, por favor verifique os dados.</span>";
}


mysqli_close($conexao);
?>