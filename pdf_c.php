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

$html .= "<h1>Relatório de Visitas - Completo</h1><br />Período: ".$data1." até ".$data2;

$total_locais = mysqli_query($conexao, "select date(c.dt_hr_ent) data_visita, date(c.dt_hr_saida) data_visita_saida, time(c.dt_hr_ent) hora, time(c.dt_hr_saida) hora_saida, v.*, l.*,c.*, u.*  from controle_visitas c inner join locais l on l.id_local=c.id_local inner join visitantes v on c.id_visitante=v.id_visitante inner join usuarios u on u.id_usuario=c.id_usuario_registro where date(c.dt_hr_ent) BETWEEN '$data_query1' and '$data_query2'");

$html .= '<table style="font-size: 15px; width: 100%" cellpadding="5" cellspacing="0">
	<tr>
		<th style="border: #000 1px dashed">Visitante</th>
		<th style="border: #000 1px dashed">Local</th>
		<th style="border: #000 1px dashed">Data da Visita</th>
		<th style="border: #000 1px dashed">Data Saída</th>
		<th style="border: #000 1px dashed">Autorizado por:</th>
	</tr>';

$n = "1";

while($locais = mysqli_fetch_array($total_locais))
{ 

$data = $locais['data_visita'];

$hora = $locais['hora'];

$data = implode("/",array_reverse(explode("-",$data)));


$data_saida = $locais['data_visita_saida'];

$hora_saida = $locais['hora_saida'];

$data_saida = implode("/",array_reverse(explode("-",$data_saida)));


$nome_visitante = $locais ['nome_visitante'];
$nome_local = $locais ['nome_local'];
$nome_usuario = $locais ['nome_usuario'];
		$html .='<tr>
			<td style="border-bottom: #000 1px dashed">'.$nome_visitante .'</td>
			<td style="border-bottom: #000 1px dashed">'.$nome_local.'</td>
			<td style="border-bottom: #000 1px dashed; text-align: center">'.$data." - ".$hora.'</td>
			<td style="border-bottom: #000 1px dashed; text-align: center">'.$data_saida." - ".$hora_saida.'</td>
			<td style="text-align: center;border-bottom: #000 1px dashed">'.$nome_usuario.'</td>
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
	$dompdf->stream("Relatório_Completo_de_".$data_query1."_ate_".$data_query2,array("Attachment" => false)
	);

?>


<?php

?>