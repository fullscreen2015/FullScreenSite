<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_relatorio($arquivo))
  {

  $registros_por_pagina_padrao=10;
  
  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################



  // Pagina��o

  $relatorio_com_paginacao = 2;
  // 1 - sim
  // 2 - não




  // Nome do Relat�rio

  $nome_relatorio = "Clientes - Endere�os para brindes";


  // Campos do Grupo


  $sql = " SELECT c.codigo_cliente, COUNT(p.codigo_pedido) as quantidade, SUM(valor_pedido) as valor, c.nome_cliente, c.email_cliente";
  $sql.= " FROM tabela_ec_pedidos_detalhes p, tabela_ec_clientes_detalhes c";
  $sql.= " WHERE p.codigo_cliente = c.codigo_cliente";
  $sql.= " AND p.codigo_situacao = 5 ";
  $sql.= " AND p.ativo = 1 ";
  $sql.= " AND c.ativo = 1 ";
  $sql.= " GROUP BY c.codigo_cliente ";
  $sql.= " HAVING quantidade>2";
  $sql.= " ORDER BY valor DESC";



  $campos[111] = "codigo_cliente";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_clientes_detalhes";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "nome_cliente,email_cliente";
  $campos[122] = "Cliente";
  $campos[123] = "varchar,varchar";
  $campos[124] = "tabela_ec_clientes_detalhes";
  $campos[125] = "50%";
  $campos[126] = " - ";

  $campos[131] = "quantidade";
  $campos[132] = "Qtd de Compras";
  $campos[133] = "inteiro";
  $campos[134] = "tabela_ec_pedidos_detalhes";
  $campos[135] = "20%";
  $campos[136] = "<br />";

  $campos[141] = "valor";
  $campos[142] = "Valor Comprado";
  $campos[143] = "moeda";
  $campos[144] = "tabela_ec_pedidos_detalhes";
  $campos[145] = "25%";
  $campos[146] = " - ";

  $numero_campos = 4;






  // Campos do �tem

 
  $sql_item = " SELECT tabela_ec_clientes_enderecos.*, COUNT(tabela_ec_pedidos_detalhes.codigo_endereco) as quantidade";
  $sql_item.= " FROM tabela_ec_clientes_enderecos, tabela_ec_pedidos_detalhes" ;
  $sql_item.= " WHERE tabela_ec_clientes_enderecos.codigo_cliente = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " AND tabela_ec_clientes_enderecos.codigo_endereco = tabela_ec_pedidos_detalhes.codigo_endereco";
  $sql_item.= " AND tabela_ec_pedidos_detalhes.ativo=1";
  $sql_item.= " AND tabela_ec_pedidos_detalhes.codigo_situacao = 5";
  $sql_item.= " GROUP BY codigo_endereco";
  $sql_item.= " ORDER BY quantidade DESC";

  $campo_sql_principal="codigo_cliente";



  $campos_item[111] = "endereco_cliente,numero_cliente,complemento_cliente,bairro_cliente,cep_cliente";
  $campos_item[112] = "Endere�o";
  $campos_item[113] = "varchar,varchar,varchar,varchar,varchar";
  $campos_item[114] = "tabela_ec_clientes_enderecos,tabela_ec_clientes_enderecos,tabela_ec_clientes_enderecos,tabela_ec_clientes_enderecos";
  $campos_item[115] = "60%";
  $campos_item[116] = " - ";

  $campos_item[121] = "cidade_cliente,estado_cliente";
  $campos_item[122] = "Cidade/Estado";
  $campos_item[123] = "varchar,varchar";
  $campos_item[124] = "tabela_ec_clientes_enderecos,tabela_ec_clientes_enderecos";
  $campos_item[125] = "20%";
  $campos_item[126] = "/";

  $campos_item[131] = "quantidade";
  $campos_item[132] = "Qtd de Compras";
  $campos_item[133] = "inteiro";
  $campos_item[134] = "tabela_ec_pedidos_detalhes";
  $campos_item[135] = "20%";
  $campos_item[136] = " - ";


  $numero_campos_item = 3;

 

  // FIM DA CONFIGURA��O ################################################################









  if($relatorio_com_paginacao==1)
  {
    $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());

    include("_paginacao.php");
  }
  else
  {
    $registros_por_pagina=999999999;
    $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());
  }





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


  $k=0;

  while (($linha = mysql_fetch_array($rs_dados)) && ($k < $registros_por_pagina))
  {
    $k++;


    if($k>1)
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

    if($k>1)
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
      echo '<table cellspacing="1" cellpadding="5" width="970">';
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


?>

  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
