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
  include("../../include/sistema_funcoes.php");
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################


  // Nome do Relat�rio

  $nome_relatorio = "Cadastros";






  // Filtros

  // 1 - Nome do Campo
  // 2 - SQL para exibi��o dos dados
  // 3 - campo codigo da tabela original
  // 4 - campo descri��o da tabela original
  // 5 - campo codigo da tabela a ser filtrada
 
  $filtro[111] = "M�s";
  $filtro[112] = "SELECT MONTH(data_cadastro_cliente) as mes FROM tabela_ec_clientes_detalhes WHERE ativo=1 AND publicar=1 AND data_cadastro_cliente<>'' GROUP BY MONTH(data_cadastro_cliente)";
  $filtro[113] = "mes";
  $filtro[114] = "mes";
  $filtro[115] = "MONTH(data_cadastro_cliente)";


  $filtro[121] = "Ano";
  $filtro[122] = "SELECT YEAR(data_cadastro_cliente) as ano, SUBSTRING(data_cadastro_cliente,1,4) as ano_mostrar FROM tabela_ec_clientes_detalhes WHERE ativo=1 AND publicar=1 AND data_cadastro_cliente<>'' GROUP BY YEAR(data_cadastro_cliente)";
  $filtro[123] = "ano";
  $filtro[124] = "ano_mostrar";
  $filtro[125] = "YEAR(data_cadastro_cliente)";



  $numero_filtros = 2;







  // Campos do Grupo


  $sql = " SELECT COUNT(codigo_cliente) as cadastros, CONCAT(SUBSTRING(data_cadastro_cliente,7,2)) as data, CONCAT(SUBSTRING(data_cadastro_cliente,5,2),'/',SUBSTRING(data_cadastro_cliente,1,4)) as mes, SUBSTRING(data_cadastro_cliente,1,4) as ano, data_cadastro_cliente";
  $sql.= " FROM tabela_ec_clientes_detalhes";
  $sql.= " WHERE ativo=1 AND publicar=1 AND data_cadastro_cliente<>''";

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

  if(ISSET($_REQUEST['mes']) AND ISSET($_REQUEST['ano']))
  {
    if($_REQUEST['mes']!='' AND $_REQUEST['ano']!='')
    {
      $sql.= " GROUP BY data";

      $campos[111] = "data";
      $campos[112] = "Data";
    }
    else
    {
      $sql.= " GROUP BY mes";  
    
      $campos[111] = "mes";
      $campos[112] = "M�s";
    }
  }
  else
  {
    $sql.= " GROUP BY mes";  
    
    $campos[111] = "mes";
    $campos[112] = "M�s";

  }
  
  $sql.= " ORDER BY data_cadastro_cliente";


  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_clientes_detalhes";
  $campos[115] = "4%";
  $campos[116] = "string";

  $campos[121] = "cadastros";
  $campos[122] = "Cadastros";
  $campos[123] = "inteiro";
  $campos[124] = "tabela_ec_clientes_detalhes";
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

      if($fx>1)
      {
        $cod.= "&nbsp;&nbsp;&nbsp;";  
      }
      $cod.= $filtro[$fx1] . ": <select name='" . $filtro[$fx3] . "'>";
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

        $cod.= "<option " . $sel . " value='" . $linha_filtro[$filtro[$fx3]] . "'>" ; 
          if($fx==1)
          {
            $cod.= nome_mes($linha_filtro[$filtro[$fx3]]) . "</option>";
          }
          else
          {
            $cod.= $linha_filtro[$filtro[$fx4]] . "</option>";
          }
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

  $sql = " SELECT COUNT(codigo_cliente) as qtd_cadastros FROM tabela_ec_clientes_detalhes WHERE ativo=1 AND publicar=1";

  $rs_cadastros = mysql_query($sql,$conexao);
  $linha_cadastro = mysql_fetch_array($rs_cadastros);
  echo 'Total de Cadastros: ';
  echo $linha_cadastro['qtd_cadastros'];

  $contr=0;
  while ($linha = mysql_fetch_array($rs_dados))
  {
    $contr++;


    // if($contr==1)
    // {
    //   echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
    //   echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
    //   echo '<tr>';

    //   for($cont=1;$cont<=$numero_campos;$cont++)
    //   {
    //     $cont_ = (10 + $cont);
    //     $cont2 = $cont_ . "2";
    //     $cont5 = $cont_ . "5";
    //     echo "<td bgcolor=#cccccc width=" . $campos[$cont5] . "><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";
    //   }  

    //   echo '</tr>';
    // }



    // echo "<tr valign=top>";

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";

      // echo "<td bgcolor=#555555 width=" . $campos[$cont5] . "><font class=relatorio><font color=#eeeeee>";


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

      // echo $valores_para_mostrar;

      $valor_campo[$contr][$cont] = $valores_para_grafico;

      // echo "</font></td>";


    } 

    // echo '</tr>';


  }

  // echo "</table></td></tr>";
  // echo "</table>";
  
  if(isset($_REQUEST['mes']) AND isset($_REQUEST['ano']))
  {
    if($_REQUEST['mes']!='' AND $_REQUEST['ano']!='')
    {
      $valor_campo = preenche_dias_vazios($valor_campo,$contr,$cont-1,$_REQUEST['mes'],$_REQUEST['ano']);
      $qtd_dia = qtd_dias_mes($_REQUEST['mes'],$_REQUEST['ano']);
    }
  }

  


