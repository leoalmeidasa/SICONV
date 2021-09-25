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


<h3>Selecione o período do relatório:</h3>
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
<hr class="subitem"> 	

<div id="validacao"></div>

</form>
<?php

$data_ini = $_POST['data_ini'];
$data_ate = $_POST['data_ate'];
$tipo_relatorio = $_POST['tipo_relatorio'];

$data_query1 = implode("-",array_reverse(explode("/",$data_ini)));
$data_query2 = implode("-",array_reverse(explode("/",$data_ate)));


if($tipo_relatorio=='total_v')
{
$relaciona_visitante = mysqli_query($conexao, "select count(c.id_controle_visita) total, v.* from controle_visitas c inner join visitantes v on v.id_visitante=c.id_visitante where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2' group by v.id_visitante");

?>
<input type="hidden" name="query1" id="query1" value="<?php echo $data_query1;?>">
<input type="hidden" name="query2" id="query2" value="<?php echo $data_query2;?>">
<input type="button" value="Exportar Resultado da Consulta" style="max-height: 50px" onclick="pdf_consulta_v();">
<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Nome</th>
		<th style="border: #000 1px dashed">Email</th>
		<th style="border: #000 1px dashed">Documento</th>
		<th style="border: #000 1px dashed">Total de Visitas</th>
	</tr>

	<?php
$n = "1";

while($visitantes = mysqli_fetch_array($relaciona_visitante))
{
	?>
		<tr>
			<td style="border-bottom: #000 1px dashed"><?php echo $visitantes ['nome_visitante'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $visitantes ['email_visitante'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $visitantes ['doc_visitante'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $visitantes ['total'];?></td>
		</tr>
		<?php
$n++;
}

	?>


</table>

<?php
}
else if($tipo_relatorio=='total_l')
{
$total_locais = mysqli_query($conexao, "select count(c.id_controle_visita) total, l.* from controle_visitas c inner join locais l on l.id_local=c.id_local where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2' group by l.id_local");

?>
<input type="hidden" name="query1" id="query1" value="<?php echo $data_query1;?>">
<input type="hidden" name="query2" id="query2" value="<?php echo $data_query2;?>">
<input type="button" value="Exportar Resultado da Consulta" style="max-height: 50px" onclick="pdf_consulta_l();">
<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Local</th>
		<th style="border: #000 1px dashed">Total de Visitas</th>
	</tr>

	<?php
$n = "1";

while($locais = mysqli_fetch_array($total_locais))
{
	?>
		<tr>
			<td style="border-bottom: #000 1px dashed"><?php echo $locais ['nome_local'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $locais ['total'];?></td>
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
$total_locais = mysqli_query($conexao, "select date(c.dt_hr_ent) data_visita, date(c.dt_hr_saida) data_visita_saida, time(c.dt_hr_ent) hora, time(c.dt_hr_saida) hora_saida, v.*, l.*,c.*, u.*  from controle_visitas c inner join locais l on l.id_local=c.id_local inner join visitantes v on c.id_visitante=v.id_visitante inner join usuarios u on u.id_usuario=c.id_usuario_registro where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2'");

?>
<input type="hidden" name="query1" id="query1" value="<?php echo $data_query1;?>">
<input type="hidden" name="query2" id="query2" value="<?php echo $data_query2;?>">
<input type="button" value="Exportar Resultado da Consulta" style="max-height: 50px" onclick="pdf_consulta_c();">
<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Visitante</th>
		<th style="border: #000 1px dashed">Local</th>
		<th style="border: #000 1px dashed">Data Entrada</th>
		<th style="border: #000 1px dashed">Data Saída</th>
		<th style="border: #000 1px dashed">Autorizado por:</th>
		<th style="border: #000 1px dashed">Foto</th>		

	</tr>

	<?php
$n = "1";

while($locais = mysqli_fetch_array($total_locais))
{ 

$data = $locais['data_visita'];

$hora = $locais['hora'];

$data = implode("/",array_reverse(explode("-",$data)));


$data_saida = $locais['data_visita_saida'];

$hora_saida = $locais['hora_saida'];

$data_saida = implode("/",array_reverse(explode("-",$data_saida)));

	?>
		<tr>
			<td style="border-bottom: #000 1px dashed"><?php echo $locais ['nome_visitante'];?></td>
			<td style="border-bottom: #000 1px dashed"><?php echo $locais ['nome_local'];?></td>
			<td style="border-bottom: #000 1px dashed; text-align: center"><?php echo $data." - ".$hora;?></td>
			<td style="border-bottom: #000 1px dashed; text-align: center"><?php echo $data_saida." - ".$hora_saida;?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><?php echo $locais ['nome_usuario'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><img src="snaps/<?php echo $locais ['foto_visitante'];?>" width="150px"></td>			
		</tr>
		<?php
$n++;
}

	?>


</table>

<?php
}




?>

<hr class="subitem">
<br />


</div>
</div>

<?php

?>
</body>
</html>