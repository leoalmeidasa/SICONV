<?php


//session_start();
//error_reporting(~E_ALL);
include_once("con_bd.php");

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/estilo-adm.css" rel="stylesheet">
<link href="css/estilo-login.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>
<title>Sistema :: Controle de Visitantes</title>
</head>
<body style="background-size: cover; height:100%;">

<div id="container">
	<div id="main">
		<div id="login-sistema">
			<form id="login-adm" name="login-adm" action="login_usuario.php" method="POST">
				<p style="text-align: center"><strong>Sistema de Controle de Visitantes</strong></p>
				<br />
				Usuário: <input type="text" id="login" name="login"/><br /><br />				
				Senha: <input type="password" id="senha" name="senha" /><br />
				<p><a href="recupera_senha.php">Esqueci minha senha</a></p>
				<input class="btn_sbmt_adm" type="button" value="Entrar" onclick="valida_login()"/>
				<div id="result_login"></div>				


			</form>
		</div>

	</div>
</div>

<?php

?>
</body>
</html>
