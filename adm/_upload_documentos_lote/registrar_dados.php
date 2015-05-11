<?php



  if($tipo_sistema_documentos==2)
  {

    $dados_registrados = "?" . $chave_primaria . "=" . $_REQUEST[$chave_primaria];

  }
  else
  {



    // SISTEMA NORMAL - GRAVANDO ######################################################################

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";

      switch ($campos[$cont3]) 
      {

        case "chave_primaria":
          break;

        case "logico":

          if(ISSET($_REQUEST[$campos[$cont1]]))
          {
            $campos_sql[$cont1] = 1;
          }
          else
          {
            $campos_sql[$cont1] = 0;
          }

          break;


        case "data_int":

          $campo_ano = $campos[$cont1] . "_ano";
          $valor_ano = $_REQUEST[$campo_ano];
          $valor_ano = zerosaesquerda($valor_ano,4);  

          $campo_mes = $campos[$cont1] . "_mes";
          $valor_mes = $_REQUEST[$campo_mes];
          $valor_mes = zerosaesquerda($valor_mes,2);  

          $campo_dia = $campos[$cont1] . "_dia";
          $valor_dia = $_REQUEST[$campo_dia];
          $valor_dia = zerosaesquerda($valor_dia,2);  

          $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia;
          break;

        case "data_int_now":

          $campo_ano = $campos[$cont1] . "_ano";
          $valor_ano = $_REQUEST[$campo_ano];
          $valor_ano = zerosaesquerda($valor_ano,4);  

          $campo_mes = $campos[$cont1] . "_mes";
          $valor_mes = $_REQUEST[$campo_mes];
          $valor_mes = zerosaesquerda($valor_mes,2);  

          $campo_dia = $campos[$cont1] . "_dia";
          $valor_dia = $_REQUEST[$campo_dia];
          $valor_dia = zerosaesquerda($valor_dia,2);  

          $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia;
          break;

        case "data_hora":

          $campo_ano = $campos[$cont1] . "_ano";
          $valor_ano = $_REQUEST[$campo_ano];
          $valor_ano = zerosaesquerda($valor_ano,4);  

          $campo_mes = $campos[$cont1] . "_mes";
          $valor_mes = $_REQUEST[$campo_mes];
          $valor_mes = zerosaesquerda($valor_mes,2);  

          $campo_dia = $campos[$cont1] . "_dia";
          $valor_dia = $_REQUEST[$campo_dia];
          $valor_dia = zerosaesquerda($valor_dia,2);  


          $campo_hora = $campos[$cont1] . "_hora";
          $valor_hora = $_REQUEST[$campo_hora];
          $valor_hora = zerosaesquerda($valor_hora,2);  

          $campo_min = $campos[$cont1] . "_min";
          $valor_min = $_REQUEST[$campo_min];
          $valor_min = zerosaesquerda($valor_min,2);  

          $campo_seg = $campos[$cont1] . "_seg";
          $valor_seg = $_REQUEST[$campo_seg];
          $valor_seg = zerosaesquerda($valor_seg,2);  


          $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia.$valor_hora.$valor_min.$valor_seg;
          break;


        case "hora":

          $campo_hora = $campos[$cont1] . "_hora";
          $valor_hora = $_REQUEST[$campo_hora];
          $valor_hora = zerosaesquerda($valor_hora,2);  

          $campo_minuto = $campos[$cont1] . "_minuto";
          $valor_minuto = $_REQUEST[$campo_minuto];
          $valor_minuto = zerosaesquerda($valor_minuto,2);  

          $campo_segundo = $campos[$cont1] . "_segundo";
          $valor_segundo = $_REQUEST[$campo_segundo];
          $valor_segundo = zerosaesquerda($valor_segundo,2);  

          $campos_sql[$cont1] = $valor_hora.$valor_minuto.$valor_segundo;
          break;

        case "hora_now":

          $campo_hora = $campos[$cont1] . "_hora";
          $valor_hora = $_REQUEST[$campo_hora];
          $valor_hora = zerosaesquerda($valor_hora,2);  

          $campo_minuto = $campos[$cont1] . "_minuto";
          $valor_minuto = $_REQUEST[$campo_minuto];
          $valor_minuto = zerosaesquerda($valor_minuto,2);  

          $campo_segundo = $campos[$cont1] . "_segundo";
          $valor_segundo = $_REQUEST[$campo_segundo];
          $valor_segundo = zerosaesquerda($valor_segundo,2);  

          $campos_sql[$cont1] = $valor_hora.$valor_minuto.$valor_segundo;
          break;

        case "data_date":


          $campo_ano = $campos[$cont1] . "_ano";
          $valor_ano = $_REQUEST[$campo_ano];
          $valor_ano = zerosaesquerda($valor_ano,4);  

          $campo_mes = $campos[$cont1] . "_mes";
          $valor_mes = $_REQUEST[$campo_mes];
          $valor_mes = zerosaesquerda($valor_mes,2);  

          $campo_dia = $campos[$cont1] . "_dia";
          $valor_dia = $_REQUEST[$campo_dia];
          $valor_dia = zerosaesquerda($valor_dia,2);  


          $campos_sql[$cont1] = $valor_ano."-".$valor_mes."-".$valor_dia;


          break;


        case "data_date_now":


          $campo_ano = $campos[$cont1] . "_ano";
          $valor_ano = $_REQUEST[$campo_ano];
          $valor_ano = zerosaesquerda($valor_ano,4);  

          $campo_mes = $campos[$cont1] . "_mes";
          $valor_mes = $_REQUEST[$campo_mes];
          $valor_mes = zerosaesquerda($valor_mes,2);  

          $campo_dia = $campos[$cont1] . "_dia";
          $valor_dia = $_REQUEST[$campo_dia];
          $valor_dia = zerosaesquerda($valor_dia,2);  


          $campos_sql[$cont1] = $valor_ano."-".$valor_mes."-".$valor_dia;


          break;




        default:

          $campos_sql[$cont1] = $_REQUEST[$campos[$cont1]];

      }



    }










    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";

      if($campos[$cont3]!="chave_primaria")
      {
        if($dados_registrados!="")
        {
          $dados_registrados.= "---";
        }

        $dados_registrados.= $campos[$cont1] . "=";

        $dados_registrados.= prepara_campo($campos_sql[$cont1],$campos[$cont3]);
      }

    }

    $dados_registrados = "?valores=" . $dados_registrados;

  }

?>
