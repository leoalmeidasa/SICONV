<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_local = $_GET['id_local'];
$nome_local = $_GET['nome'];

$altera_local = mysqli_query($conexao,"update locais set nome_local='$nome_local' where id_local='$id_local'");


$rec_user = mysqli_query($conexao,"select * from locais where id_local='$id_local'");

$dados_local = mysqli_fetch_array($rec_user);

 $id_local = $dados_local["id_local"]; 
 $nome_local = $dados_local["nome_local"]; 

?>
<td style="border-bottom: #000 1px dashed"><?php echo $dados_local['nome_local'];?></td>
			<td style="text-align: center;border-bottom: #000 1px dashed"><img src="imgs/editar.png" width="30px" style="cursor: pointer;" onclick="seleciona_local('<?php echo $dados_local['id_local'];?>');"> <img src="imgs/excluir.png" width="30px" style="cursor: pointer;" onclick="excluir_local('<?php echo $dados_local['id_local'];?>');"></td>