<?php
session_start();
//error_reporting(~E_ALL);

include_once("con_bd.php");

if($_SESSION["id_usuario"]=='' || $_SESSION["tipo_usuario"]=='')
{
		echo"<script type='text/javascript'>
        window.open('index.php','_self');
        </script>";               

        exit;	
}
?>