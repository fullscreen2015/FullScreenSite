<?php

  session_start();

  include("../_include/usuarios_acesso.php");

  $arquivo = explode("/", $_SERVER['PHP_SELF']);
  $arquivo = end($arquivo);

  if(verifica_usuario_grafico($arquivo))
  {



  include("../_include/topo_relatorio.php");
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../_sistema/configuracoes.php");




  require '../_estatisticas/gapi.class.php';

  $ga = new gapi($ga_email,$ga_password);





  // INÍCIO DA CONFIGURAÇÃO ################################################################


  // Nome do Relatório

  $nome_relatorio = "Acessos do último ano mês a mês";




  $campos[111] = "month";
  $campos[112] = "Mês";
  $campos[113] = "4%";
  $campos[114] = "dados";
  $campos[115] = "string";

  $campos[121] = "pageviews";
  $campos[122] = "Page Views";
  $campos[123] = "15%";
  $campos[124] = "dados->getPageviews()";
  $campos[125] = "number";


  $numero_campos = 2;



  // Define o periodo do relatório

  $inicio = mktime (0, 0, 0, date("m"), date("d"),  date("Y")-1);
  $fim = mktime (0, 0, 0, date("m"), date("d"),  date("Y"));

  $inicio = date('Y-m-01', $inicio);
  $fim = date('Y-m-t', $fim); // Último dia do mês passado

  $ga->requestReportData($ga_profile_id, 'month', array('pageviews', 'visits'), 'month', null, $inicio, $fim);


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





  echo '<table cellspacing="0" cellpadding="5">';
  echo '<tr>';
  echo '<td><font class=relatorio>' . $nome_site . ' - <b>' . $nome_relatorio . '</b> | ' . date("d/m/Y - H:i:s") . '</font></td>';
  echo '<td width=200 align=right><a class=relatorio href="javascript:print();">[imprimir]</a> &nbsp; <a class=relatorio href="javascript:history.go(-1);">[voltar]</a></td>';
  echo '</tr>';
  echo '</table>';
  echo '<br>';






  $contr=0;

  foreach ($ga->getResults() as $dados) 
  {

    $contr++;


    $month = $dados;
    $visits = $dados->getVisits();
    $pageviews = $dados->getPageviews();



    if($contr==1)
    {
      echo '<table cellspacing="0" cellpadding="0"><tr><td class=borda_preta colspan=2>';
      echo '<table cellspacing="1" cellpadding="4" width="970" align=center>';
      echo '<tr>';

      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont2 = $cont_ . "2";
        $cont3 = $cont_ . "3";
        echo "<td bgcolor=#cccccc width=" . $campos[$cont3] . "><b><font class=relatorio>" . $campos[$cont2] . "</font></b></td>";
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

      echo "<td bgcolor=#555555 width=" . $campos[$cont3] . "><font class=relatorio><font color=#eeeeee>";


      $nome_do_campo_para_mostrar = $campos[$cont1];

      $valores_para_mostrar = $$nome_do_campo_para_mostrar;

      echo $valores_para_mostrar;




      switch ($campos[$cont5])
      {

        case "number":
          $valores_para_grafico = $valores_para_mostrar;
          break;

        default:

          $valores_para_grafico = "'" . $valores_para_mostrar . "'";

      }

      $valor_campo[$contr][$cont] = $valores_para_grafico;

      echo "</font></td>";


    } 

    echo '</tr>';


  }

  echo "</table></td></tr>";
  echo "</table>";
  

?>





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
        $cont5 = $cont_ . "5";
        $cont2 = $cont_ . "2";

        $ttt = "'" . $campos[$cont5]. "','" . $campos[$cont2] . "'";

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
        chart.draw(data, {width: 800, height: 240, title: '<? echo $nome_relatorio; ?>',
                          hAxis: {title: 'Mês', titleTextStyle: {color: 'red'}}
                         });

      }
      

      google.setOnLoadCallback(drawVisualization);

    </script>

    <div id="visualization" style="width: 900px; height: 600px;"></div>






  </body>
</html>





<?
    }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }
?>
