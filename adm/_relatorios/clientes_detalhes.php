<?php

  session_start();

  $registros_por_pagina_padrao=10;
  $inicio=0;
  
  
  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php"); 
  include("../../include/sistema_protecao.php"); 
  include("../_sistema/configuracoes.php");







  // IN�CIO DA CONFIGURA��O ################################################################




  // Pagina��o
  
  $relatorio_com_paginacao = 1;
  // 1 - sim
  // 2 - não

  //CONFIGURA��O DA PAGINA��O
  
  
  //Campo para base da pagina��o 
  //111-Nome do Campo na tabela
  //112-Tabela em que se encontra o campo
  //113-Apelido do campo
  $campo_principal[111]="codigo_cliente";
  $campo_principal[112]="tabela_ec_clientes_detalhes";
  $campo_principal[113]="n_clientes";
  
  
  //Condi��o para Filtragem
  
   $campo_filtro[111]=" publicar=1 AND ativo=1 ";
  if(isset($_GET['info_cliente']))
  { 
    if($_GET['info_cliente'] != "")
    {
      $dado_cliente = anti_injection($_GET['info_cliente']);

      $campo_filtro[111].= "AND (";

      if(is_numeric($dado_cliente))
      {
        $campo_filtro[111].= " codigo_cliente=" . $dado_cliente .  ")";
      }
      else
      {
        $campo_filtro[111].= " nome_cliente LIKE '%" . $dado_cliente . "%'";
        $campo_filtro[111].= " OR email_cliente LIKE '%" . $dado_cliente . "%')";  
      }
    }
  }

