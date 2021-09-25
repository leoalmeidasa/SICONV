<?php
session_start();
//error_reporting(~E_ALL);
include_once("con_bd.php");

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/estilo-adm.css" rel="stylesheet">
<script type="text/javascript" src="js/js-adm.js"></script>
<title>Recuperação de senha</title>
</head>
<body style="background-color: #C0C0C0">
<?php
$login = $_POST['login'];


$rec_user = mysqli_query($conexao,"select * from usuarios where (email_usuario='$login' or usuario_usuario='$login') and ativo='1'");

$dados_usuario = mysqli_fetch_array($rec_user);

 $id_usuario = $dados_usuario["id_usuario"]; 
 $nome_usuario = $dados_usuario["nome_usuario"]; 
 $tipo_usuario = $dados_usuario["tipo_usuario"]; 
 $email_usuario = $dados_usuario["email_usuario"];         
 $usuario = $dados_usuario["usuario_usuario"];         


function geraSenha($tamanho = 5, $maiusculas = false, $numeros = true, $simbolos = false)
      {
      $lmin = 'abcdefghijklmnopqrstuvwxyz';
      $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $num = '1234567890';
      $simb = '!@#$%*-';
      $retorno = '';
      $caracteres = '';
      $caracteres .= $lmin;
      if ($maiusculas) $caracteres .= $lmai;
      if ($numeros) $caracteres .= $num;
      if ($simbolos) $caracteres .= $simb;
      $len = strlen($caracteres);
      for ($n = 1; $n <= $tamanho; $n++) {
      $rand = mt_rand(1, $len);
      $retorno .= $caracteres[$rand-1];
      }
      return $retorno;
      }
      $senha = geraSenha(5);
      $senha_email = $senha;
      $senha = md5($senha);


$valida = mysqli_num_rows($rec_user);

if($valida>0)
{

    $altera_senha = mysqli_query($conexao,"update usuarios set senha_usuario='$senha' where id_usuario = '$id_usuario'");
    include 'phpmailer/mailer.php';

            // Define os destinatário(s)
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $mail->AddAddress($email_usuario, $nome_usuario);
            //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
            //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
            // Define os dados técnicos da Mensagem
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
            $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
            $mail->Encoding = 'base64';
            // Define a mensagem (Texto e Assunto)
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $mail->Subject  = "Sistema de Controle de Visitantes :: Recuperação de Senha"; // Assunto da mensagem
            $mail->Body = "Olá <strong>$nome_usuario!</strong><br /> 
            <br /> 
            Conforme sua solicitação, uma nova senha de acesso ao painel administrativo foi criada.<br />
            <br />
            Segue dados de acesso:<br /> 
            <br />
            <strong>Usuário:</strong> $usuario<br /> 
            <strong>Senha:</strong> $senha_email<br />
            <br />
            Lembre-se, você pode acessar nosso sistema utilizando seu usuário ou email, e depois poderá alterar esta senha quando quiser no painel administrativo.<br /> 
            <br />
            <br />
            Atenciosamente<br />
            <strong>Administrador do sistema</strong>";
            //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";
            // Define os anexos (opcional)
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            // Envia o e-mail
            $enviado = $mail->Send();
            // Limpa os destinatários e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
            // Exibe uma mensagem de resultado
            if ($enviado) {
              ?>


<div id="container">
  <div id="main">
    <div id="login-sistema">

      <p class="subtitulo">Os dados foram enviados com sucesso. Por favor verifique seu email!</p>  
      <form id="login-adm" name="login-adm" action="login_usuario.php" method="POST">
        <p style="text-align: center"><strong>Sistema de Controle de Visitantes</strong></p>
        <br />
        Usuário: <input type="text" id="login" name="login"/><br /><br />       
        Senha: <input type="password" id="senha" name="senha" /><br />
        <p><a href="recupera_senha.php">Esqueci minha senha</a></p>
        <input class="btn_sbmt_adm" type="button" value="Entrar" onclick="valida_login()"/>
        <div id="result_login"></div>       


      </form>
    </div>
    </div>

  </div>
</div>

                 

              <?php
            } else {
              echo "<p class='subtitulo'> Não foi possível enviar o e-mail.";
              echo "<b>Informações do erro:</b> " . $mail->ErrorInfo."</p>";
              ?>
              <input class="btn_enviar" value="Voltar" type="button" onclick="history.back()">
              <?php
            }


}
else
{
  ?>

                <p class="subtitulo">O email informado <?php echo $email;?> não foi encontrado em nossa base de dados. Por favor, reveja os dados enviados.</p>
                <input class="btn_enviar" value="Voltar" type="button" onclick="history.back()">                                      

  <?php 
}


                ?>

 </form>
</body>
</html>