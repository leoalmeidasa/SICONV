<?php

session_start();
error_reporting(~E_ALL);


include_once("con_bd.php");
include_once("verifica.php");

$data = date("d/m/Y");

$data_query = date("Y-m-d");

$relaciona_visitantes = mysqli_query($conexao, "select count(c.id_controle_visita) total, c.id_local, l.nome_local from controle_visitas c inner join locais l on c.id_local=l.id_local where date(c.dt_hr_ent)='$data_query' group by c.id_local");

while($array = mysqli_fetch_array($relaciona_visitantes))
{

$total = $array['total'];
$nome_local = $array['nome_local'];

$totais .= ",['".$nome_local."',".$total."]";
}


$data_query2 = date("Y-m-d");

$relaciona_visitantes2 = mysqli_query($conexao, "select count(c.id_controle_visita) total, c.id_local, l.nome_local from controle_visitas c inner join locais l on c.id_local=l.id_local where date(c.dt_hr_ent) BETWEEN '$data_query' and '$data_query' group by c.id_local");

while($array2 = mysqli_fetch_array($relaciona_visitantes2))
{

$total2 = $array2['total'];
$nome_local2 = $array2['nome_local'];

$totais2 .= ",['".$nome_local2."',".$total2."]";
}


?>

<link href="css/estilo-adm.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
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
          title: 'Visitantes por área :: <?=$data?>',
          pieSliceText: 'value',
          is3D: true,

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>

	<table style="width: 100%">
		<tr>
			<td>Selecionar período: De <input type="text" class="data" name="data_ini" id="data_ini"> | até | <input type="text" class="data" name="data_ate" id="data_ate">
	<input type="button" value="Selecionar" onclick="seleciona_periodo_grafico();">
</td>
</tr>
</table>
<div id="piechart2" style="width: 900px; height: 350px;"></div>
<?php


?>


<?php

?>