// echo $campo_filtro[111];
  if(isset($_REQUEST['codigo_cliente']))
  {
    if($_REQUEST['codigo_cliente']!='')
    {
        $relatorio_com_paginacao = 2;
    }
  }  
  
  
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
    
    if($quantidade>0)
    { 
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
      $primeiro = 0;
      $ultimo = 0;
    }
  }
  else
  {
    $registros_por_pagina=999999999;
  }
  
  //FIM DA PAGINA��O###################################################################
  

  
  // Nome do Relat�rio
  
  $nome_relatorio = "Clientes - Detalhes";
  
  // Campos do Grupo e Itens
  
  $sql = " SELECT c.codigo_cliente, c.nome_cliente, c.email_cliente, c.cpf_cliente, c.cnpj_cliente, ddd_tel_cliente, telefones_cliente, ddd_cel_cliente, celular_cliente,";
  $sql.= " en.cep_cliente, en.estado_cliente, en.cidade_cliente, en.bairro_cliente, en.complemento_cliente, en.endereco_cliente, en.numero_cliente";
  $sql.= " FROM tabela_ec_clientes_detalhes c, tabela_ec_clientes_enderecos en ";
  $sql.= " WHERE c.codigo_cliente = en.codigo_cliente ";
  
  if(isset($_GET['info_cliente']))
  {
    if($_GET['info_cliente'] != "")
    {
      $dado_cliente = anti_injection($_GET['info_cliente']);
  
      $sql.= "AND (";
  
      if(is_numeric($dado_cliente))
      {
        $sql.= " c.codigo_cliente=" . $dado_cliente . ")";
      }
      else
      {
        $sql.= " nome_cliente LIKE '%" . $dado_cliente . "%'";
        $sql.= " OR email_cliente LIKE '%" . $dado_cliente . "%')";
      }
    }
  }
  
  if(isset($_REQUEST['codigo_cliente']))
  {
    if($_REQUEST['codigo_cliente']!='')
    {
      $codigo_cliente = anti_injection($_REQUEST['codigo_cliente']);
  
      $sql.= " AND c.codigo_cliente=" . $codigo_cliente;
    }
  }
  
  $sql.= " AND publicar=1";
  $sql.= " AND c.ativo=1"; 
  
  if($relatorio_com_paginacao == 1)
  {
    $sql.= " AND c.codigo_cliente BETWEEN " . $primeiro . " AND " . $ultimo;
  }
  
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
  
  $campos[171] = "cep_cliente";
  $campos[172] = "CEP";
  $campos[173] = "inteiro";
  $campos[174] = "tabela_ec_clientes_enderecos";
  $campos[175] = "5%";
  $campos[176] = " - ";
  
  $campos[181] = "estado_cliente";
  $campos[182] = "UF";
  $campos[183] = "varchar";
  $campos[184] = "tabela_ec_clientes_enderecos";
  $campos[185] = "3%";
  $campos[186] = "<br />";
  
  $campos[191] = "cidade_cliente,bairro_cliente";
  $campos[192] = "Cidade | Bairro";
  $campos[193] = "varchar,varchar";
  $campos[194] = "tabela_ec_clientes_enderecos";
  $campos[195] = "10%";
  $campos[196] = " - ";
  
  $campos[201] = "endereco_cliente,numero_cliente";
  $campos[202] = "Endere�o | N�mero";
  $campos[203] = "varchar,inteiro";
  $campos[204] = "tabela_ec_clientes_enderecos";
  $campos[205] = "20%";
  $campos[206] = ", ";
  
  $campos[211] = "complemento_cliente";
  $campos[212] = "Complemento";
  $campos[213] = "varchar";
  $campos[214] = "tabela_ec_clientes_enderecos";
  $campos[215] = "10%";
  $campos[216] = " <br /> ";
  
  
  $numero_campos = 6;
  
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
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../index.php">[menu]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';
  
  
  
  if(isset($_GET['info_cliente']))
  {
    echo '<h3>Resultado da pesquisa para "'.$dado_cliente.'".</h3>';
  }
  
  
  
  
  $a=0;
  $j=0;
  $k=0;
  $indice=0;
  $codigo_anterior=0;
  $codigo_anterior2=array();
  $conta=0;   
  $cont=0;   
  $total_itens=0;
  $registros=0;
  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());
  
  if($quantidade>0)
  {
    while($linha = mysql_fetch_array($rs_dados)) 
    {	
	 
      $k++;
  
      if($linha['codigo_cliente']!=$codigo_anterior)
      {	 
  
        $codigo_anterior2[$indice]=$linha['codigo_cliente']; 
	      
        $indice++;
  
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
            echo '<table cellspacing="1" cellpadding="4" width="100%" align=center>';
          }
        }
        else
        {
          echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
          echo '<table cellspacing="1" cellpadding="4" width="100%" align=center>';
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
  
          echo "<td bgcolor=#555555 width=" . $campos[$cont5] . "><a href='clientes_detalhes.php?codigo_cliente=".$linha['codigo_cliente']."' style='text-decoration:none;'><font class=relatorio><font color=#eeeeee>";
  
  
  
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
  
  
          echo "</font></a></td>";
        
        }
  
        $codigo_anterior = $linha['codigo_cliente'];
        $conta=0;
	 
        echo '</tr>';
  
  
        // INserá�O PERSONALIZADA ############################################################
  
        echo "<tr><td colspan=" . $numero_campos . " bgcolor='#eeeeee' wid style='text-align:right;'>";
        echo ' <a href="../ec_clientes_detalhes/editar_dados.php?codigo_cliente='.$linha['codigo_cliente'].'" class=relatorio>[editar cliente]</a>';
        echo '</td></tr>';
  
        // FIM INserá�O PERSONALIZADA ############################################################	
  
      } 
	 
  
  
	 
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
	 	
	 	  //if($cont==2)
	 	  //echo "<td width='796px' bgcolor=dddddd><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";	
	 	 // else
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
                $tracinho = $campos[$cont6];
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
	 
  
  
    echo '<h3>Listagem dos pedidos relacionados aos clientes acima.</h3>';
  
    // IN�CIO DA CONFIGURA��O ################################################################
  
  
     // Campos do Grupo
  
    $sql = " SELECT p.codigo_pedido, p.numero_pedido, p.valor_pedido, p.codigo_cliente, p.data_pedido, p.valor_frete, p.valor_total, descricao_situacao";
    $sql.= " , nome_cliente";
    $sql.= " FROM tabela_ec_pedidos_detalhes p, tabela_ec_pedidos_situacoes s, tabela_ec_clientes_detalhes c";
    $sql.= " WHERE p.ativo = 1 ";
    $sql.= " AND s.codigo_situacao = p.codigo_situacao";
    $sql.= " AND p.codigo_cliente = c.codigo_cliente";
  
    // echo '<pre>';
    // print_r($codigo_anterior2);
    // echo '</pre>';
  
    for ($z=0; $z < $indice; $z++) { 
      if($z==0)
      {
        $sql.= " AND (";
      }
      else
      {
        $sql.= " OR";
      }
      $sql.= " p.codigo_cliente = " . $codigo_anterior2[$z];
  
      if($z+1 == $indice)
        $sql.= ")";
    }
  
    
    $sql.= " GROUP BY p.codigo_pedido ";
    $sql.= " ORDER BY c.nome_cliente DESC, p.data_pedido DESC";
  
  
  
    $campos[111] = "codigo_pedido";
    $campos[112] = "C�d";
    $campos[113] = "chave_primaria";
    $campos[114] = "tabela_ec_pedidos_detalhes";
    $campos[115] = "4%";
    $campos[116] = " - ";
  
    $campos[121] = "numero_pedido";
    $campos[122] = "N� Pedido";
    $campos[123] = "inteiro";
    $campos[124] = "tabela_ec_pedidos_detalhes";
    $campos[125] = "15%";
    $campos[126] = "<br />";
  
    $campos[131] = "data_pedido";
    $campos[132] = "Data";
    $campos[133] = "data_int";
    $campos[134] = "tabela_ec_pedidos_detalhes";
    $campos[135] = "15%";
    $campos[136] = "<br />";
  
    $campos[141] = "valor_pedido,valor_frete,valor_total";
    $campos[142] = "Valor do Pedido / Frete / Total";
    $campos[143] = "moeda,moeda,moeda";
    $campos[144] = "tabela_ec_pedidos_detalhes";
    $campos[145] = "18%";
    $campos[146] = "<br />";
  
    $campos[151] = "descricao_situacao";
    $campos[152] = "Status";
    $campos[153] = "varchar";
    $campos[154] = "tabela_ec_pedidos_situacoes";
    $campos[155] = "18%";
    $campos[156] = "<br />";
  
    $campos[161] = "codigo_cliente,nome_cliente";
    $campos[162] = "Codigo/Nome Cliente";
    $campos[163] = "inteiro,varchar";
    $campos[164] = "tabela_ec_clientes_detalhes";
    $campos[165] = "25%";
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
  
  
    $numero_campos_item = 0;
  
  
    $rs_dados_2 = mysql_query($sql, $conexao)or die(mysql_error());
  
    // FIM DA CONFIGURA��O ################################################################
  
  
  
  
    $k=0;
  
    while ($linha2 = mysql_fetch_array($rs_dados_2))
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
  
        echo "<td bgcolor=#555555 width=" . $campos[$cont5] . "><a href='pedidos_detalhes.php?codigo_pedido=".$linha2['codigo_pedido']."' style='text-decoration:none;'><font class=relatorio><font color=#eeeeee>";
  
  
  
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
  
              if($linha2["$nome_do_campo_para_mostrar"]==0)
              {
                $valores_para_mostrar.="Não";
              }
  
              if($linha2["$nome_do_campo_para_mostrar"]==1)
              {
                $valores_para_mostrar.="Sim";
              }
  
              $valores_para_mostrar.= $linha2["$nome_do_campo_para_mostrar"];
  
              break;
  
  
  
            case "moeda":
  
              $valores_para_mostrar.= "R$ " . number_format($linha2["$nome_do_campo_para_mostrar"],2,',','.');
              break;
  
  
            case "hora":
              $valores_para_mostrar.= fwhorai($linha2["$nome_do_campo_para_mostrar"]);
              break;
  
            case "hora_now":
              $valores_para_mostrar.= fwhorai($linha2["$nome_do_campo_para_mostrar"]);
              break;
  
            case "data_int":
              $valores_para_mostrar.= fwdatai($linha2["$nome_do_campo_para_mostrar"]);
              break;
  
            case "data_int_now":
              $valores_para_mostrar.= fwdatai($linha2["$nome_do_campo_para_mostrar"]);
              break;
  
            case "data_date":
              $valores_para_mostrar.= fwdata($linha2["$nome_do_campo_para_mostrar"]);
              break;
  
            case "blob":
              $valores_para_mostrar.= str_replace("\n", "<br>", $linha2["$nome_do_campo_para_mostrar"]);
              break;
  
  
            default:
  
              $valores_para_mostrar.= $linha2["$nome_do_campo_para_mostrar"];
  
          }
          $i++;
        }
  
        echo $valores_para_mostrar;
  
  
        echo "</font></a></td>";
  
  
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
  
  
        $sql_para_usar = str_replace("CAMPO-SQL-PRINCIPAL",$linha2[$campo_sql_principal],$sql_item);
  
        $rs_itens = mysql_query($sql_para_usar) or die(mysql_error());
  
  
  
        $j = 0 ;
        while($linha2_item = mysql_fetch_array($rs_itens))
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
  
                  if($linha2_item["$nome_do_campo_para_mostrar"]==0)
                  {
                    $valores_para_mostrar.="Não";
                  }
  
                  if($linha2_item["$nome_do_campo_para_mostrar"]==1)
                  {
                    $valores_para_mostrar.="Sim";
                  }
  
                  $valores_para_mostrar.= $linha2_item["$nome_do_campo_para_mostrar"];
  
                  break;
  
  
                case "moeda":
  
                  $valores_para_mostrar.= "R$ " . number_format($linha2_item["$nome_do_campo_para_mostrar"],2,',','.');
                  break;
  
  
                case "hora":
                  $valores_para_mostrar.= fwhorai($linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
                case "hora_now":
                  $valores_para_mostrar.= fwhorai($linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
                case "data_int":
                  $valores_para_mostrar.= fwdatai($linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
                case "data_int_now":
                  $valores_para_mostrar.= fwdatai($linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
                case "data_date":
                  $valores_para_mostrar.= fwdata($linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
                case "blob":
                  $valores_para_mostrar.= str_replace("\n", "<br>", $linha2_item["$nome_do_campo_para_mostrar"]);
                  break;
  
  
                default:
                  $valores_para_mostrar.= $linha2_item["$nome_do_campo_para_mostrar"];
  
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
  }
  else
  {
    echo "Nenhum registro encontrado!";
  }


?>

  </body>
</html>

