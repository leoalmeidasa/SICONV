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


<title>Sistema Administrativo - Relatórios</title>
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

?>

<form name="seleciona_periodo" id="seleciona_periodo" action="seleciona_relatorio.php" method="POST">


<h3>Selecione o período e o tipo do relatório:</h3>
<hr>
           
<table class="table_adm" cellpadding="5">
	<tr>
		<td colspan="3">
			Data de <input type="text" class="data" name="data_ini" id="data_ini"> | até | <input type="text" class="data" name="data_ate" id="data_ate">
		</td>
	</tr>
	<tr>
		<td colspan="3">
		Tipo do relatório:
		</td>
	</tr>

	<tr>
		<td>
		<input type="radio" name="tipo_relatorio" value="total_v"> Total por Visitante | <input type="radio" name="tipo_relatorio" value="total_l"> Total por Local | <input type="radio" name="tipo_relatorio" value="total"> Completo 
		</td>
	</tr>
	<tr>
		<td>
		<input type="submit" value="Selecionar" style="width: 100%">
		</td>
	</tr>

</table>
<br />
	

<div id="validacao"></div>
<?php



?>

</form>
</div>
</div>

<?php

?>
</body>
</html>