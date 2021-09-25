<?php session_start();
//error_reporting(~E_ALL);
include_once("con_bd.php");

// Recupera o login 
$login = ($_POST["login"]);
// Recupera a senha
$senha = ($_POST["senha"]); 

$senha = md5($senha);

//error_reporting(~E_ALL);



$rec_user = mysqli_query($conexao,"select * from usuarios where (email_usuario='$login' or usuario_usuario='$login') and senha_usuario='$senha' and ativo='1'");

$dados = mysqli_fetch_array($rec_user);
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["id_usuario"]   = $dados["id_usuario"]; 
        $_SESSION["nome_usuario"] = $dados["nome_usuario"]; 
        $_SESSION["tipo_usuario"]   = $dados["tipo_usuario"]; 
        $_SESSION["email_usuario"] = $dados["email_usuario"];         
        $_SESSION["usuario"] = $dados["usuario_usuario"];         
	    echo"<script type='text/javascript'>
        window.location.href='visitantes.php';
        </script>";               

        exit; 
 
?>