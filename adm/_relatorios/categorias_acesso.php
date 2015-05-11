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

  $nome_relatorio = "Acessos por Categoria";


  // Campos do Grupo


  $sql = " SELECT SUM(acessos) as total_acessos, descricao_categoria, tabela_ec_produtos_categorias.codigo_categoria";
  $sql.= " FROM tabela_ec_produtos_detalhes, tabela_ec_produtos_categorias ";
  $sql.= " WHERE tabela_ec_produtos_detalhes.codigo_categoria = tabela_ec_produtos_categorias.codigo_categoria";
  $sql.= " AND tabela_ec_produtos_detalhes.ativo=1";
  $sql.= " AND tabela_ec_produtos_categorias.ativo=1";
  $sql.= " GROUP BY tabela_ec_produtos_categorias.codigo_categoria";
  $sql.= " ORDER BY total_acessos DESC";



  $campos[111] = "codigo_categoria";
  $campos[112] = "C�digo";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_produtos_categorias";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "descricao_categoria";
  $campos[122] = "Categoria";
  $campos[123] = "varchar";
  $campos[124] = "tabela_ec_produtos_categorias";
  $campos[125] = "25%";
  $campos[126] = " - ";

  $campos[131] = "total_acessos";
  $campos[132] = "Acessos";
  $campos[133] = "inteiro";
  $campos[134] = "tabela_ec_produtos_detalhes";
  $campos[135] = "15%";
  $campos[136] = "<br />";

  $numero_campos = 3;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());




  // Campos do �tem


 

  $sql_item = " SELECT DISTINCT(e.codigo_estoque),e.codigo_produto, e.codigo_cor, e.codigo_tamanho,e.quantidade_minima,e.quantidade,c.*,t.* ";
  $sql_item.= " FROM tabela_ec_produtos_cores c, tabela_ec_produtos_tamanhos t, tabela_ec_produtos_estoque e" ;
  $sql_item.= " WHERE ";
  $sql_item.= " e.codigo_produto = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " AND e.codigo_cor = c.codigo_cor";
  $sql_item.= " AND e.quantidade <= e.quantidade_minima ";
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
