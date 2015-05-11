<?php

 include("../../include/sistema_conexao.php"); 
 



$sql = "SELECT codigo_produto , codigo_produto,descricao_produto FROM tabela_ec_produtos_detalhes WHERE descricao_produto LIKE '".$_REQUEST["palavra"]."%' GROUP BY codigo_produto ORDER BY codigo_produto";
$rs_itens = mysql_query($sql, $conexao);

    $rows_itens = mysql_num_rows($rs_itens);

echo "<ul id='busca' class='nav'>";

while ($linha = mysql_fetch_array($rs_itens))
            {  

echo "<li id='lista' class='liitem'>".$linha["descricao_produto"]."</li>";

}

echo "</ul>";

?>