<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$nome_usuario = $_POST['nome_usuario'];
$email_usuario = $_POST['email_usuario'];
$login_usuario = $_POST['login_usuario'];
$senha_usuario = $_POST['senha_usuario'];
$tipo_usuario = $_POST['tipo_usuario'];

if($tipo_usuario=='adm'){
	$tipo_usuario = 'Administrativo';
}
else if($tipo_usuario=='superadm'){
	$tipo_usuario = 'Super Adm';	
}


$adiciona_canal = mysqli_query($conexao, "insert into usuarios (nome_usuario, email_usuario, usuario_usuario, senha_usuario, tipo_usuario, ativo) values ('$nome_usuario','$email_usuario','$login_usuario','$senha_usuario','$tipo_usuario','1')");


$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{
	echo "<script>alert('Usuário cadastrado com sucesso!');
			window.open('usuarios.php','_self');
	</script>";
}
else
{
	echo "<script>alert('O usuário não foi cadastrado, tente novamente!');
			window.open('usuarios.php','_self');
	</script>";	
}

?>