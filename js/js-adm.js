function getHTTPObject() {
var xmlhttp;
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
try {
xmlhttp = new XMLHttpRequest();
} catch (e) {
xmlhttp = false;
}
}
else
{
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
return xmlhttp;
}function CriaRequest() {
     try{
         request = new XMLHttpRequest();       
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");      
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");         
             }catch(falha){
                 request = false;
             }
         }
     }
      
     if (!request)
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }


function valida_login(){    

   if(document.getElementById('login').value=='')
   {
        
        document.getElementById('result_login').innerHTML = "<span style='color: red; font-size: 15px'>O campo email deve ser preenchido.</span>";
        document.getElementById('login').focus();
        return false;
   }

   if(document.getElementById('senha').value=='')
   {
        
        document.getElementById('result_login').innerHTML = "<span style='color: red; font-size: 15px'>O campo senha deve ser preenchido.</span>";
        document.getElementById('senha').focus();
        return false;
   }

        login=document.getElementById('login').value;
        senha=document.getElementById('senha').value;
     var div = "result_login";
     var result = document.getElementById(div);
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "valida_usuario.php?login=" + login + "&senha=" + senha, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                
                if(xmlreq.responseText=='1')
                {
                    document.getElementById("login-adm").submit();                    
                }
                else
                {
                    result.innerHTML = xmlreq.responseText;
                }                                   
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);}


function recupera_valida_login(){    

   if(document.getElementById('login').value=='')
   {
        
        document.getElementById('result_login').innerHTML = "<span style='color: red; font-size: 15px'>O campo email deve ser preenchido.</span>";
        document.getElementById('login').focus();
        return false;
   }        login=document.getElementById('login').value;     var div = "result_login";
     var result = document.getElementById(div);
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "recupera_valida_usuario.php?login=" + login, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                
                if(xmlreq.responseText=='1')
                {
                    document.getElementById("login-adm-rec").submit();                    
                }
                else
                {
                    result.innerHTML = xmlreq.responseText;
                }                                   
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);}


function excluir_usuario(id_usuario, tipo_usuario){

     if(id_usuario==1)
     {
        alert("Este usuário não pode ser excluído.");
        return false;
     }
     else
     {

     var confirma = confirm("Tem certeza que deseja excluir este usuário?");
     if(confirma == false){

     }
     else{


     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "exclui_usuario.php?id_usuario=" + id_usuario, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                
                if(xmlreq.responseText=='1')
                {
                    alert("Usuário excluído com sucesso!");
                    window.location.href='usuarios.php';                    
                }
                else
                {
                    alert("Usuário não foi excluído.");
                    window.location.href='usuarios.php';            
                }                                   
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
    

     }  


     }
}

function seleciona_usuario(id_usuario){

    var div = "altera_usuario_" + id_usuario;
    var result = document.getElementById(div);
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "seleciona_usuario.php?id_usuario=" + id_usuario, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}


function alterar_usuario(id_usuario){

	var nome = document.getElementById('nome_usuario_'+id_usuario).value;
	var login = document.getElementById('login_usuario_'+id_usuario).value;
   	var senha = document.getElementById('senha_usuario_'+id_usuario).value;

	nome_sem_espaco = nome.replace(/\s/g, '');
	login_sem_espaco = login.replace(/\s/g, '');
	senha_sem_espaco = senha.replace(/\s/g, '');


    if(nome_sem_espaco=='' || login_sem_espaco=='' || senha_sem_espaco=='')
    {
	alert("Os campos Nome, Login e Senha são obrigatórios.");
	return false;
    }

    var div = "altera_usuario_" + id_usuario;
    var result = document.getElementById(div);
    var nome = document.getElementById('nome_usuario_'+id_usuario).value;
    var email = document.getElementById('email_usuario_'+id_usuario).value;
    var login = document.getElementById('login_usuario_'+id_usuario).value;
    var senha = document.getElementById('senha_usuario_'+id_usuario).value;
    var tipo =  document.getElementById('tipo_usuario_'+id_usuario).value;

     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "altera_usuario.php?id_usuario=" + id_usuario + "&nome=" + nome + "&email=" + email + "&login=" + login + "&senha=" + senha + "&tipo=" + tipo, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}


