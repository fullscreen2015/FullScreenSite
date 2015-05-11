<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_grafico($arquivo))
  {



  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################


  // Nome do Relat�rio

  $nome_relatorio = "Vendas por Tamanho";


  // Campos do Grupo


  $sql = " SELECT tabela_ec_produtos_tamanhos.*, SUM(tabela_ec_pedidos_itens.valor_unitario * tabela_ec_pedidos_itens.quantidade) as 'tamanho_venda' ";
  $sql .= " FROM tabela_ec_produtos_detalhes, tabela_ec_produtos_tamanhos, tabela_ec_pedidos_itens, tabela_ec_pedidos_detalhes";
  $sql.= " WHERE tabela_ec_pedidos_itens.codigo_produto=tabela_ec_produtos_detalhes.codigo_produto ";
  $sql.= " AND tabela_ec_pedidos_itens.codigo_pedido=tabela_ec_pedidos_detalhes.codigo_pedido ";
  $sql.= " AND tabela_ec_pedidos_itens.codigo_tamanho=tabela_ec_produtos_tamanhos.codigo_tamanho ";
  $sql.= " AND tabela_ec_pedidos_detalhes.codigo_situacao=5";
  $sql.= " AND tabela_ec_pedidos_detalhes.ativo=1";

  $sql.= " GROUP BY tabela_ec_produtos_tamanhos.descricao_tamanho";
  $sql.= " ORDER BY tamanho_venda DESC";

	

  $campos[111] = "descricao_tamanho";
  $campos[112] = "C�digo";
  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_produtos_tamanhos";
  $campos[115] = "4%";
  $campos[116] = "string";

  $campos[121] = "tamanho_venda";
  $campos[122] = "Venda Total";
  $campos[123] = "moeda";
  $campos[124] = "tabela_ec_produtos_tamanho";
  $campos[125] = "15%";
  $campos[126] = "number";

  $numero_campos = 2;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());



 $numero_campos_item = 0;

  // FIM DA CONFIGURA��O ################################################################





  function cor_fundo($i)
  {
    if ($i % 2) {
        return "#e6e6e6";
    } else {
        return "#f6f6f6";
    }
  }

  function cor_letra($i)
  {
    if ($i % 2) {
        return "#000000";
    } else {
        return "#999999";
    }


  }





  echo '<table cellspacing="0" cellpadding="5">';
  echo '<tr>';
  echo '<td><font class=relatorio>' . $nome_site . ' - <b>' . $nome_relatorio . '</b> | ' . date("d/m/Y - H:i:s") . '</font></td>';
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../">[menu]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';


  $contr=0;
  while ($linha = mysql_fetch_array($rs_dados))
  {
    $contr++;


    if($contr==1)
    {
      echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
      echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
      echo '<tr>';

      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont2 = $cont_ . "2";
        $cont5 = $cont_ . "5";
        echo "<td bgcolor=#cccccc width=" . $campos[$cont5] . "><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";
      }  

      echo '</tr>';
    }



    echo "<tr valign=top>";

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";

      echo "<td bgcolor=#555555 width=" . $campos[$cont5] . "><font class=relatorio><font color=#eeeeee>";


      $nome_do_campo_para_mostrar = $campos[$cont1];


      switch ($campos[$cont3])
      {


        case "logico":

          if($linha["$nome_do_campo_para_mostrar"]==0)
          {
            $valores_para_mostrar = "Não";
            $valores_para_grafico = "'Não'";
          }

          if($linha["$nome_do_campo_para_mostrar"]==1)
          {
            $valores_para_mostrar = "Sim";
            $valores_para_grafico = "'Sim'";
          }

          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = "'" . $linha["$nome_do_campo_para_mostrar"] . "'";

          break;


        case "moeda":
          $valores_para_mostrar = "R$ " . number_format($linha["$nome_do_campo_para_mostrar"],2,',','.');
          $valores_para_grafico = number_format($linha["$nome_do_campo_para_mostrar"],2,'.','');
          break;

        case "real":
          $valores_para_mostrar = number_format($linha["$nome_do_campo_para_mostrar"],3,',','.');
          $valores_para_grafico = number_format($linha["$nome_do_campo_para_mostrar"],3,'.','');
          break;

        case "inteiro":
          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = $linha["$nome_do_campo_para_mostrar"];
          break;

        case "hora":
          $valores_para_mostrar = fwhorai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwhorai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "hora_now":
          $valores_para_mostrar = fwhorai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwhorai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_int":
          $valores_para_mostrar = fwdatai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdatai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_int_now":
          $valores_para_mostrar = fwdatai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdatai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_date":
          $valores_para_mostrar = fwdata($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdata($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "blob":
          $valores_para_mostrar = str_replace("\n", "<br>", $linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . str_replace("\n", "<br>", $linha["$nome_do_campo_para_mostrar"]) . "'";
          break;


        default:

          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = "'" . $linha["$nome_do_campo_para_mostrar"] . "'";

      }

      echo $valores_para_mostrar;

      $valor_campo[$contr][$cont] = $valores_para_grafico;

      echo "</font></td>";


    } 

    echo '</tr>';


  }

  echo "</table></td></tr>";
  echo "</table>";
  

?>





    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();


<?
      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont6 = $cont_ . "6";
        $cont2 = $cont_ . "2";

        $ttt = "'" . $campos[$cont6]. "','" . $campos[$cont2] . "'";

        echo "data.addColumn(" . $ttt . ")
";
      }  
?>


        data.addRows(<? echo $contr; ?>);

<?
        for($z=0;$z<$contr;$z++)
        {
          $zz = $z+1;
          
          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $contz = $cont-1;
            $valores = $z . ", ".$contz.", " . $valor_campo[$zz][$cont] . "";
            echo "data.setValue(".$valores.");
";
          }
        }
?>
      
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization')).
            draw(data, {title:"<? echo $nome_relatorio; ?>"});
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
    <div id="visualization" style="width: 900px; height: 600px;"></div>






  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