//PARA APARECER A TABELA DE RESULTADOS � só DESCOMENTAR AS LINHAS A BAIXO E POR A CONDI��O DE SE ESTIVER SETADO A $_REQUEST['mes']

  // $dia=1;
  // while($dia<=$qtd_dia)
  // {
  //   if($dia==1)
  //   {
  //     echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
  //     echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
  //     echo '<tr>';

  //     for($colunas=1;$colunas<=$numero_campos;$colunas++)
  //     {
  //       $colunas_ = (10 + $colunas);
  //       $coluna2 = $colunas_ . "2";
  //       $coluna5 = $colunas_ . "5";
  //       echo "<td bgcolor=#cccccc width=" . $campos[$coluna5] . "><b><font class=relatorio>" . $campos[$coluna2] . "</font></b></td>";
  //     }  

  //     echo '</tr>';
  //   }



  //   echo "<tr valign=top>";

  //   for($colunas=1;$colunas<=$numero_campos;$colunas++)
  //   {
  //     $colunas_ = (10 + $colunas);
  //     $coluna5 = $colunas_ . "5";

  //     echo "<td bgcolor=#555555 width=" . $campos[$coluna5] . "><font class=relatorio><font color=#eeeeee>";
  //     if($colunas==1)
  //     {
  //       $tirar_aspas = explode("'",$valor_campo[$dia][$colunas]);
  //       $valores_para_mostrar = $tirar_aspas[1];
  //     }
  //     else
  //     {
  //       $valores_para_mostrar = $valor_campo[$dia][$colunas];
  //     }
      
  //     echo $valores_para_mostrar;  
  //     echo "</font></td>";
  //   }

  //   echo '</tr>';

  //   $dia++;

  // }


  //   echo "</table></td></tr>";
  //   echo "</table>";
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


        data.addRows(<? if(isset($qtd_dia)){echo $qtd_dia;}else{echo $contr; $qtd_dia=$contr;} ?>);

<?
        for($z=0;$z<$qtd_dia;$z++)
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
        chart.draw(data, {width: 1200, height: 540, title: '<? echo $nome_relatorio; ?>',
                          hAxis: {title: <?php echo "'" . $campos[112] . "'";?>, titleTextStyle: {color: 'red'}}
                         });

      }
      

      google.setOnLoadCallback(drawVisualization);

    </script>

    <div id="visualization" style="width: 1200px; height: 600px;"></div>



  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
