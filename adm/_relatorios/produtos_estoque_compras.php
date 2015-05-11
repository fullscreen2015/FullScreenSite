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


?>

    <script type="text/javascript" src="../_js/jquery.js"></script>

    <script language="javascript">

      function marcar_como_comprado(codigo_produto)
      {

        var id_produto = "#id_" + codigo_produto;

        var aleatorio2 = Math.floor(Math.random()*100000);

        $(id_produto).html('gravando dados ...'); 

        $.post("ajax_produtos_estoque_compras_atualizar.php", { codigo_produto: codigo_produto, a: aleatorio2 }, 
        function(data) { 
          $(id_produto).html(data); 
        });

      }
    </script>




<?php




  // IN�CIO DA CONFIGURA��O ################################################################


  // Nome do Relat�rio

  $nome_relatorio = "Estoque";


  // Campos do Grupo


  $sql = " SELECT p.*, c.descricao_categoria, SUM(tabela_ec_produtos_estoque.quantidade) as quantidade_por_produto";
  $sql.= " , nome_fantasia_fornecedor, telefone_fornecedor, celular_fornecedor";
  $sql.= " FROM tabela_ec_produtos_detalhes p, tabela_ec_produtos_categorias c,  tabela_ec_produtos_estoque,  tabela_ec_produtos_fornecedores ";
  $sql.= " WHERE p.codigo_categoria = c.codigo_categoria";
  $sql.= " AND p.codigo_produto = tabela_ec_produtos_estoque.codigo_produto";
  $sql.= " AND p.codigo_fornecedor = tabela_ec_produtos_fornecedores.codigo_fornecedor ";

  $sql.= " AND p.ativo = 1";
  $sql.= " AND p.publicar = 1";
  $sql.= " AND p.nao_comprar = 0";

  $sql.= " GROUP BY p.codigo_produto";
  $sql.= " HAVING quantidade_por_produto<=50 ";
  //$sql.= " ORDER BY nome_fantasia_fornecedor, comprado, quantidade_por_produto ASC";
  $sql.= " ORDER BY p.referencia_produto, comprado, quantidade_por_produto ASC";


  $campos[111] = "codigo_produto";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_produtos_detalhes";
  $campos[115] = "4%";
  $campos[116] = " - ";

  $campos[121] = "referencia_produto,descricao_produto";
  $campos[122] = "Ref | Descri��o";
  $campos[123] = "varchar,varchar";
  $campos[124] = "tabela_ec_produtos_detalhes";
  $campos[125] = "15%";
  $campos[126] = " - ";

  $campos[131] = "texto_produto";
  $campos[132] = "Texto";
  $campos[133] = "varchar";
  $campos[134] = "tabela_ec_clientes_detalhes";
  $campos[135] = "35%";
  $campos[136] = "<br />";

  $campos[141] = "quantidade_por_produto";
  $campos[142] = "Quantidade em Estoque";
  $campos[143] = "inteiro";
  $campos[144] = "tabela_ec_clientes_estoque";
  $campos[145] = "10%";
  $campos[146] = "<br />";

  $campos[151] = "descricao_categoria";
  $campos[152] = "Categoria";
  $campos[153] = "varchar";
  $campos[154] = "tabela_ec_produtos_categorias";
  $campos[155] = "10%";
  $campos[156] = " - ";

  $campos[161] = "data_ultima_compra";
  $campos[162] = "�ltima compra";
  $campos[163] = "data_int";
  $campos[164] = "tabela_ec_produtos_detalhes";
  $campos[165] = "10%";
  $campos[166] = " - ";

  $campos[171] = "nome_fantasia_fornecedor,telefone_fornecedor,celular_fornecedor";
  $campos[172] = "Fornecedor";
  $campos[173] = "varchar";
  $campos[174] = "tabela_ec_produtos_fornecedores";
  $campos[175] = "10%";
  $campos[176] = "<br>";


  $numero_campos = 7;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());




  // Campos do �tem


 
  $sql_item = " SELECT DISTINCT(e.codigo_estoque), e.codigo_produto, t.codigo_tamanho, SUM(e.quantidade) as quantidade_por_tamanho, t.* ";
  $sql_item.= " FROM tabela_ec_produtos_tamanhos t, tabela_ec_produtos_estoque e" ;
  $sql_item.= " WHERE ";
  $sql_item.= " e.codigo_produto = CAMPO-SQL-PRINCIPAL";
  $sql_item.= " AND e.codigo_tamanho = t.codigo_tamanho";
  $sql_item.= " GROUP BY t.descricao_tamanho";
  $sql_item.= " ORDER BY e.codigo_estoque";
  $campo_sql_principal="codigo_produto";



  $campos_item[111] = "quantidade_por_tamanho";
  $campos_item[112] = "Quantidade em Estoque";
  $campos_item[113] = "inteiro";
  $campos_item[114] = "tabela_ec_produtos_estoque";
  $campos_item[115] = "70%";
  $campos_item[116] = " - ";

  $campos_item[121] = "descricao_tamanho";
  $campos_item[122] = "Tamanho";
  $campos_item[123] = "varchar";
  $campos_item[124] = "tabela_ec_produtos_tamanhos";
  $campos_item[125] = "30%";
  $campos_item[126] = "<br>";


  $numero_campos_item = 2;

 

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
        //$i++;
      }
$i++;
      echo $valores_para_mostrar;


      echo "</font></td>";


    } 

    echo '</tr>';

    if($numero_campos_item>0)
    {


      // ###################################################################################
      // PERSONALIZA��O IN�CIO
      echo '<tr>';
      echo '<td colspan="' . $numero_campos . '">';
      echo '<div id="id_' . $linha['codigo_produto'] . '" class=relatorio>' ;

      if($linha['comprado']==1)
      {
        echo " produto comprado ";

        if($linha['data_marcacao_comprado']!="")
        {
          echo " em " . fwdatai($linha['data_marcacao_comprado']);
        }

        //echo " <a class=relatorio href='javascript:marcar_como_comprado(" . $linha['codigo_produto'] . ");'> | remarcar como comprado</a> ";
	  }
	  else
	  {
        echo " <a class=relatorio href='javascript:marcar_como_comprado(" . $linha['codigo_produto'] . ");'>marcar como comprado</a> ";
    }
	 
      
      

      

      // echo '<input type=checkbox name=codigo_produto value="' . $linha['codigo_produto'] . '">';

      echo '</div>' ;
      echo '</td>';
      echo '<tr>';
      // PERSONALIZA��O FIM
      // ###################################################################################

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
