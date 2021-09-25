<?php
session_start();
error_reporting(~E_ALL);


include_once("con_bd.php");
include_once("verifica.php");



	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");
$html = "";

$data_query1 = $_GET['query1'];
$data_query2 = $_GET['query2'];

$data1 = implode("/",array_reverse(explode("-",$data_query1)));
$data2 = implode("/",array_reverse(explode("-",$data_query2)));

$html .= "<h1>Relatório de Visitas - Total por Local</h1><br />Período: ".$data1." até ".$data2;

$total_locais = mysqli_query($conexao, "select count(c.id_controle_visita) total, l.* from controle_visitas c inner join locais l on l.id_local=c.id_local where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2' group by l.id_local");

$html .= '<table style="font-size: 15px; width: 80%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Local</th>
		<th style="border: #000 1px dashed">Total de Visitas</th>
	</tr>';

$n = "1";

while($locais = mysqli_fetch_array($total_locais))
{

$nome = $locais ["nome_local"];
$total = $locais ["total"];
	
	$html .='<tr>
			<td style="border-bottom: #000 1px dashed">'.$nome.'</td>
			<td style="text-align: center;border-bottom: #000 1px dashed">'.$total.'</td>
		</tr>';
	
$n++;
}

	


$html .='</table>';





	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML
	$dompdf->load_html($html);

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream("Relatório_por_Locais_de_".$data_query1."_ate_".$data_query2,array("Attachment" => false)
	);

?>


<?php

?>