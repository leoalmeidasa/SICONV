<?php

session_start();
error_reporting(~E_ALL);


include_once("con_bd.php");
include_once("verifica.php");


if(isset($_POST['data_ini']))
{
$data_ini = $_POST['data_ini'];
$data_ate = $_POST['data_ate'];

$data_query1 = implode("-",array_reverse(explode("/",$data_ini)));
$data_query2 = implode("-",array_reverse(explode("/",$data_ate)));


$relaciona_visitantes2 = mysqli_query($conexao, "select count(c.id_controle_visita) total, c.id_local, l.nome_local from controle_visitas c inner join locais l on c.id_local=l.id_local where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2' group by c.id_local");

while($array2 = mysqli_fetch_array($relaciona_visitantes2))
{

$total2 = $array2['total'];
$nome_local2 = $array2['nome_local'];

$totais2 .= ",['".$nome_local2."',".$total2."]";
}




}
else
{

date_default_timezone_set('America/Porto_Velho');

$data_ini = date("d/m/Y");
$data_ate = date("d/m/Y");

$data_query1 = date("Y-m-d");
$data_query2 = date("Y-m-d");

$relaciona_visitantes2 = mysqli_query($conexao, "select count(c.id_controle_visita) total, c.id_local, l.nome_local from controle_visitas c inner join locais l on c.id_local=l.id_local where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2' group by c.id_local");

while($array2 = mysqli_fetch_array($relaciona_visitantes2))
{

$total2 = $array2['total'];
$nome_local2 = $array2['nome_local'];

$totais2 .= ",['".$nome_local2."',".$total2."]";
}


}



$data = date("d/m/Y");

$data_query = date("Y-m-d");

$relaciona_visitantes = mysqli_query($conexao, "select count(c.id_controle_visita) total, c.id_local, l.nome_local from controle_visitas c inner join locais l on c.id_local=l.id_local where date(c.dt_hr_ent)='$data_query' group by c.id_local");

while($array = mysqli_fetch_array($relaciona_visitantes))
{

$total = $array['total'];
$nome_local = $array['nome_local'];

$totais .= ",['".$nome_local."',".$total."]";
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/estilo-adm.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day']
          <?=$totais?>
          
        ]);
          //titulo do gráfico
        var options = {
          title: 'Visitantes por área :: <?=$data?>',
          pieSliceText: 'value',
          is3D: true,

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day']
          <?=$totais2?>
          
        ]);
          //titulo do gráfico
        var options = {
          title: 'Visitantes por área :: <?=$data_ini?> até <?=$data_ate?>',
          pieSliceText: 'value',
          is3D: true,

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>
<title>Sistema Administrativo - Controle de Visitantes</title>
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

<h3>Acesso Visitante:</h3>
<hr>
<div class="area">
			<video autoplay="true" id="webCamera">
			</video>
			<img id="imagemConvertida"/><br />
			<input  type="hidden" id="base_img" name="base_img"/><br />
			<button type="button" onclick="loadCamera()">Visualizar Câmera</button>
	
			<button type="button" onclick="takeSnapShot()">Tirar Foto</button>
	
			
			<!-- <p id="caminhoImagem" class="caminho-imagem"><a href="" target="_blank"></a></p> -->
			
</div>

<form name="adiciona_visitante" id="adiciona_visitante" action="adiciona_visitante.php" method="POST">

<div id="adiciona_visitante_form" style="float: left; width: 40%; border-right: 1px dashed #000">           
<input type="hidden" id="status" name="status" maxlength="10" size="40" value="entrada_visitante"/>
<table class="table_adm">
	<tr>	
		<td>
			RG:
		</td>
		<td>
			<input type="text" id="doc_visitante" name="doc_visitante" maxlength="10" size="40" onkeypress="return somenteNumeros(event);" onblur="verifica_visitante();"/></td>
</tr>	
<tr>
		<td>
			Nome:
		</td>
		<td>
			<input type="text" id="nome_visitante" name="nome_visitante" maxlength="50" size="40"/>
		</td>
	</tr>
	<tr>
		<td>
			Gênero:
		</td>
		<td>
			<select name="genero" id="genero">
				<option value="Feminino">Feminino</option>
				<option value="Masculino">Masculino</option>
				<option value="Não Definido">Não Definido</option>				
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Telefone:
		</td>
		<td>
			<input type="text" id="tel_visitante" name="tel_visitante" maxlength="13" size="40" onkeypress="return somenteNumeros(event);" onkeyup="mascara(this, '## #####-####')"/>
		</td>
	</tr>	
<tr>
		<td>
			Email:
		</td>
		<td>
			<input type="text" id="email" name="email_visitante" maxlength="50" size="40" onblur="validacaoEmail(adiciona_visitante.email_visitante)"/>
			<br />
			<div id="msg_email"></div>
		</td>
</tr>
<tr>	
		<td>
		<!-- 	Foto: -->
		</td>
		<td>
			<input type="hidden" id="foto_visitante" name="foto_visitante" maxlength="50" size="40"/>
		</td>
</tr>
<tr>	
		<td><br />
			Local de Visita:
		</td><br />
		<td><br />
			<select name="local_visita" id="local_visita">
				<?php
				$rec_locais = mysqli_query($conexao, "select * from locais where ativo='1' order by nome_local ASC");

				while($locais = mysqli_fetch_array($rec_locais))
				{
					?>

					<option value="<?php echo $locais['id_local'];?>"><?php echo $locais['nome_local'];?></option>

					<?php
				}				
				?>
			</select>
			<br />
		</td>
</tr>	
<tr>
	<td colspan="2"><div id="resposta_submit"></div><br />
	<input type="button" class="submit" value="Autorizar Acesso Visitante" style="width: 100%" onclick="submit_verifica();"/>
	</td>
</tr>
		
</table>
</div>

<div id="right" style="float: left; width: 55%; margin-left: 20px">

<div id="grafico1" style="width: 100%;">
 <div id="piechart" style="width: 900px; height: 350px;"></div>
</div>
<br />

</form>
<div id="grafico2" style="width: 100%;">
	<form id="periodo_grafico" method="post" action="visitantes.php">
	<table style="width: 100%">
		<tr>
			<td>Selecionar período: De <input type="text" class="data" name="data_ini" id="data_ini"> | até | <input type="text" class="data" name="data_ate" id="data_ate">
	<input type="submit" value="Selecionar">
</td>
</tr>
</table>
</form>
<div id="piechart2" style="width: 900px; height: 350px;"></div>
</div>


</div>	

<div id="validacao"></div>
<?php


?>


</div>
</div>

<?php

?>
</body>
</html>