<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$nome_local = $_POST['nome_local'];


$adiciona_canal = mysqli_query($conexao, "insert into locais (nome_local, ativo) values ('$nome_local', '1')");


$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{
	echo "<script>alert('Local cadastrado com sucesso!');
			window.open('locais.php','_self');
	</script>";
}
else
{
	echo "<script>alert('O local não foi cadastrado, tente novamente!');
			window.open('locais.php','_self');
	</script>";
}

?>