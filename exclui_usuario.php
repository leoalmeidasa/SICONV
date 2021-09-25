<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_usuario = $_GET['id_usuario'];

$exclui_usuario = mysqli_query($conexao, "update usuarios set ativo=0 where id_usuario='$id_usuario'");


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