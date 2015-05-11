<?php

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../../include/sistema_zeros.php"); 

  echo '<link rel="stylesheet" href="../_css/paineis.css" type="text/css" />
  ';

  echo "<h1>Pesquisa Rápida</h1>";


?>
    
<div  style="margin-top:20px;float:left; width:300px; height:200px;">

        <form method="post" target='_blank' id="pesquisa_pedido" name="pesquisa_pedido" action="../_relatorios/pedidos_detalhes.php" onsubmit="return validar('pesquisa_pedido');">
         <font size="2">Busca Pedido (Nº Pedido):</font><br>
         <input style="width:200px;" type="text" name="codigo_pedido" onkeypress="return mascara(this,'num',event)">
         <input type="submit" value="ok">
         </form>
 
<br>

        <form method="post" target='_blank' name="pesquisa_cliente" action="../_relatorios/clientes_detalhes.php">
        <font size="2">Busca Cliente<br>
        (Codigo, Nome ou Email do Cliente):</font><br>
        <input style="width:200px;" type="text" name="info_cliente">
        <input type="submit" value="ok">
        </form>
<br>

</div>


<?  

?>