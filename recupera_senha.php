<?php


session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/estilo-adm.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>
<title>Sistema :: Controle de Visitantes</title>
</head>
<body style="background-color: #C0C0C0">

<div id="container">
	<div id="main">
		<div id="login-sistema">
			<form id="login-adm-rec" name="login-adm-rec" action="rec_login_usuario.php" method="POST">
				<p style="text-align: center"><strong>Recuperação de senha</strong></p>
				<br />
				<span style="font-size: 0.9em">Digite seu Email:</span><br /><input type="text" id="login" name="login" />			

				<input class="btn_sbmt_adm" type="button" value="Recuperar senha!" onclick="recupera_valida_login()"/>
				<div id="result_login"></div>				
				<p><a href="index.php">Voltar</a></p>

			</form>
		</div>

	</div>
</div>

<?php

?>
</body>
</html>