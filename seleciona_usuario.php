<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_usuario = $_GET['id_usuario'];

$rec_user = mysqli_query($conexao,"select * from usuarios where id_usuario='$id_usuario'");

$dados_usuarios = mysqli_fetch_array($rec_user);

 $id_usuario = $dados_usuarios["id_usuario"]; 
 $nome_usuario = $dados_usuarios["nome_usuario"]; 
 $tipo_usuario = $dados_usuarios["tipo_usuario"]; 
 $email_usuario = $dados_usuarios["email_usuario"];         
 $usuario = $dados_usuarios["usuario_usuario"];         

?>
<td style="border-bottom: #000 1px dashed"><input type="text" value="<?php echo $dados_usuarios['nome_usuario'];?>" name="nome_usuario_<?php echo $id_usuario;?>" id="nome_usuario_<?php echo $id_usuario;?>"></td>
<td style="text-align: center;border-bottom: #000 1px dashed"><input type="text" value="<?php echo $dados_usuarios['email_usuario'];?>" name="email_usuario_<?php echo $id_usuario;?>" id="email_usuario_<?php echo $id_usuario;?>" onblur="validacaoEmail(email_usuario_<?php echo $id_usuario;?>)">
<br />
			<div id="msg_email"></div>
			</td>
<td style="text-align: center;border-bottom: #000 1px dashed">Login: <input type="text" value="<?php echo $dados_usuarios['usuario_usuario'];?>" name="login_usuario_<?php echo $id_usuario;?>" id="login_usuario_<?php echo $id_usuario;?>"><br />Senha: <input type="password" name="senha_usuario_<?php echo $id_usuario;?>" id="senha_usuario_<?php echo $id_usuario;?>"></td>
<td style="text-align: center;border-bottom: #000 1px dashed">
	<select name="tipo_usuario_<?php echo $id_usuario;?>" id="tipo_usuario_<?php echo $id_usuario;?>">
				<option value="<?php echo $dados_usuarios['tipo_usuario'];?>"><?php echo $dados_usuarios['tipo_usuario'];?></option>
				<option value="adm">Administrativo</option>
				<option value="superadm">Super Administrador</option>
			</select>
<td style="text-align: center;border-bottom: #000 1px dashed"><input type="submit" value="Alterar" onclick="alterar_usuario('<?php echo $id_usuario;?>')"></td>