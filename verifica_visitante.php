<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$email_visitante = $_GET['email'];
$doc_visitante = $_GET['doc'];
$nome_visitante = $_GET['nome_visitante'];
$foto_visitante = $_GET['foto_visitante'];
$genero = $_GET['genero'];
$telefone = $_GET['telefone'];

if(!isset($email_visitante))
{
	$email_visitante = "N/A";
}

if(!isset($doc_visitante))
{
	$doc_visitante = "N/A";
}

if(!isset($nome_visitante))
{
	$nome_visitante = "N/A";
}


$valida_visitante = mysqli_query($conexao, "select * from visitantes where doc_visitante='$doc_visitante'");

$valida = mysqli_affected_rows($conexao);
		   
if($valida>0)
{

$dados_visitante = mysqli_fetch_array($valida_visitante);

$id = $dados_visitante['id_visitante'];
$nome = $dados_visitante['nome_visitante'];
$email = $dados_visitante['email_visitante'];
$foto = $dados_visitante['foto_visitante'];
$doc = $dados_visitante['doc_visitante'];
$genero = $dados_visitante['genero_visitante'];
$telefone = $dados_visitante['telefone_visitante'];

$entrada_confere = mysqli_query($conexao, "select * from controle_visitas where id_visitante = '$id' and dt_hr_saida is null order by id_controle_visita DESC LIMIT 1");

$valida_confirma = mysqli_num_rows($entrada_confere);

$rec_entrada = mysqli_fetch_array($entrada_confere);

$confirma_original = $rec_entrada['dt_hr_ent'];
$confirma = explode(" ", $confirma_original);

$confirma_data = $confirma[0];
$confirma_hora = $confirma[1];

$confirma_saida = $rec_entrada['dt_hr_saida'];
$confirma_saida = explode(" ", $confirma_saida);

$confirma_saida_data = $confirma_saida[0];
$confirma_saida_hora = $confirma_saida[1];

if($confirma_data!=$confirma_saida_data)
{
	$registro_saida = $confirma_saida_data." - ".$confirma_saida_hora; 
}
else
{
	$registro_saida = $confirma_saida_hora; 

}

if($valida_confirma>0)
{
	$botao = "Registra Saída Visitante";
	$submit = "saida_visitante";

	$registro_entrada = implode("/",array_reverse(explode("-",$confirma_data)));
	$registro_entrada = "Último registro de acesso: ".$registro_entrada."<br />Entrada: ".$confirma_hora." | Saída: ".$registro_saida;
}
else
{


$entrada_confere = mysqli_query($conexao, "select * from controle_visitas where id_visitante = '$id' order by id_controle_visita DESC LIMIT 1");

$rec_entrada = mysqli_fetch_array($entrada_confere);

$confirma_original = $rec_entrada['dt_hr_ent'];
$confirma = explode(" ", $confirma_original);

$confirma_data = $confirma[0];
$confirma_hora = $confirma[1];

$confirma_saida = $rec_entrada['dt_hr_saida'];
$confirma_saida = explode(" ", $confirma_saida);

$confirma_saida_data = $confirma_saida[0];
$confirma_saida_hora = $confirma_saida[1];

$confirma_saida_data = implode("/",array_reverse(explode("-",$confirma_saida_data)));

if($confirma_data!=$confirma_saida_data)
{
	$registro_saida = $confirma_saida_data." - ".$confirma_saida_hora; 
}
else
{
	$registro_saida = $confirma_saida_hora; 

}


$registro_entrada = implode("/",array_reverse(explode("-",$confirma_data)));
	$registro_entrada = "Último registro de acesso: ".$registro_entrada."<br />Entrada: ".$confirma_hora." | Saída: ".$registro_saida;

$botao = "Autorizar Acesso Visitante";
$submit = "entrada_visitante";
}

?>

<?php

}
else
{


$id = "";
$nome = $_GET['nome_visitante'];
$email = $_GET['email'];
$foto = $_GET['foto_visitante'];
$doc = $_GET['doc'];
$genero = $_GET['genero'];
$telefone = $_GET['telefone'];

$botao = "Autorizar Acesso Visitante";
$submit = "entrada_visitante";

?>

<?php
}


?>
<input type="hidden" id="status" name="status" maxlength="10" size="40" value="<?php echo $submit; ?>"/>
<input type="hidden" id="id_visitante" name="id_visitante" maxlength="10" size="40" value="<?php echo $id; ?>"/>
<table class="table_adm">
	<tr>	
		<td>
			Foto:
		</td>
		<td>
				<?php if($foto!='') { ?><img src="snaps/<?php echo $foto;?>" width="200px"><?php } else { echo "";}?>
		</td>
</tr>

	<tr>	
		<td>
			RG:
		</td>
		<td>
			<input type="text" id="doc_visitante" name="doc_visitante" maxlength="10" size="40" onblur="verifica_visitante();" value="<?php echo $doc; ?>"/>
		</td>
</tr>
	<tr>
		<td>
			Nome:
		</td>
		<td>
			<input type="text" id="nome_visitante" name="nome_visitante" maxlength="50" size="40" value="<?php echo $nome; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			Gênero:
		</td>
		<td>
			<select name="genero" id="genero">
				<option value="<?php echo $genero; ?>"><?php echo $genero; ?></option>
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
			<input type="text" id="tel_visitante" name="tel_visitante" maxlength="15" size="40" value="<?php echo $telefone; ?>" onkeypress="return somenteNumeros(event);" onkeyup="mascara(this, '## #####-####')"/>
		</td>
	</tr>
<tr>
		<td>
			Email:
		</td>
		<td>
			<input type="text" id="email" name="email_visitante" maxlength="50" size="40" value="<?php echo $email; ?>" onblur="validacaoEmail(adiciona_visitante.email_visitante)"/>
			<br />
			<div id="msg_email"></div>
		</td>
</tr>
<tr>	
		<td>
			<!-- Foto: -->
		</td>
		<td>
			<input type="hidden" id="foto_visitante" name="foto_visitante" maxlength="50" size="40" value="<?php echo $foto; ?>"/>
		</td>
</tr>	
<tr>	
		<td><br />
			Local de Visita:
		</td><br />
		<td><br />
			<select name="local_visita" id="local_visita">
				<?php
				$rec_locais = mysqli_query($conexao, "select * from locais where ativo='1'");

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
	<td colspan="2"><div id="resposta_submit"></div><br /><br /><?php echo $registro_entrada;?><br /><br />
	<input type="button" class="submit" value="<?php echo $botao;?>" style="width: 100%" onclick="submit_verifica();"/>
	</td>
</tr>
		
</table>