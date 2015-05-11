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
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################




  // Pagina��o

  $relatorio_com_paginacao = 1;
  // 1 - sim
  // 2 - não



  // Nome do Relat�rio

  $nome_relatorio = "Pedidos em produ��o";


  // Campos do Grupo


  $sql = " SELECT DISTINCT(p.codigo_pedido), descricao_tipo_envio, p.numero_pedido, p.valor_pedido, p.codigo_cliente, p.codigo_situacao, p.session, p.data_pedido, p.codigo_endereco,";
  $sql.= " c.nome_cliente, c.email_cliente,c.cpf_cliente, c.cnpj_cliente,";
  $sql.= " en.codigo_endereco, en.estado_cliente, en.cidade_cliente, en.cep_cliente, en.bairro_cliente,en.endereco_cliente, en.numero_cliente,en.complemento_cliente,en.codigo_cliente";
  $sql.= " FROM tabela_ec_pedidos_detalhes p, tabela_ec_pedidos_itens i, tabela_ec_clientes_enderecos en, tabela_ec_clientes_detalhes c, tabela_ec_pedidos_situacoes sp, tabela_ec_tipos_envio";
  $sql.= " WHERE ";
  $sql.= " p.codigo_cliente = c.codigo_cliente";
  $sql.= " AND p.codigo_tipo_envio = tabela_ec_tipos_envio.codigo_tipo_envio";
  $sql.= " AND p.codigo_endereco = en.codigo_endereco";
  $sql.= " AND p.codigo_cliente = en.codigo_cliente";
  $sql.= " AND p.codigo_situacao = 3 ";
  $sql.= " AND p.ativo = 1 ";
  $sql.= " GROUP BY p.codigo_pedido ";
  $sql.= " ORDER BY p.codigo_pedido DESC";



  $campos[111] = "codigo_pedido";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_pedidos_detalhes";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "numero_pedido,data_pedido";
  $campos[122] = "N� Pedido - Data";
  $campos[123] = "inteiro,data_int";
  $campos[124] = "tabela_ec_pedidos_detalhes";
  $campos[125] = "15%";
  $campos[126] = " - ";

  $campos[131] = "nome_cliente,email_cliente";
  $campos[132] = "Cliente";
  $campos[133] = "varchar,varchar,inteiro,varchar";
  $campos[134] = "tabela_ec_clientes_detalhes";
  $campos[135] = "20%";
  $campos[136] = "<br />";

  $campos[141] = "cpf_cliente,cnpj_cliente";
  $campos[142] = "CPF / CNPJ";
  $campos[143] = "varchar,varchar";
  $campos[144] = "tabela_ec_clientes_detalhes";
  $campos[145] = "20%";
  $campos[146] = "<br />";

  $campos[151] = "valor_pedido";
  $campos[152] = "Total Pedido";
  $campos[153] = "moeda";
  $campos[154] = "tabela_ec_pedidos_detalhes";
  $campos[155] = "8%";
  $campos[156] = " - ";

  $campos[161] = "descricao_tipo_envio";
  $campos[162] = "Envio";
  $campos[163] = "varchar";
  $campos[164] = "tabela_ec_tipos_envio";
  $campos[165] = "8%";
  $campos[166] = " - ";

  $numero_campos = 6;






  // Campos do �tem


  $sql_item = " SELECT DISTINCT(pi.codigo_item), pi.descricao_item,pi.codigo_pedido,pi.quantidade,pi.valor_unitario";
  $sql_item.= " FROM tabela_ec_pedidos_itens pi" ;
  $sql_item.= " WHERE pi.codigo_pedido = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " GROUP BY pi.codigo_item";
  $sql_item.= " ORDER BY pi.codigo_item";

  $campo_sql_principal="codigo_pedido";



  $campos_item[111] = "quantidade";
  $campos_item[112] = "Quant";
  $campos_item[113] = "inteiro";
  $campos_item[114] = "tabela_ec_pedidos_itens";
  $campos_item[115] = "5%";
  $campos_item[116] = " - ";

  $campos_item[121] = "descricao_item";
  $campos_item[122] = "Produto";
  $campos_item[123] = "varchar";
  $campos_item[124] = "tabela_ec_pedidos_itens";
  $campos_item[125] = "50%";
  $campos_item[126] = "<br>";

  $campos_item[131] = "valor_unitario";
  $campos_item[132] = "Pre�o Unit�rio";
  $campos_item[133] = "moeda";
  $campos_item[134] = "tabela_ec_pedidos_itens";
  $campos_item[135] = "15%";
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
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a></td>';
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





        // INserá�O PERSONALIZADA ############################################################

        //seleciona o endere�o de entrega
        $sel_endereco_entrega = mysql_query("SELECT * FROM tabela_ec_clientes_enderecos WHERE codigo_endereco = '".$linha['codigo_endereco']."'")or die(mysql_error());
        $endereco_entrega = mysql_fetch_array($sel_endereco_entrega);
        $descricao_endereco = $endereco_entrega['endereco_cliente'].' , n� '.$endereco_entrega['numero_cliente'].' - ';
        $descricao_endereco .= $endereco_entrega['complemento_cliente'].' | '.$endereco_entrega['bairro_cliente'].' - ';
        $descricao_endereco .= $endereco_entrega['cidade_cliente'].', '.$endereco_entrega['estado_cliente'].' - CEP: '.$endereco_entrega['cep_cliente'];

        echo "<tr><td colspan=" . $numero_campos . " bgcolor='#dddddd'>";
        echo "<b><font class=relatorio>Endere�o de entrega: </b>$descricao_endereco";
        echo " <a href='../ec_pedidos_detalhes/editar_dados.php?codigo_pedido=".$linha['codigo_pedido']."' class=relatorio>[editar pedido]</a></td></tr>";

        // FIM INserá�O PERSONALIZADA ############################################################


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
