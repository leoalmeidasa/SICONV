<?php
session_start();
//error_reporting(~E_ALL);
include_once("con_bd.php");

$status = $_POST['status'];


$nome_visitante = $_POST['nome_visitante'];
$email_visitante = $_POST['email_visitante'];
$foto_visitante = $_POST['foto_visitante'];
$doc_visitante = $_POST['doc_visitante'];
$tel_visitante = $_POST['tel_visitante'];
$genero = $_POST['genero'];
$id_local = $_POST['local_visita'];


if($status=='entrada_visitante')
{

$valida_visitante = mysqli_query($conexao, "select * from visitantes where email_visitante='$email_visitante' or doc_visitante='$doc_visitante'");

$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{

$id_visitante = mysqli_fetch_array($valida_visitante);

$id = $id_visitante['id_visitante'];

$atualiza_visitante = mysqli_query($conexao, "update visitantes set nome_visitante='$nome_visitante', email_visitante='$email_visitante' , foto_visitante='$foto_visitante', doc_visitante='$doc_visitante' , telefone_visitante = '$tel_visitante' , genero_visitante = '$genero' where id_visitante='$id'");

$id_visitante = $id;

}
else
{

$adiciona_visitante = mysqli_query($conexao, "insert into visitantes (nome_visitante, email_visitante, foto_visitante, doc_visitante, telefone_visitante, genero_visitante, ativo) values ('$nome_visitante','$email_visitante','$foto_visitante','$doc_visitante','$tel_visitante','$genero','1')");

$id_visitante = mysqli_query($conexao, "select LAST_INSERT_ID() id;");

$rec_id_visitante = mysqli_fetch_array($id_visitante);

$id_visitante = $rec_id_visitante['id'];
}


date_default_timezone_set('America/Porto_Velho');


$data_hora = date("Y-m-d H:i:s");
$id_usuario = $_SESSION["id_usuario"]; 

$adiciona_controle = mysqli_query($conexao, "insert into controle_visitas (id_visitante, id_local, dt_hr_ent, id_usuario_registro) VALUES ('$id_visitante','$id_local','$data_hora','$id_usuario')");

$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{
	echo "<script>alert('Visitante autorizado com sucesso!');
			window.open('visitantes.php','_self');
	</script>";
}
else
{
	echo "<script>alert('O visitante não foi autorizado, tente novamente!');
			window.open('visitantes.php','_self');
	</script>";	
}

}
else
{


$valida_visitante = mysqli_query($conexao, "select * from visitantes where email_visitante='$email_visitante' or doc_visitante='$doc_visitante'");


$valida = mysqli_affected_rows($conexao);


$id_visitante = mysqli_fetch_array($valida_visitante);


$id = $id_visitante['id_visitante'];


$entrada_confere = mysqli_query($conexao, "select * from controle_visitas where id_visitante = '$id' and dt_hr_saida is null order by id_controle_visita DESC LIMIT 1");

$dados = mysqli_fetch_array($entrada_confere);

$id_controle = $dados['id_controle_visita'];


date_default_timezone_set('America/Porto_Velho');


$data_hora = date("Y-m-d H:i:s");

$atualiza_saida_visitante = mysqli_query($conexao, "update controle_visitas set dt_hr_saida = '$data_hora' where id_controle_visita = '$id_controle'");


$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{
	echo "<script>alert('Saída registrada com sucesso!');
			window.open('visitantes.php','_self');
	</script>";
}
else
{
	echo "<script>alert('Saída não registrada, tente novamente!');
			window.open('visitantes.php','_self');
	</script>";	
}

}

?>