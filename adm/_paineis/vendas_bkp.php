<?php

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");


	$nome_relatorio  = "Vendas";

	// Filtros


  // 1 - Nome do Campo
  // 2 - SQL para exibi��o dos dados
  // 3 - campo codigo da tabela original
  // 4 - campo descri��o da tabela original
  // 5 - campo codigo da tabela a ser filtrada
 
  $filtro[111] = "Forma de Pagamento";
  $filtro[112] = "SELECT * FROM tabela_ec_formas_de_pagamento";
  $filtro[113] = "codigo_forma_de_pagamento";
  $filtro[114] = "descricao_forma_de_pagamento";
  $filtro[115] = "codigo_forma_de_pagamento";


  $filtro[121] = "Tipo de Envio";
  $filtro[122] = "SELECT * FROM tabela_ec_tipos_envio";
  $filtro[123] = "codigo_tipo_envio";
  $filtro[124] = "descricao_tipo_envio";
  $filtro[125] = "codigo_tipo_envio";



  $numero_filtros = 2;







  // Campos do Grupo


  $sql = " SELECT SUM(valor_pedido) as vendas, CONCAT(SUBSTRING(data_pedido,5,2),'/',SUBSTRING(data_pedido,1,4)) as mes, SUBSTRING(data_pedido,1,4) as ano ";
  $sql.= " FROM tabela_ec_pedidos_detalhes";
  $sql.= " WHERE tabela_ec_pedidos_detalhes.codigo_situacao BETWEEN 3 AND 5";
  $sql.= " AND tabela_ec_pedidos_detalhes.ativo=1";

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

  $sql.= " GROUP BY mes";
  $sql.= " ORDER BY ano,mes";

	

  $campos[111] = "mes";
  $campos[112] = "M�s";
  $campos[113] = "varchar";
  $campos[114] = "tabela_ec_pedidos_detalhes";
  $campos[115] = "4%";
  $campos[116] = "string";

  $campos[121] = "vendas";
  $campos[122] = "Vendas (sem frete)";
  $campos[123] = "moeda";
  $campos[124] = "tabela_ec_pedidos_detalhes";
  $campos[125] = "15%";
  $campos[126] = "number";

  $numero_campos = 2;


  $rs_dados = mysql_query($sql, $conexao)or die(mysql_error());



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


  $contr=0;
  while ($linha = mysql_fetch_array($rs_dados))
  {
    $contr++;




    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";


      $nome_do_campo_para_mostrar = $campos[$cont1];


      switch ($campos[$cont3])
      {


        case "logico":

          if($linha["$nome_do_campo_para_mostrar"]==0)
          {
            $valores_para_mostrar = "Não";
            $valores_para_grafico = "'Não'";
          }

          if($linha["$nome_do_campo_para_mostrar"]==1)
          {
            $valores_para_mostrar = "Sim";
            $valores_para_grafico = "'Sim'";
          }

          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = "'" . $linha["$nome_do_campo_para_mostrar"] . "'";

          break;


        case "moeda":
          $valores_para_mostrar = "R$ " . number_format($linha["$nome_do_campo_para_mostrar"],2,',','.');
          $valores_para_grafico = number_format($linha["$nome_do_campo_para_mostrar"],2,'.','');
          break;

        case "real":
          $valores_para_mostrar = number_format($linha["$nome_do_campo_para_mostrar"],3,',','.');
          $valores_para_grafico = number_format($linha["$nome_do_campo_para_mostrar"],3,'.','');
          break;

        case "inteiro":
          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = $linha["$nome_do_campo_para_mostrar"];
          break;

        case "hora":
          $valores_para_mostrar = fwhorai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwhorai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "hora_now":
          $valores_para_mostrar = fwhorai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwhorai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_int":
          $valores_para_mostrar = fwdatai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdatai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_int_now":
          $valores_para_mostrar = fwdatai($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdatai($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "data_date":
          $valores_para_mostrar = fwdata($linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . fwdata($linha["$nome_do_campo_para_mostrar"]) . "'";
          break;

        case "blob":
          $valores_para_mostrar = str_replace("\n", "<br>", $linha["$nome_do_campo_para_mostrar"]);
          $valores_para_grafico = "'" . str_replace("\n", "<br>", $linha["$nome_do_campo_para_mostrar"]) . "'";
          break;


        default:

          $valores_para_mostrar = $linha["$nome_do_campo_para_mostrar"];
          $valores_para_grafico = "'" . $linha["$nome_do_campo_para_mostrar"] . "'";

      }


      $valor_campo[$contr][$cont] = $valores_para_grafico;


    } 


  }

  

?>


   <!--  <script src='../_js/jquery.js' type='text/javascript'></script> -->

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();


<?
      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont6 = $cont_ . "6";
        $cont2 = $cont_ . "2";

        $ttt = "'" . $campos[$cont6]. "','" . $campos[$cont2] . "'";

        echo "data.addColumn(" . $ttt . ")
";
      }  
?>


        data.addRows(<? echo $contr; ?>);

<?
        for($z=0;$z<$contr;$z++)
        {
          $zz = $z+1;
          
          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $contz = $cont-1;
            $valores = $z . ", ".$contz.", " . $valor_campo[$zz][$cont] . "";
            echo "data.setValue(".$valores.");
";
          }
        }
?>
      
        var chart = new google.visualization.ColumnChart(document.getElementById('visualization'));
        chart.draw(data, {width: 240, height: 200, title: '<? echo $nome_relatorio; ?>',
                          hAxis: {title: 'M�s', titleTextStyle: {color: 'red'}}
                         });

      }
      

      google.setOnLoadCallback(drawVisualization);

    </script>

    <div id="visualization" style="float:left; width:300px; height:240px; background-color:#ffcc00;"></div>



