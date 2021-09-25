<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_local = $_GET['id_local'];

$exclui_local = mysqli_query($conexao, "update locais set ativo=0 where id_local='$id_local'");


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