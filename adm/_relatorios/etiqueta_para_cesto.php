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
  include("../../include/sistema_zeros.php");







  // INÍCIO DA CONFIGURAÇÃO ################################################################

  // Nome do Relatório

  $nome_relatorio = "Etiqueta para Cesto";
  
  // Filtros

  // 1 - Nome do Campo
  // 2 - SQL para exibição dos dados
  // 3 - campo codigo da tabela original
  // 4 - campo descrição da tabela original
  // 5 - campo codigo da tabela a ser filtrada
 
  $filtro[111] = "Produtos";
  $filtro[112] = "SELECT codigo_produto, CONCAT(referencia_produto, '-' , descricao_produto) as produto FROM tabela_ec_produtos_detalhes WHERE ativo=1";
  $filtro[113] = "codigo_produto";
  $filtro[114] = "produto";
  $filtro[115] = "tabela_ec_produtos_detalhes.codigo_produto";


  $numero_filtros = 1;

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

  if(!(isset($_REQUEST['imprimir'])))
  {
    if($cod!="")
    {
      echo "<font class=relatorio><b>Filtros:</b></font> ";
      echo "<form method=get>";
      echo $cod;
      echo "<input type=submit value=ok>";
      echo "</form>";
    }
  }
  
  if(isset($_REQUEST['imprimir']))
  {
    if($_REQUEST['imprimir']==1)
    {
      // echo '<table cellspacing="0" cellpadding="5">';
      // echo '<tr>';
      // echo '<td><font class=relatorio>' . $nome_site . ' - <b>' . $nome_relatorio . '</b> | ' . date("d/m/Y - H:i:s") . '</font></td>';
      // echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../index.php">[menu]</a></td>';   
    }
  }
  else
  {
    if(isset($_REQUEST[$filtro[113]]))
    {
      if($_REQUEST[$filtro[113]]!="")
      {
        echo '<table cellspacing="0" cellpadding="5">';
        echo '<tr>';
        echo '<td><font class=relatorio>' . $nome_site . ' - <b>' . $nome_relatorio . '</b> | ' . date("d/m/Y - H:i:s") . '</font></td>';
        echo '<td width=270 align=right><a class=relatorio href="etiqueta_para_cesto.php?imprimir=1&codigo_produto=' . $_REQUEST['codigo_produto'] . '">[visualizar impressão]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../index.php">[menu]</a></td>';
      }
    }  
  }  
  
  
  echo '</tr>';
  echo '</table>';

if(isset($_REQUEST[$filtro[113]]))
{
  if($_REQUEST[$filtro[113]]!="")
  {    



  // Campos do Grupo e Itens

  $sql = " SELECT tabela_ec_produtos_cores.codigo_cor, referencia_produto";
  $sql.= " FROM tabela_ec_produtos_detalhes, tabela_ec_produtos_cores, tabela_ec_produtos_estoque";
  $sql.= " WHERE tabela_ec_produtos_cores.codigo_cor = tabela_ec_produtos_estoque.codigo_cor";
  $sql.= " AND tabela_ec_produtos_detalhes.codigo_produto = tabela_ec_produtos_estoque.codigo_produto";
  
  $sql.= " AND quantidade>0"; 
  $sql.= " AND tabela_ec_produtos_detalhes.ativo=1"; 
  $sql.= " AND tabela_ec_produtos_cores.ativo=1"; 

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

  $sql.= " GROUP BY tabela_ec_produtos_cores.codigo_cor";
  $sql.= " ORDER BY tabela_ec_produtos_cores.codigo_cor";
		

  $campos[111] = "referencia_produto";
  $campos[112] = "Referência";
  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_produtos_detalhes";
  $campos[115] = "5cm";
  $campos[116] = "";

  $campos[121] = "codigo_cor";
  $campos[122] = "Cor";
  $campos[123] = "inteiro";
  $campos[124] = "tabela_ec_produtos_cores";
  $campos[125] = "5cm";
  $campos[126] = "";


  $numero_campos = 1;

  $numero_campos_item = 1;


  // FIM DA CONFIGURAÇÃO ################################################################

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


    
  $a=0;
  $j=0;
  $k=0;
  $codigo_anterior=0;
  $codigo_anterior2=0;
  $cont=0;   

  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());
  $quantidade_cores = mysql_num_rows($rs_dados);

  while($linha = mysql_fetch_array($rs_dados))
  {	
    $k++;
    if($k==1)
    {
      echo "<div style='
             margin-left: 0cm;
             width: 21cm;
             height: 14cm;'>";

      echo "<p style=' float:left; margin-right:1cm;
             font-size: 3cm;
             padding-top:0px;
             margin-top: 0px;
             margin-bottom: 0cm;'>" . $linha['referencia_produto'] . "</p>";
      
      // echo "<div style='
      //        float: left;
      //        width: 21cm;
      //        height: 14cm;'>"; 
    }  
    echo "<div style='
           width: 2cm;
           height: 2cm;
           float: left;
           margin-right: 1cm;
           margin-bottom: 1cm;
           margin-top: 0.8cm;'>";
    echo "<img src='../../imagens/cores/fotos/" . zerosaesquerda($linha['codigo_cor'], 6) . ".jpg' alt='" . $linha['codigo_cor'] . "' title='" . $linha['codigo_cor'] . "' style='
           width: 2cm;
           height: 2cm;
           border: solid 1px #CCC;'>";
    echo "<p style='
           text-align: right;
           font-size: 0.4cm;
           margin-top: 0.2cm;
           font-family:Trebuchet MS, Arial, Helvetica, sans-serif;
           margin-right: 0.6cm;'>" . $linha['codigo_cor'] . "</p>";
    echo "</div>";
  }
  // echo "</div>";
  echo "</div>";

  if(isset($_REQUEST['imprimir']))
  {
    if($_REQUEST['imprimir']==1)
    {
      echo '<script type="text/javascript">window.print();</script>';           
    }
  }

?>
<script type="text/javascript"></script>
  </body>
</html>





<?}
   }
    }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
