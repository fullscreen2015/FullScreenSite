<?php

session_start();

header("Content-Type: text/html; charset=ISO-8859-1",true);

include("../../include/sistema_data.php");
include("../../include/sistema_zeros.php");
include("../../include/sistema_conexao.php");
include("../../include/sistema_protecao.php");

include("../../include/ec_funcoes.php");
include("../../include/sistema_email_locaweb.php");
include("../../include/sistema_configuracoes.php");
 




$numero_pedido = anti_injection($_GET['numero_pedido']);
$codigo_pedido = anti_injection($_GET['codigo_pedido']);
$codigo_rastreamento = anti_injection($_GET['codigo_rastreamento']);

$numero_pedido_personalizado = $numero_pedido;
$codigo_pedido_personalizado = $codigo_pedido;
$codigo_rastreamento_personalizado = $codigo_rastreamento;
	
  
$sql = " UPDATE tabela_ec_pedidos_detalhes ";
$sql.= " SET codigo_situacao=4 ";
$sql.= " , codigo_rastreamento='".$codigo_rastreamento_personalizado."' ";
$sql.= " , pedido_expedido_data=" . date("Ymd");
$sql.= " WHERE codigo_pedido=" . $codigo_pedido_personalizado;
$sql.= " AND numero_pedido=" . $numero_pedido_personalizado;

if($rs_dados1 = mysql_query($sql,$conexao))

{

?>




<div id="salvo" style="float:left; width:300px; height:200px;">
<div  style="font-size: 14px; font-family:verdana; color: green; margin-left:4px; float:left;  width:290px; height:60px; ">     

CÓD. RASTREAMENTO SALVO<br>
STATUS ALTERADO PARA EXPEDIDO<br>
Nº Ped.: <?=$numero_pedido;?><br>
Nº Cód.: <?=$codigo_rastreamento;?><br>

</div>    
<form name="grava_rastreamento" method="" action="">
<div  style="margin-top:10px; font-size: 14px; font-family:verdana; margin-left:4px; float:left;  width:290px; height:30px; "> 
<b>Nº Pedido: </b>
<input type="text"  name="numero_pedido" id="numero_pedido" value="" />

<input type="button" value="OK" name="ok" onclick="enviaKey();">
        
</div>



</form>

</div>


<?
//DESCOMENTAR AO COLOCAR NO AR

//include('../../include/status_expedido_envia_email.php');

}






?>