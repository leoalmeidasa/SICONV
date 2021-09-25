<?php


session_start();
error_reporting(~E_ALL);
include_once("con_bd.php");

date_default_timezone_set('America/Porto_Velho');

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/js-adm.js"></script>
<script type="text/javascript">
    $(function () {
        $(".data").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });
</script>
<div class="topo-adm"
     style=" color: white; box-shadow: 1px 2px 10px 0px rgba(0,0,0,0.3); clear: both !important;float: left;width: 100%; background-size: cover;height: 100px">
    <div style="margin-bottom: 20px;padding: 15px; display: inline-block; float: left;"></div>
    <div style="text-align: center; font-family:'Century Gothic', sans-serif;display: inline-block;float: left; margin-top: 20px">
        <h1 style="font-weight: 100; font-size: 1.2em;">Painel de Administração - Controle de Visitantes</h1></div>
    <span style="position: absolute; right: 50px"><a onclick="sessao();"
                                                     style="cursor: pointer; vertical-align: top;color: white; font-size: 15px;">Encerrar Sessão</a><img
                src="imgs/sessao.png" width="20px" style="cursor: pointer;" onclick="sessao();"></span></div>
