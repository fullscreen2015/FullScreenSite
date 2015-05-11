<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_relatorio($arquivo))
  {



  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../../include/sistema_protecao.php");
  include("../_sistema/configuracoes.php");



  if(ISSET($_REQUEST['data_inicial']))
  {
    $data_inicial = anti_injection($_REQUEST['data_inicial']);
    $dia = substr($data_inicial, 0, 2);
    $mes = substr($data_inicial, 3, 2);
    $ano = substr($data_inicial, 6, 4);
    $data_inicial = $ano.$mes.$dia;
  }
  else
  {
    $data_inicial = date("Ymd");
  }

  if(ISSET($_REQUEST['data_final']))
  {
    $data_final = anti_injection($_REQUEST['data_final']);
    $dia = substr($data_final, 0, 2);
    $mes = substr($data_final, 3, 2);
    $ano = substr($data_final, 6, 4);
    $data_final = $ano.$mes.$dia;
  }
  else
  {
    $data_final = date("Ymd");
  }


?>
  <script src="../_js/jquery.js"></script>
  <script src="../_js/ui/jquery.ui.core.js"></script>
  <script src="../_js/ui/jquery.ui.widget.js"></script>
  <script src="../_js/ui/jquery.ui.datepicker.js"></script>
  <link rel="stylesheet" href="../_js/ui/themes/base/jquery.ui.all.css">


  <script>
    $(function() 
    {
      $("#data_inicial").datepicker();
      $("#data_final").datepicker();
    });
  </script>

<?php

  echo '<table cellspacing="0" cellpadding="5">';
  echo '<tr>';
  echo '<td>';

  echo '<form>';
  echo '<p class=relatorio>';
  echo 'Per�odo de <input type="text" id="data_inicial" name="data_inicial" value="' . fwdatai($data_inicial) . '">';
  echo ' at� <input type="text" id="data_final" name="data_final" value="' . fwdatai($data_final) . '">';
  echo '<input type=submit value="ok">';
  echo '</p>';
  echo '</form>';
  echo '</td></tr></table>';



  // IN�CIO DA CONFIGURA��O ################################################################


  // Nome do Relat�rio

  $nome_relatorio = "Frete por Per�odo (somente pedidos conclu�dos, expedidos e em produ��o)";



  // Campos do Grupo


  $sql = " SELECT codigo_pedido, data_pedido, valor_frete, valor_frete_pago ";
  $sql.= " FROM tabela_ec_pedidos_detalhes ";
  $sql.= " WHERE ";
  $sql.= " data_pedido >= " . $data_inicial;
  $sql.= " AND data_pedido <= " . $data_final;
  $sql.= " AND (codigo_situacao=5 OR codigo_situacao=4 OR codigo_situacao=3) ";
  $sql.= " ORDER BY data_pedido ASC";


  $campos[111] = "codigo_pedido";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_pedidos_detalhes";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "data_pedido";
  $campos[122] = "Data";
  $campos[123] = "data_int";
  $campos[124] = "tabela_ec_pedidos_detalhes";
  $campos[125] = "46%";
  $campos[126] = " - ";

  $campos[131] = "valor_frete";
  $campos[132] = "Frete cobrado ao cliente";
  $campos[133] = "moeda";
  $campos[134] = "tabela_ec_pedidos_detalhes";
  $campos[135] = "10%";
  $campos[136] = "<br />";

  $campos[141] = "valor_frete_pago";
  $campos[142] = "Frete pago ao correio";
  $campos[143] = "moeda";
  $campos[144] = "tabela_ec_pedidos_detalhes";
  $campos[145] = "15%";
  $campos[146] = "<br />";

  $numero_campos = 4;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());




  // Campos do �tem


 
  $sql_item = " SELECT DISTINCT(e.codigo_estoque),e.codigo_produto, e.codigo_cor, e.codigo_tamanho,e.quantidade_minima,e.quantidade,c.*,t.* ";
  $sql_item.= " FROM tabela_ec_produtos_cores c, tabela_ec_produtos_tamanhos t, tabela_ec_produtos_estoque e" ;
  $sql_item.= " WHERE ";
  $sql_item.= " e.codigo_produto = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " AND e.codigo_cor = c.codigo_cor";
  $sql_item.= " AND e.codigo_tamanho = t.codigo_tamanho";
  $sql_item.= " GROUP BY e.codigo_estoque";
  $sql_item.= " ORDER BY e.codigo_estoque";
  $campo_sql_principal="codigo_produto";



  $campos_item[111] = "quantidade";
  $campos_item[112] = "Quant Atual";
  $campos_item[113] = "inteiro";
  $campos_item[114] = "tabela_ec_produtos_estoque";
  $campos_item[115] = "5%";
  $campos_item[116] = " - ";

  $campos_item[121] = "quantidade_minima";
  $campos_item[122] = "Quant M�nima";
  $campos_item[123] = "inteiro";
  $campos_item[124] = "tabela_ec_produtos_estoque";
  $campos_item[125] = "5%";
  $campos_item[126] = " - ";

  $campos_item[131] = "descricao_cor";
  $campos_item[132] = "Cor";
  $campos_item[133] = "varchar";
  $campos_item[134] = "tabela_ec_produtos_cores";
  $campos_item[135] = "10%";
  $campos_item[136] = "<br>";

  $campos_item[141] = "descricao_tamanho";
  $campos_item[142] = "Tamanho";
  $campos_item[143] = "varchar";
  $campos_item[144] = "tabela_ec_produtos_tamanhos";
  $campos_item[145] = "10%";
  $campos_item[146] = "<br>";


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
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../index.php">[menu]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';


  // PERSONALIZA��O INICIO
  $total_frete_cobrado="";
  $numero_frete_cobrado="";

  $total_frete_pago="";
  $numero_frete_pago="";

  // PERSONALIZA��O FIM

  $cont=0;
  while ($linha = mysql_fetch_array($rs_dados))
  {
    $cont++;


    // PERSONALIZA��O INICIO
    $total_frete_cobrado+=$linha["valor_frete"];
    $total_frete_pago+=$linha["valor_frete_pago"];

    if($linha["valor_frete_pago"]>0)
    {
      $numero_frete_pago++;
    }

    if($linha["valor_frete"]>0)
    {
      $numero_frete_cobrado++;
    }

    // PERSONALIZA��O FIM

    if($cont>1)
    {
      if($numero_campos_item>0)
      {
        echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
        echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
      }
    }
    else
    {
      echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
      echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
    }

    if($cont>1)
    {
      if($numero_campos_item>0)
      {
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
    }
    else
    {
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



      $campos_para_mostrar = explode(",",$campos[$cont1]);
      $tipos_para_mostrar = explode(",",$campos[$cont3]);

      $valores_para_mostrar="";

      $i=0;
      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {

        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = $campos[$cont6];
        }

        $valores_para_mostrar.= $tracinho;


        switch ($tipos_para_mostrar[$i])
        {


          case "logico":

            if($linha["$nome_do_campo_para_mostrar"]==0)
            {
              $valores_para_mostrar.="Não";
            }

            if($linha["$nome_do_campo_para_mostrar"]==1)
            {
              $valores_para_mostrar.="Sim";
            }

            $valores_para_mostrar.= $linha["$nome_do_campo_para_mostrar"];

            break;



          case "moeda":

            $valores_para_mostrar.= "R$ " . number_format($linha["$nome_do_campo_para_mostrar"],2,',','.');
            break;


          case "hora":
            $valores_para_mostrar.= fwhorai($linha["$nome_do_campo_para_mostrar"]);
            break;

          case "hora_now":
            $valores_para_mostrar.= fwhorai($linha["$nome_do_campo_para_mostrar"]);
            break;

          case "data_int":
            $valores_para_mostrar.= fwdatai($linha["$nome_do_campo_para_mostrar"]);
            break;

          case "data_int_now":
            $valores_para_mostrar.= fwdatai($linha["$nome_do_campo_para_mostrar"]);
            break;

          case "data_date":
            $valores_para_mostrar.= fwdata($linha["$nome_do_campo_para_mostrar"]);
            break;

          case "blob":
            $valores_para_mostrar.= str_replace("\n", "<br>", $linha["$nome_do_campo_para_mostrar"]);
            break;


          default:

            $valores_para_mostrar.= $linha["$nome_do_campo_para_mostrar"];

        }
        $i++;
      }

      echo $valores_para_mostrar;


      echo "</font></td>";


    } 

    echo '</tr>';

    if($numero_campos_item>0)
    {

      echo '<tr>';
      echo '<td colspan="' . $numero_campos . '">';
      echo '<table cellspacing="1" cellpadding="5">';
      echo '<tr>';

      for($cont=1;$cont<=$numero_campos_item;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont2 = $cont_ . "2";
        $cont5 = $cont_ . "5";
        echo "<td width=" . $campos_item[$cont5] . " bgcolor=dddddd><b><font class=relatorio>" . $campos_item[$cont2] . "</font></b></td>";
      }

      echo '</tr>';


      $sql_para_usar = str_replace("CAMPO-SQL-PRINCIPAL",$linha[$campo_sql_principal],$sql_item);

      $rs_itens = mysql_query($sql_para_usar) or die(mysql_error());



      $j = 0 ;
      while($linha_item = mysql_fetch_array($rs_itens))
      {

        $j++;


        echo "<tr>";

        for($cont=1;$cont<=$numero_campos_item;$cont++)
        {
          $cont_ = (10 + $cont);
          $cont1 = $cont_ . "1";
          $cont2 = $cont_ . "2";
          $cont3 = $cont_ . "3";
          $cont4 = $cont_ . "4";
          $cont5 = $cont_ . "5";
          $cont6 = $cont_ . "6";

          echo "<td width=" . $campos_item[$cont5] . " bgcolor=". cor_fundo($j)."><font class=relatorio><font color=".cor_letra($j).">";



          $campos_para_mostrar = explode(",",$campos_item[$cont1]);
          $tipos_para_mostrar = explode(",",$campos_item[$cont3]);

          $valores_para_mostrar="";

          $i=0;
          foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
          {


            $tracinho = "";

            if($valores_para_mostrar!="")
            {
              $tracinho = $campos_item[$cont6];
            }

            $valores_para_mostrar.= $tracinho;




            switch ($tipos_para_mostrar[$i])
            {

              case "logico":

                if($linha_item["$nome_do_campo_para_mostrar"]==0)
                {
                  $valores_para_mostrar.="Não";
                }

                if($linha_item["$nome_do_campo_para_mostrar"]==1)
                {
                  $valores_para_mostrar.="Sim";
                }

                $valores_para_mostrar.= $linha_item["$nome_do_campo_para_mostrar"];

                break;


              case "moeda":

                $valores_para_mostrar.= "R$ " . number_format($linha_item["$nome_do_campo_para_mostrar"],2,',','.');
                break;


              case "hora":
                $valores_para_mostrar.= fwhorai($linha_item["$nome_do_campo_para_mostrar"]);
                break;

              case "hora_now":
                $valores_para_mostrar.= fwhorai($linha_item["$nome_do_campo_para_mostrar"]);
                break;

              case "data_int":
                $valores_para_mostrar.= fwdatai($linha_item["$nome_do_campo_para_mostrar"]);
                break;

              case "data_int_now":
                $valores_para_mostrar.= fwdatai($linha_item["$nome_do_campo_para_mostrar"]);
                break;

              case "data_date":
                $valores_para_mostrar.= fwdata($linha_item["$nome_do_campo_para_mostrar"]);
                break;

              case "blob":
                $valores_para_mostrar.= str_replace("\n", "<br>", $linha_item["$nome_do_campo_para_mostrar"]);
                break;


              default:
                $valores_para_mostrar.= $linha_item["$nome_do_campo_para_mostrar"];

            }

            $i++;


          }

          echo $valores_para_mostrar;

          echo "</font></font></td>";

        }

        echo "</tr>";

        }

        echo "</table></td></tr>";
      }



      if($cont>1)
      {
        if($numero_campos_item>0)
        {
          echo "</table></td></tr>";
          echo "</table>";
          if($numero_campos_item>0)
          {
            echo "<br><br>";
          }
        }
      }
      else
      {
        echo "</table></td></tr>";
        echo "</table>";
      }

    }

    echo "</table></td></tr>";
    echo "</table>";




    // PERSONALIZA��O INICIO

    echo "<font class=relatorio>";

    echo "<br /><br /><b>Valor total de frete cobrado ao cliente:</b> R$ " . number_format($total_frete_cobrado,2,',','.');
    echo "<br /><br /><b>Valor total de frete pago ao correio:</b> R$ " . number_format($total_frete_pago,2,',','.');

    echo "<br /><br /><b>N�mero de pedidos com frete cobrado ao cliente:</b> " . $numero_frete_cobrado;
    $media_frete_cobrado = $total_frete_cobrado/$numero_frete_cobrado;
    echo "<br /><br /><b>M�dia do frete cobrado ao cliente:</b> R$ " . number_format($media_frete_cobrado,2,',','.');

    if($numero_frete_pago>0)
    {
      echo "<br /><br /><b>N�mero de pedidos com frete pago ao correio:</b> " . $numero_frete_pago;
      $media_frete_pago = $total_frete_pago/$numero_frete_pago;
      echo "<br /><br /><b>M�dia do frete pago ao correio:</b> R$ " . number_format($media_frete_pago,2,',','.');
    }

    echo "</font>";

    // PERSONALIZA��O FIM



?>

  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
