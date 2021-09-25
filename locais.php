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


<title>Sistema Administrativo - Controle de Locais</title>
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
<form name="adiciona_local" id="adiciona_local" action="adiciona_local.php" method="POST">


<h3>Adicionar novo local:</h3>
<hr>
           
<table class="table_adm">
	<tr>
		<td>
			Nome Local:
		</td>
		<td>
			<input type="text" id="nome_local" name="nome_local" maxlength="50" size="40"/>
		</td>
		
	</tr>
		
</table>
<br />
		<input type="button" value="Cadastrar Novo Local" onclick="submit_verifica_local();"/>

<div id="validacao"></div>
<?php



?>

</form>
<hr class="subitem">
<br />
Usuários
<br />
<?php


$rec_local = mysqli_query($conexao,"select * from locais where ativo='1'");


?>

<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Nome</th>
		<th style="border: #000 1px dashed">Ações</th>
	</tr>

	<?php
$n = "1";
	while($dados_local = mysqli_fetch_array($rec_local))
	{
		?>
		<tr <?php echo $style;?> id="altera_local_<?php echo $dados_local['id_local'];?>">
			<td style="border-bottom: #000 1px dashed"><?php echo $dados_local['nome_local'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><img src="imgs/editar.png" width="30px" style="cursor: pointer;" onclick="seleciona_local('<?php echo $dados_local['id_local'];?>');"> <img src="imgs/excluir.png" width="30px" style="cursor: pointer;" onclick="excluir_local('<?php echo $dados_local['id_local'];?>');"></td>
		</tr>
		<?php
$n++;
	}

	?>


</table>


</div>
</div>

<?php

?>
</body>
</html>