function alterar_usuario_individual(id_usuario){


	var nome = document.getElementById('nome_usuario_'+id_usuario).value;
	var login = document.getElementById('login_usuario_'+id_usuario).value;
   	var senha = document.getElementById('senha_usuario_'+id_usuario).value;

	nome_sem_espaco = nome.replace(/\s/g, '');
	login_sem_espaco = login.replace(/\s/g, '');
	senha_sem_espaco = senha.replace(/\s/g, '');


    if(nome_sem_espaco=='' || login_sem_espaco=='' || senha_sem_espaco=='')
    {
	alert("Os campos Nome, Login e Senha são obrigatórios.");
	return false;
    }

    var nome = document.getElementById('nome_usuario_'+id_usuario).value;
    var email = document.getElementById('email').value;
    var login = document.getElementById('login_usuario_'+id_usuario).value;
    var senha = document.getElementById('senha_usuario_'+id_usuario).value;

     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "altera_usuario_individual.php?id_usuario=" + id_usuario + "&nome=" + nome + "&email=" + email + "&login=" + login + "&senha=" + senha, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {

                if(xmlreq.responseText=='1')
                {
                    alert("Dados alterados com sucesso!");
                }

                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}
 

function excluir_local(id_local){

     var confirma = confirm("Tem certeza que deseja excluir este local?");
     if(confirma == false){

     }
     else{


     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "exclui_local.php?id_local=" + id_local, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                
                if(xmlreq.responseText=='1')
                {
                    alert("Local excluído com sucesso!");
                    window.location.href='locais.php';                    
                }
                else
                {
                    alert("Local não foi excluído.");
                    window.location.href='locais.php';            
                }                                   
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
    

     }  


}

function seleciona_local(id_local){

    var div = "altera_local_" + id_local;
    var result = document.getElementById(div);
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "seleciona_local.php?id_local=" + id_local, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}


function alterar_local(id_local){

	nome = document.getElementById('nome_local_'+id_local).value;

	nome_sem_espaco = nome.replace(/\s/g, '');


    if(nome_sem_espaco=='')
    {
	alert("É obrigatório informar Nome do local.");
	return false;
    }

    var div = "altera_local_" + id_local;
    var result = document.getElementById(div);
    var nome = document.getElementById('nome_local_'+id_local).value;

     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "altera_local.php?id_local=" + id_local + "&nome=" + nome, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}

function verifica_visitante(){
    email = document.getElementById("email").value;
    doc =  document.getElementById("doc_visitante").value;
    nome_visitante = document.getElementById("nome_visitante").value;
    foto_visitante = document.getElementById("foto_visitante").value;
    genero = document.getElementById("genero").value;
    telefone = document.getElementById("tel_visitante").value;

    var result = document.getElementById("adiciona_visitante_form");
    
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "verifica_visitante.php?email=" + email + "&doc=" + doc + "&nome_visitante=" + nome_visitante + "&foto_visitante=" + foto_visitante + "&genero=" + genero + "&telefone=" + telefone, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}

function pdf_consulta_v(){
    query1 = document.getElementById("query1").value;
    query2 = document.getElementById("query2").value;

     window.open("pdf_v.php?query1=" + query1 + "&query2=" + query2, "_self");
     
}

function pdf_consulta_l(){
    query1 = document.getElementById("query1").value;
    query2 = document.getElementById("query2").value;

     window.open("pdf_l.php?query1=" + query1 + "&query2=" + query2, "_self");
     
}


function pdf_consulta_c(){
    query1 = document.getElementById("query1").value;
    query2 = document.getElementById("query2").value;

     window.open("pdf_c.php?query1=" + query1 + "&query2=" + query2, "_self");
     
}

function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }

 function mascara(t, mask){
 var i = t.value.length;
 var saida = mask.substring(1,0);
 var texto = mask.substring(i)
 if (texto.substring(0,1) != saida){
 t.value += texto.substring(0,1);
 }
 }

function validacaoEmail(field) {
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
document.getElementById('msg_email').innerHTML='';
if ((usuario.length >=1) &&
    (dominio.length >=3) &&
    (usuario.search("@")==-1) &&
    (dominio.search("@")==-1) &&
    (usuario.search(" ")==-1) &&
    (dominio.search(" ")==-1) &&
    (dominio.search(".")!=-1) &&
    (dominio.indexOf(".") >=1)&&
    (dominio.lastIndexOf(".") < dominio.length - 1)) {
}
else{
document.getElementById('email').value='';}
}


