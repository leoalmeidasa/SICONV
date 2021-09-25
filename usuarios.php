<?php

session_start();
error_reporting(~E_ALL);


include_once("con_bd.php");
include_once("verifica.php");


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/estilo-adm.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>


<title>Sistema Administrativo - Controle de Usuário</title>
</head>
<body>
<div id="container">
	<?php
	include("topo.php");
	?>
	<?php
	include("menu-adm.php");
	?>
	<div id="main" class="main">
	<br />	

<?php
if ($_SESSION["tipo_usuario"]=='Super Adm')
{

?>
	
<form name="adiciona_usuario" id="adiciona_usuario" action="adiciona_usuario.php" method="POST">


<h3>Adicionar novo usuário:</h3>
<hr>
           
<table class="table_adm">
	<tr>
		<td>
			Nome:
		</td>
		<td>
			<input type="text" id="nome_usuario" name="nome_usuario" maxlength="50" size="40"/>
		</td>
		</tr>
		<tr>
		<td>
			Email:
		</td>
		<td>
			<input type="text" id="email" name="email_usuario" maxlength="50" size="20" onblur="validacaoEmail(adiciona_usuario.email_usuario)"/><div id="msg_email"></div>
			<br />
		</td>
		</tr>
		<tr>
		<td>
			Login:
		</td>
		<td>
			<input type="text" id="login_usuario" name="login_usuario" maxlength="15" size="15"/>
		</td
		</tr>
		<tr>
		<td>
			Senha:
		</td>
		<td>
			<input type="password" id="senha_usuario" name="senha_usuario" maxlength="10" size="10"/>
		</td
		</tr>
		<tr>
		<td>
			Tipo:
		</td>
		<td>
			<select name="tipo_usuario" id="tipo_usuario">
				<option value="adm">Administrativo</option>
				<option value="superadm">Super Administrador</option>
			</select>
		</td>

	</tr>
		
</table>
<br />
		<input type="button" value="Cadastrar Usuário" onclick="submit_verifica_usuario();"/>

<div id="validacao"></div>
<?php



?>

</form>
<hr class="subitem">
<br />
Usuários
<br />
<?php


$rec_usuarios = mysqli_query($conexao,"select * from usuarios where ativo='1'");


?>

<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Nome</th>
		<th style="border: #000 1px dashed">Email</th>
		<th style="border: #000 1px dashed">Login</th>
		<th style="border: #000 1px dashed">Tipo</th>
		<th style="border: #000 1px dashed">Ações</th>
	</tr>

	<?php
$n = "1";
	while($dados_usuarios = mysqli_fetch_array($rec_usuarios))
	{
		?>
		<tr <?php echo $style;?> id="altera_usuario_<?php echo $dados_usuarios['id_usuario'];?>">
			<td style="border-bottom: #000 1px dashed"><?php echo $dados_usuarios['nome_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['email_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['usuario_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $dados_usuarios['tipo_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><img src="imgs/editar.png" width="30px" style="cursor: pointer;" onclick="seleciona_usuario('<?php echo $dados_usuarios['id_usuario'];?>');"> <img src="imgs/excluir.png" width="30px" style="cursor: pointer;" onclick="excluir_usuario('<?php echo $dados_usuarios['id_usuario'];?>', '<?php echo $dados_usuarios['tipo_usuario'];?>');"></td>
		</tr>
		<?php
$n++;
	}

	?>


</table>

<?php

}
else
{


$id_usuario = $_SESSION["id_usuario"];

$rec_user = mysqli_query($conexao,"select * from usuarios where id_usuario='$id_usuario'");

$dados_usuarios = mysqli_fetch_array($rec_user);

 $id_usuario = $dados_usuarios["id_usuario"]; 
 $nome_usuario = $dados_usuarios["nome_usuario"]; 
 $email_usuario = $dados_usuarios["email_usuario"];         
 $usuario = $dados_usuarios["usuario_usuario"];         


	?>

	<h3>Alteração de dados</h3>



<table class="table_adm" width="auto">
<tr>
	<td>
		Nome: 
	</td>
<td>
	<input type="text" value="<?php echo $dados_usuarios['nome_usuario'];?>" name="nome_usuario_<?php echo $id_usuario;?>" id="nome_usuario_<?php echo $id_usuario;?>"></td>
</tr>
<tr>
	<td>
		Email: 
	</td>

<td style="text-align: center;">
	<input type="text" value="<?php echo $dados_usuarios['email_usuario'];?>" name="email_usuario_<?php echo $id_usuario;?>" id="email" onblur="validacaoEmail(email)"></td>
	<td colspan="2"><div id="msg_email"></div></td>
</tr><tr>
<td>
		Login:
</td>
<td style="text-align: center;">
<input type="text" value="<?php echo $dados_usuarios['usuario_usuario'];?>" name="login_usuario_<?php echo $id_usuario;?>" id="login_usuario_<?php echo $id_usuario;?>"></td>
</tr>
<tr>
<td>
		Senha:
</td>
	<td>
 <input type="password" name="senha_usuario_<?php echo $id_usuario;?>" id="senha_usuario_<?php echo $id_usuario;?>">
</td>
</tr>
<tr><td colspan="2" style="text-align: center;"><input type="submit" value="Alterar" onclick="alterar_usuario_individual('<?php echo $id_usuario;?>')" style="width: 100%"></td>	
</tr>
	
		
</table>


	<?php 
}
?>

</div>
</div>

<?php

?>
</body>
</html>
