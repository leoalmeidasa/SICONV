<?php 



session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

$id_local = $_GET['id_local'];

$rec_user = mysqli_query($conexao,"select * from locais where id_local='$id_local'");

$dados_local = mysqli_fetch_array($rec_user);

 $id_local = $dados_local["id_local"]; 
 $nome_local = $dados_local["nome_local"]; 

?>
<td style="border-bottom: #000 1px dashed"><input type="text" value="<?php echo $dados_local['nome_local'];?>" name="nome_local_<?php echo $id_local;?>" id="nome_local_<?php echo $id_local;?>"></td>
<td style="text-align: center;border-bottom: #000 1px dashed"><input type="submit" value="Alterar" onclick="alterar_local('<?php echo $id_local;?>')"></td>