function sessao(){

     var confirma = confirm("Tem certeza que deseja sair?");
     if(confirma == false){

     }
     else{


     var xmlreq = CriaRequest();
     // Iniciar uma requisição
     xmlreq.open("GET", "sessao.php", true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
            window.open('index.php','_self');

            }
     };
     xmlreq.send(null);
    

     }  


}


function loadCamera(){
    //Captura elemento de vídeo
    var video = document.querySelector("#webCamera");
        //As opções abaixo são necessárias para o funcionamento correto no iOS
        video.setAttribute('autoplay', '');
        video.setAttribute('muted', '');
        video.setAttribute('playsinline', '');
        //--
    
    //Verifica se o navegador pode capturar mídia
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(function(stream) {
            //Definir o elemento vídeo a carregar o capturado pela webcam
            video.srcObject = stream;
        })
        .catch(function(error) {
            alert("Oooopps... Falhou :'(");
        });
    }
}

function takeSnapShot(){
    //Captura elemento de vídeo
    var video = document.querySelector("#webCamera");
    
    //Criando um canvas que vai guardar a imagem temporariamente
    var canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var ctx = canvas.getContext('2d');
    
    //Desenhando e convertendo as dimensões
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    //Criando o JPG
    var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.
    document.querySelector("#base_img").value = dataURI;
    
    sendSnapShot(dataURI); //Gerar Imagem e Salvar Caminho no Banco
}

function sendSnapShot(base64){
var request = new XMLHttpRequest();
request.open('POST', 'salvar_photos.php', true);
request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
// <pre><code>
    request.onload = function() {
        console.log(request);
        if (request.status >= 200 && request.status < 400) {
            //Colocar o caminho da imagem no SRC
            var data = JSON.parse(request.responseText);

            //verificar se houve erro
            if(data.error){
                alert(data.error);
                return false;
            }

            //Mostrar informações
            document.querySelector("#imagemConvertida").setAttribute("src", data.img);
            /*document.querySelector("#caminhoImagem a").setAttribute("href", data.img);
            document.querySelector("#caminhoImagem a").innerHTML = data.img.split("/")[1];*/
            document.getElementById("foto_visitante").value=data.img.split("/")[1];
        } else {
            alert( "Erro ao salvar. Tipo:" + request.status );
        }
    };

    request.onerror = function() {
        alert("Erro ao salvar. Back-End inacessível.");
    }

    request.send("base_img="+base64); // Enviar dados</code></pre><p>
 }

 function submit_verifica(){
    nome = document.getElementById("nome_visitante").value;
    foto = document.getElementById("foto_visitante").value;
    doc = document.getElementById("doc_visitante").value;

	nome_sem_espaco = nome.replace(/\s/g, '');
	doc_sem_espaco = doc.replace(/\s/g, '');

    if(nome_sem_espaco=='' || foto=='' || doc_sem_espaco=='')
    {
        document.getElementById('resposta_submit').innerHTML="<span style='color:red'>É obrigatório informar Nome, RG e selecionar uma foto. Por favor reveja as informações.</span>";
    }
    else
    {
        document.getElementById("adiciona_visitante").submit();
    }
 }


 function submit_verifica_local(){
    nome = document.getElementById("nome_local").value;

	nome_sem_espaco = nome.replace(/\s/g, '');


    if(nome_sem_espaco=='')
    {
        document.getElementById('validacao').innerHTML="<span style='color:red'>É obrigatório informar Nome do local.</span>";
    }
    else
    {
        document.getElementById("adiciona_local").submit();
    }
 }


 function submit_verifica_usuario(){
	var nome = document.getElementById('nome_usuario').value;
	var login = document.getElementById('login_usuario').value;
   	var senha = document.getElementById('senha_usuario').value;

	nome_sem_espaco = nome.replace(/\s/g, '');
	login_sem_espaco = login.replace(/\s/g, '');
	senha_sem_espaco = senha.replace(/\s/g, '');


    if(nome_sem_espaco=='' || login_sem_espaco=='' || senha_sem_espaco=='')
    {
	alert("Os campos Nome, Login e Senha são obrigatórios.");
	return false;
    }
	else
    {
        document.getElementById("adiciona_usuario").submit();
    }

 }