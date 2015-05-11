<?php

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");

echo '<link rel="stylesheet" href="../_css/paineis.css" type="text/css" />
  ';


?>
<div  style="float:left; width:286px; height:180px;">

<?

$sql = "SELECT * FROM tabela_ec_clientes_detalhes ";
$sql .= " WHERE nome_cliente like '".trim($_REQUEST["nome_cliente"])."%'  order by nome_cliente ASC";


$query_pedido = mysql_query($sql);


while($fetch_pedido = mysql_fetch_array($query_pedido)){


echo  "<a target='_blank' href='../_personalizados/salvar_rastreamento/lista_pedidos_em_producao.php?codigo_cliente=".$fetch_pedido["codigo_cliente"]."' >".$fetch_pedido["nome_cliente"]."</a><br>";


}


?>

</div>