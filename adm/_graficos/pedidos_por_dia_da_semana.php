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

  $nome_relatorio = "Pedidos por M�s";






  // Filtros

  // 1 - Nome do Campo
  // 2 - SQL para exibi��o dos dados
  // 3 - campo codigo da tabela original
  // 4 - campo descri��o da tabela original
  // 5 - campo codigo da tabela a ser filtrada
 
  $filtro[111] = "Dia da Semana";
  $filtro[112] = "SELECT * FROM tabela_ec_dia_semana";
  $filtro[113] = "codigo_dia_semana";
  $filtro[114] = "nome_dia_semana";
  $filtro[115] = "codigo_dia_semana";


  $numero_filtros = 1;



  // Campos do Grupo
  $sql = " SELECT COUNT(codigo_item) as vendas, descricao_categoria";
  $sql.= " FROM tabela_ec_pedidos_detalhes, tabela_ec_pedidos_itens, tabela_ec_produtos_detalhes, tabela_ec_produtos_categorias";
  $sql.= " WHERE tabela_ec_pedidos_detalhes.codigo_situacao>=2";
  $sql.= " AND tabela_ec_pedidos_detalhes.codigo_situacao<6";
  $sql.= " AND tabela_ec_pedidos_detalhes.ativo=1";
  $sql.= " AND tabela_ec_pedidos_itens.codigo_pedido = tabela_ec_pedidos_detalhes.codigo_pedido";
  $sql.= " AND tabela_ec_pedidos_itens.codigo_produto = tabela_ec_produtos_detalhes.codigo_produto";
  $sql.= " AND tabela_ec_produtos_detalhes.codigo_categoria = tabela_ec_produtos_categorias.codigo_categoria";
  
  for($fx=1;$fx<=$numero_filtros;$fx++)
  {
    $fx_ = (10 + $fx);
    $fx1 = $fx_ . "1";
    $fx2 = $fx_ . "2";
    $fx3 = $fx_ . "3";
    $fx4 = $fx_ . "4";
    $fx5 = $fx_ . "5";

    if(ISSET($_REQUEST[$filtro[$fx3]]))
    {
      if($_REQUEST[$filtro[$fx3]]!="")
      {
        $sql.= " AND " . $filtro[$fx5] . "=" . $_REQUEST[$filtro[$fx3]] ;
      }
    }
  }

  $sql.= " GROUP BY descricao_categoria";
  $sql.= " ORDER BY descricao_categoria";

	

  $campos[111] = "descricao_categoria";
  $campos[112] = "Categoria";
  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_produtos_categorias";
  $campos[115] = "15%";
  $campos[116] = "string";

  $campos[121] = "vendas";
  $campos[122] = "N�mero de Pedidos";
  $campos[123] = "inteiro";
  $campos[124] = "tabela_ec_pedidos_detalhes";
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


  $cod="";

  for($fx=1;$fx<=$numero_filtros;$fx++)
  {
      $fx_ = (10 + $fx);
      $fx1 = $fx_ . "1";
      $fx2 = $fx_ . "2";
      $fx3 = $fx_ . "3";
      $fx4 = $fx_ . "4";
      $fx5 = $fx_ . "5";

      $cod.= "<select name='" . $filtro[$fx3] . "'>";
      $cod.= "<option SELECTED value=''>___selecione</option>";

      $rs_filtro = mysql_query($filtro[$fx2],$conexao);
      while($linha_filtro=mysql_fetch_array($rs_filtro))
      {
        $sel = "";
        if(ISSET($_REQUEST[$filtro[$fx3]]))
        {
          if($_REQUEST[$filtro[$fx3]]==$linha_filtro[$filtro[$fx3]])
          {
            $sel = "SELECTED";
          }
        }

        $cod.= "<option " . $sel . " value='" . $linha_filtro[$filtro[$fx3]] . "'>" . $linha_filtro[$filtro[$fx4]] . "</option>";
      }
      $cod.= "</select>";


  }

  if($cod!="")
  {
    echo "<font class=relatorio><b>Filtros:</b></font> ";
    echo "<form method=get>";
    echo $cod;
    echo "<input type=submit value=ok>";
    echo "</form>";
  }


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
      
        var chart = new google.visualization.ColumnChart(document.getElementById('visualization'));
        chart.draw(data, {width: 400, height: 240, title: '<? echo $nome_relatorio; ?>',
                          hAxis: {title: 'Categoria', titleTextStyle: {color: 'red'}}
                         });

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
