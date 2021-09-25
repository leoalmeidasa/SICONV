<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");
// Recupera o login 
$login = ($_GET["login"]);

error_reporting(~E_ALL);

$rec_user = mysqli_query($conexao,"select * from usuarios where (email_usuario='$login' or usuario_usuario='$login') and ativo='1'");

$valida = mysqli_num_rows($rec_user);

if($valida>0)
{
	echo "1";
}
else
{
	echo "<span style='color: red'>Email ou login não cadastrado em nossa base de dados. Por favor contate o administrador do sistema.</span>";
}


mysqli_close($conexao);
?>