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


  // Nome do Relat�rio

  $nome_relatorio = "Clientes - Varejo";


  // Campos do Grupo


  $sql = " SELECT * FROM tabela_ec_clientes_detalhes ";
  $sql.= " WHERE ";
  $sql.= " revendedor_aprovado=0";
  $sql.= " AND revendedor_pedido=0";
  $sql.= " AND publicar=1";
  $sql.= " AND ativo=1";
  $sql.= " ORDER BY codigo_cliente DESC";



  $campos[111] = "codigo_cliente";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_clientes_detalhes";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "nome_cliente";
  $campos[122] = "Nome / Fantasia";
  $campos[123] = "varchar";
  $campos[124] = "tabela_ec_clientes_detalhes";
  $campos[125] = "25%";
  $campos[126] = " - ";

  $campos[131] = "cpf_cliente,cnpj_cliente";
  $campos[132] = "CPF / CNPJ";
  $campos[133] = "varchar,varchar";
  $campos[134] = "tabela_ec_clientes_detalhes";
  $campos[135] = "15%";
  $campos[136] = "<br />";

  $campos[141] = "email_cliente";
  $campos[142] = "E-mail";
  $campos[143] = "varchar";
  $campos[144] = "tabela_ec_clientes_detalhes";
  $campos[145] = "20%";
  $campos[146] = "<br />";

  $campos[151] = "ddd_tel_cliente,telefones_cliente";
  $campos[152] = "Telefone";
  $campos[153] = "inteiro,varchar";
  $campos[154] = "tabela_ec_clientes_detalhes";
  $campos[155] = "10%";
  $campos[156] = " | ";

  $campos[161] = "ddd_cel_cliente,celular_cliente";
  $campos[162] = "Celular";
  $campos[163] = "inteiro,varchar";
  $campos[164] = "tabela_ec_clientes_detalhes";
  $campos[165] = "10%";
  $campos[166] = " | ";

  $numero_campos = 6;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());




  // Campos do �tem


 

  $sql_item = " SELECT en.* FROM tabela_ec_clientes_enderecos en, tabela_ec_clientes_detalhes c";
  $sql_item.= " WHERE en.codigo_cliente = c.codigo_cliente " ;
  $sql_item.= " AND c.codigo_cliente = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " ORDER BY en.codigo_endereco";
  $campo_sql_principal="codigo_cliente";


  $campos_item[111] = "cep_cliente";
  $campos_item[112] = "CEP";
  $campos_item[113] = "inteiro";
  $campos_item[114] = "tabela_ec_clientes_enderecos";
  $campos_item[115] = "5%";
  $campos_item[116] = " - ";

  $campos_item[121] = "estado_cliente";
  $campos_item[122] = "UF";
  $campos_item[123] = "varchar";
  $campos_item[124] = "tabela_ec_clientes_enderecos";
  $campos_item[125] = "3%";
  $campos_item[126] = "<br />";

  $campos_item[131] = "cidade_cliente,bairro_cliente";
  $campos_item[132] = "Cidade | Bairro";
  $campos_item[133] = "varchar,varchar";
  $campos_item[134] = "tabela_ec_clientes_enderecos";
  $campos_item[135] = "10%";
  $campos_item[136] = " - ";

  $campos_item[141] = "endereco_cliente,numero_cliente";
  $campos_item[142] = "Endere�o | N�mero";
  $campos_item[143] = "varchar,inteiro";
  $campos_item[144] = "tabela_ec_clientes_enderecos";
  $campos_item[145] = "20%";
  $campos_item[146] = ", ";

  $campos_item[151] = "complemento_cliente";
  $campos_item[152] = "Complemento";
  $campos_item[153] = "varchar";
  $campos_item[154] = "tabela_ec_clientes_enderecos";
  $campos_item[155] = "10%";
  $campos_item[156] = " <br /> ";


  $numero_campos_item = 5;

 

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
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';


  $cont=0;
  while ($linha = mysql_fetch_array($rs_dados))
  {
    $cont++;


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


?>

  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
