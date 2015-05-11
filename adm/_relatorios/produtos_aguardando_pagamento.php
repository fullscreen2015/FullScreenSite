<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_relatorio($arquivo))
  {
 
  $registros_por_pagina_padrao=10;
  $inicio=0;
  
  
  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################




  // Pagina��o
  
  $relatorio_com_paginacao = 2;
  // 1 - sim
  // 2 - não

  //CONFIGURA��O DA PAGINA��O
  
  
  //Campo para base da pagina��o 
  //111-Nome do Campo na tabela
  //112-Tabela em que se encontra o campo
  //113-Apelido do campo
  $campo_principal[111]="codigo_pedido";
  $campo_principal[112]="tabela_ec_pedidos_detalhes";
  $campo_principal[113]="n_pedidos";
  
  
  //Condi��o para Filtragem
  
   $campo_filtro[111]="codigo_situacao=2 AND ativo=1"; 
  
  
  //FIM DA CONFIGURA��O#########################################################

  // CONTAGEM
  
  $sql2 = " SELECT count(DISTINCT(" . $campo_principal[111] . ")) as " . $campo_principal[113];
  $sql2.= " FROM " . $campo_principal[112];
  
  if($campo_filtro[111]!="")
  {
    $sql2.= " WHERE " . $campo_filtro[111]; 
  }

  //FIM DA CONTAGEM  ####################################################################
  
  if($relatorio_com_paginacao==1)
  {
    
    $rs_contagem = mysql_query($sql2, $conexao)or die(mysql_error());
    $quantidade_pedidos = mysql_fetch_array($rs_contagem);
	
	$quantidade = $quantidade_pedidos[$campo_principal[113]];
	
	include("_paginacao.php");
  
  //PEGA O ULTIMO E O PRIMEIRO REGISTRO
  $sql3 = " SELECT " . $campo_principal[111];
  $sql3.= " FROM " . $campo_principal[112];
  
  if($campo_filtro[111]!="")
  {
    $sql3.= " WHERE " . $campo_filtro[111]; 
  }
  
  $sql3.= " ORDER BY " . $campo_principal[111];
  $sql3.= " LIMIT " .  $inicio . "," . $registros_por_pagina;

  $rs_registros = mysql_query($sql3, $conexao)or die(mysql_error());
  
  $t=0;
  while($linha_registros = mysql_fetch_array($rs_registros))
  {
     $registros[$t] = $linha_registros[$campo_principal[111]] . "<br>";
     $t++;
  }
  
  
  $primeiro = (int)$registros[0];
  $ultimo = (int)$registros[$t-1];
 
  }
  else
  {
    $registros_por_pagina=999999999;
  }
  
  //FIM DA PAGINA��O###################################################################
  
  
  
  
  // Nome do Relat�rio

  $nome_relatorio = " Produtos Aguardando Pagamento";


  // Campos do Grupo e Itens

  $sql = " SELECT tabela_ec_produtos_detalhes.codigo_produto, referencia_produto, descricao_produto, preco_custo, preco_varejo, preco_atacado, COUNT(tabela_ec_pedidos_itens.codigo_item) as quantidade_item, SUM(tabela_ec_pedidos_itens.quantidade) as quantidade_produtos";
  $sql.= " FROM tabela_ec_produtos_detalhes, tabela_ec_pedidos_detalhes, tabela_ec_pedidos_itens";
  $sql.= " WHERE tabela_ec_produtos_detalhes.codigo_produto =  tabela_ec_pedidos_itens.codigo_produto";
  $sql.= " AND tabela_ec_pedidos_detalhes.codigo_pedido = tabela_ec_pedidos_itens.codigo_pedido";
  $sql.= " AND codigo_situacao = 2"; 
  $sql.= " AND tabela_ec_pedidos_detalhes.ativo = 1"; 
  
  $sql.= " GROUP BY tabela_ec_produtos_detalhes.codigo_produto";
  $sql.= " ORDER BY referencia_produto";


  $campos[111] = "codigo_produto";
  $campos[112] = "C�d";
  $campos[113] = "chave_primaria";
  $campos[114] = "tabela_ec_produtos_detalhes";
  $campos[115] = "5%";
  $campos[116] = " - ";

  $campos[121] = "referencia_produto";
  $campos[122] = "Referencia";
  $campos[123] = "varchar";
  $campos[124] = "tabela_ec_produtos_detalhes";
  $campos[125] = "10%";
  $campos[126] = "<br />";

  $campos[131] = "descricao_produto";
  $campos[132] = "Produto";
  $campos[133] = "varchar";
  $campos[134] = "tabela_ec_produtos_detalhes";
  $campos[135] = "25%";
  $campos[136] = " - ";

  $campos[141] = "preco_custo";
  $campos[142] = "Custo";
  $campos[143] = "moeda";
  $campos[144] = "tabela_ec_produtos_detalhes";
  $campos[145] = "10%";
  $campos[146] = "<br />";

  $campos[151] = "preco_atacado,preco_varejo";
  $campos[152] = "Pre�o: Atacado / Varejo";
  $campos[153] = "moeda,moeda";
  $campos[154] = "tabela_ec_produtos_detalhes";
  $campos[155] = "20%";
  $campos[156] = "<br />";

  $campos[161] = "quantidade_item";
  $campos[162] = "Quantidade de Itens";
  $campos[163] = "inteiro";
  $campos[164] = "tabela_ec_pedidos_itens";
  $campos[165] = "10%";
  $campos[166] = "<br />";

  $campos[171] = "quantidade_produtos";
  $campos[172] = "Quantidade de Produtos";
  $campos[173] = "inteiro";
  $campos[174] = "tabela_ec_pedidos_itens";
  $campos[175] = "10%";
  $campos[176] = "<br />";

  $numero_campos = 7;

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
  
  $a=0;
  $j=0;
  $k=0;
  $codigo_anterior=0;
  $codigo_anterior2=0;
  $conta=0;   
  $total_itens=0;
  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());

  while($linha = mysql_fetch_array($rs_dados))
  {	
  
    $k++;

    if($linha[$campos[111]]!=$codigo_anterior)
    {	 
      $codigo_anterior2=$linha[$campos[111]];
	


      if($a!=0)
      {
        echo "</table>";
        $a=0;
      }                                                                  
      if($k>1)
      {
        if($numero_campos_item>0)
        {
          echo "</table>";

          echo "</td></tr>";
          echo "</table><br>";
          echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
          echo '<table cellspacing="1" cellpadding="4" width="1047" align=center>';
        }
      }
      else
      {
        echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
        echo '<table cellspacing="1" cellpadding="4" width="1047" align=center>';
      }

      if($k>1)
      {
        if($numero_campos_item>0)
        {
          echo "\n";
          echo '<tr>';

          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $cont_ = (10 + $cont);
            $cont2 = $cont_ . "2";
            $cont5 = $cont_ . "5";
            echo "<td bgcolor=#cccccc width=" . $campos[$cont5] . "><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";
            echo "\n";
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
    		
      echo "<tr valign=top >";

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

      $codigo_anterior = $linha[$campos[111]];
      $conta=0;
	
      echo '</tr>';
	

    } 
	


	if($numero_campos_item>0)
  {


	 echo '<tr style="width=100%;">';
	

    
	  if($a==0)
    {
	   echo '<table cellspacing="1" cellpadding="5">';
	   $a++;		
    }
	
  	if($conta==0)
  	{	
  		echo '<tr style="height:25px;">';        	
  		$conta++;
  		for($cont=1;$cont<=$numero_campos_item;$cont++)
  		{
  		  $cont_ = (10 + $cont + $numero_campos);
  		  $cont2 = $cont_ . "2";
  		  $cont5 = $cont_ . "5";
  		
  		  if($cont==2)
		    echo "<td width='796px' bgcolor=dddddd><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";	
  		  else
	   	  echo "<td width=" . $campos[$cont5] . " bgcolor=dddddd><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";	
  		}
	
  		echo '</tr>';
  	}	
	
  	$j++;
    if($numero_campos_item>0)
    { 
	 
	  echo "\n";
    echo "<tr>";

      for($cont=1;$cont<=$numero_campos_item;$cont++)
      {
          $cont_ = (10 + $cont + $numero_campos);
          $cont1 = $cont_ . "1";
          $cont2 = $cont_ . "2";
          $cont3 = $cont_ . "3";
          $cont4 = $cont_ . "4";
          $cont5 = $cont_ . "5";
          $cont6 = $cont_ . "6";

		    echo "\n";
		  
		    if($cont==2)
		    {
		      echo "<td width='878px' bgcolor=". cor_fundo($j)."><font class=relatorio><font color=".cor_letra($j).">";	
		    }
		    else
		    {
		      echo "<td width=" . $campos[$cont5] . " bgcolor=". cor_fundo($j)."><font class=relatorio><font color=".cor_letra($j).">";
		    }
	
		  
          $campos_para_mostrar = explode(",",$campos[$cont1]);
          $tipos_para_mostrar = explode(",",$campos[$cont3]);

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

                $valores_para_mostrar.= "R$ " . number_format($linha["$nome_do_campo_para_mostrar"],2,',','.');
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
                $valores_para_mostrar.= $linha["$nome_do_campo_para_mostrar"];

            }

            $i++;
			

           }
		  
		      echo $valores_para_mostrar;
		  	
          echo "</font></font></td>";
		      echo "\n";
      }

     
       echo "</tr>";
       echo "\n";		
      }  


    }

	}
	
	

    if($cont>1)
    {
        if($numero_campos_item>0)
        {
          echo "</table></td></tr>";


          echo "</table><br>";
        }
    }
    else
    {
        echo "</table></td></tr>";


        echo "</table><br>";
    }
	

     echo "</table>";



     echo "</td></tr>";


    echo "</table>";
?>

  </body>
</html>





<? }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
