<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_relatorio($arquivo))
  {



  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_protecao.php");
  include("../../include/sistema_zeros.php");
  include("../../include/sistema_data.php");
  include("../_sistema/configuracoes.php");








  // IN�CIO DA CONFIGURA��O ################################################################



  // Pagina��o

  $relatorio_com_paginacao = 1;
  // 1 - sim
  // 2 - não

  $registros_por_pagina_padrao = 14;



  if(ISSET($_REQUEST['registros_por_pagina']))
  {
    $registros_por_pagina=$_REQUEST['registros_por_pagina'];
  }
  else
  {
    $registros_por_pagina=$registros_por_pagina_padrao;
  }




  // Nome do Relat�rio

  $nome_relatorio = "Etiquetas - Endere�o";


  // Campos do Grupo


  $sql = " SELECT tabela_ec_pedidos_detalhes.codigo_pedido, numero_pedido, endereco_cliente, nome_cliente, numero_cliente, complemento_cliente, bairro_cliente, cidade_cliente, estado_cliente, cep_cliente, tabela_ec_clientes_enderecos.codigo_endereco, codigo_tipo_envio ";
  $sql.= " FROM tabela_ec_clientes_detalhes,  tabela_ec_clientes_enderecos, tabela_ec_pedidos_detalhes ";
  $sql.= " WHERE tabela_ec_clientes_detalhes.codigo_cliente = tabela_ec_pedidos_detalhes.codigo_cliente ";
  $sql.= " AND tabela_ec_clientes_detalhes.codigo_cliente = tabela_ec_clientes_enderecos.codigo_cliente ";
  $sql.= " AND tabela_ec_pedidos_detalhes.codigo_endereco = tabela_ec_clientes_enderecos.codigo_endereco ";
  $sql.= " AND tabela_ec_clientes_enderecos.ativo=1";
  $sql.= " AND tabela_ec_pedidos_detalhes.codigo_situacao=3";
  $sql.= " GROUP BY tabela_ec_pedidos_detalhes.codigo_pedido";
  $sql.= " , tabela_ec_pedidos_detalhes.codigo_endereco";
  $sql.= " ORDER BY tabela_ec_pedidos_detalhes.codigo_pedido DESC";



  $campos[111] = "nome_cliente";
  $campos[112] = "Nome";
  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_clientes_detalhes";
  $campos[115] = "font-weight:bold";
  $campos[116] = "";
  $campos[117] = "<br />";
  $campos[118] = "";

  $campos[121] = "endereco_cliente,numero_cliente,complemento_cliente";
  $campos[122] = "Endere�o";
  $campos[123] = "varchar";
  $campos[124] = "tabela_ec_clientes_enderecos";
  $campos[125] = "";
  $campos[126] = ", ";
  $campos[127] = " - ";
  $campos[128] = "";

  $campos[131] = "bairro_cliente,cidade_cliente,estado_cliente";
  $campos[132] = "Bairro";
  $campos[133] = "varchar";
  $campos[134] = "tabela_ec_clientes_enderecos";
  $campos[135] = "";
  $campos[136] = " - ";
  $campos[137] = " - ";
  $campos[138] = "";

  $campos[141] = "cep_cliente";
  $campos[142] = "CEP";
  $campos[143] = "varchar";
  $campos[144] = "tabela_ec_clientes_enderecos";
  $campos[145] = "";
  $campos[146] = "";
  $campos[147] = "<br />";
  $campos[148] = "CEP: ";

  $campos[151] = "numero_pedido";
  $campos[152] = "C�digo";
  $campos[153] = "inteiro";
  $campos[154] = "tabela_ec_pedidos_detalhes";
  $campos[155] = "";
  $campos[156] = "";
  $campos[157] = "<br />";
  $campos[158] = "Pedido: ";

  $numero_campos = 5;


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


  $numero_campos_item = 0;

 

  // FIM DA CONFIGURA��O ################################################################








  if($relatorio_com_paginacao==1)
  {

    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = anti_injection($_REQUEST['pagina']);
    }
    else
    {
      $pagina = "1";
    }



    $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());

    include("_paginacao2_preparacao.php");
  }
  else
  {
    $registros_por_pagina=99999999999999999;
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




/*
  echo '<table cellspacing="0" cellpadding="5">';
  echo '<tr>';
  echo '<td><font class=relatorio>' . $nome_site . ' - <b>' . $nome_relatorio . '</b> | ' . date("d/m/Y - H:i:s") . '</font></td>';
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a> &nbsp; <a class=relatorio href="../index.php">[menu]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';
*/


  echo '
<html>
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">


    <title>Friweb - Administra��o</title>

  </head>
  
  <body style="margin:0px; border:0px; background-color:#fff;">
';



  echo '<div style="float:left; background-color:#fff; margin:0px; width:100%;">';




  echo '<div style="float:left; background-color:#eeeeee;';
  echo ' margin:22mm 4mm 22mm 4mm; width:206mm; height:297mm;">';


  $k=0;
  $cont=0;
  
  while (($linha = mysql_fetch_array($rs_dados))&&($k<$registros_por_pagina))
  {
    $k++;

    $cont++;


    echo '<div style="float:left; font-family:arial; font-size:9pt; text-transform:uppercase; width:89mm; height:21mm; padding:6mm; background-color:#ffffff; margin:0mm 1mm 1mm 0mm;">';

    $thumb = "../../imagens/tipos_envio/fotos/" . zerosaesquerda($linha['codigo_tipo_envio'],6) . ".gif";
    echo "<img src='" . $thumb . "' style='width:30mm; float:right; margin-left:5mm;'>";

    echo "<p style='margin:0px; padding:0px;'>";

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";
      $cont7 = $cont_ . "7";
      $cont8 = $cont_ . "8";



      $campos_para_mostrar = explode(",",$campos[$cont1]);
      $tipos_para_mostrar = explode(",",$campos[$cont3]);

      $valores_para_mostrar="";

      $i=0;
      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {



        $efeito = "<span";

        if($campos[$cont5]!="")
        {
          $efeito.= " style='" . $campos[$cont5] .";'";
        }

        $efeito.= ">";



        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = $campos[$cont6];
        }

        $valores_para_mostrar.= $tracinho;

        $valores_para_mostrar.= $campos[$cont8];

        $valores_para_mostrar = $efeito . $valores_para_mostrar;



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
        
        






      }

$i++;

      $valores_para_mostrar.= "</span>";



        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = $campos[$cont7];
        }

        $valores_para_mostrar.= $tracinho;


      echo $valores_para_mostrar;


    } 


    echo "</span>";

    echo "</div>";

  } 



  echo "</div>";

  if($relatorio_com_paginacao==1)
  {
   // echo "<div style='float:left; width:100%; height:40px;'> &nbsp; </div>";
   // echo "<div style='float:left; width:100%; height:40px;'> &nbsp; </div>";
   // echo "<div style='float:left; width:100%; height:40px;'> &nbsp; </div>";

    echo "<div style='float:left; width:100%;'>";
    include("_paginacao2_exibicao.php");
    echo "</div>";
  }


?>

    </div>
  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }

?>
