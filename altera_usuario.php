<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_usuario = $_GET['id_usuario'];
$nome_usuario = $_GET['nome'];
$email_usuario = $_GET['email'];
$login_usuario = $_GET['login'];
$senha_usuario = $_GET['senha'];
$tipo_usuario = $_GET['tipo'];


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

$altera_usuario = mysqli_query($conexao,"update usuarios set nome_usuario='$nome_usuario',email_usuario='$email_usuario',usuario_usuario='$login_usuario',$altera_senha,tipo_usuario='$tipo_usuario' where id_usuario='$id_usuario'");


$rec_user = mysqli_query($conexao,"select * from usuarios where id_usuario='$id_usuario'");

$dados_usuarios = mysqli_fetch_array($rec_user);

 $id_usuario = $dados_usuario["id_usuario"]; 
 $nome_usuario = $dados_usuario["nome_usuario"]; 
 $tipo_usuario = $dados_usuario["tipo_usuario"]; 
 $email_usuario = $dados_usuario["email_usuario"];         
 $usuario = $dados_usuario["usuario_usuario"];         

?>
<td style="border-bottom: #000 1px dashed"><?php echo $dados_usuarios['nome_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['email_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['usuario_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['tipo_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><img src="imgs/editar.png" width="30px" style="cursor: pointer;" onclick="seleciona_usuario('<?php echo $dados_usuarios['id_usuario'];?>');"> <img src="imgs/excluir.png" width="30px" style="cursor: pointer;" onclick="excluir_usuario('<?php echo $dados_usuarios['id_usuario'];?>', '<?php echo $dados_usuarios['tipo_usuario'];?>');"></td>