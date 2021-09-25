<?php

# PHP 7

$conexao = mysqli_connect('localhost','root','senha@2021');

$banco = mysqli_select_db($conexao,'controle_visitantes');

mysqli_set_charset($conexao,'utf8');


?>
