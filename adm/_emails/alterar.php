<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_conexao.php"); 
    include("configuracoes.php"); 



    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";



      switch ($campos[$cont3]) 
      {
        case "chave_primaria":
          $campos_sql[$cont1] = $_REQUEST[$chave_primaria];
          break;

        case "blob":

          $campos_sql[$cont1] = $_REQUEST[$campos[$cont1]];
          $campos_sql[$cont1] = stripslashes($campos_sql[$cont1]);
          $campos_sql[$cont1] = htmlspecialchars($campos_sql[$cont1], ENT_QUOTES);

          $campos_sql[$cont1] = str_replace("\n", "<br>", $campos_sql[$cont1]);
          $campos_sql[$cont1] = str_replace("  ","&nbsp;&nbsp;", $campos_sql[$cont1]);


          break;

        case "blob_html":

          $campos_sql[$cont1] = $_REQUEST[$campos[$cont1]];
          $campos_sql[$cont1] = str_replace("\n", "<br>", $campos_sql[$cont1]);
          $campos_sql[$cont1] = str_replace("  ","&nbsp;&nbsp;", $campos_sql[$cont1]);


          break;

        case "moeda":

          $campos_sql[$cont1] = str_replace(",", ".", $_REQUEST[$campos[$cont1]]);
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

          $campos_sql[$cont1] = strip_tags($_REQUEST[$campos[$cont1]]);
          $campos_sql[$cont1] = stripslashes($campos_sql[$cont1]);
          $campos_sql[$cont1] = htmlspecialchars($campos_sql[$cont1], ENT_QUOTES);


      }
    }


    $sql="";

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";

      if($campos[$cont3]!="chave_primaria")
      {
        $sql = $sql . $campos[$cont1] . "=" . "'" . $campos_sql[$cont1] . "'";

        if($cont<$numero_campos)        
        {
          $sql = $sql . " , ";
        }

      }


    }



    $sql = "UPDATE " . $tabela . " SET " . $sql . " WHERE " . $chave_primaria . "=" . $_REQUEST[$chave_primaria]; 



    mysql_query($sql, $conexao); 




























    for($conta=1;$conta<=$numero_campos_associativos;$conta++)
    {
      $conta_ = (10 + $conta);
      $conta1 = $conta_ . "1";
      $conta2 = $conta_ . "2";
      $conta3 = $conta_ . "3";
      $conta4 = $conta_ . "4";
      $conta5 = $conta_ . "5";
      $conta6 = $conta_ . "6";
      $conta7 = $conta_ . "7";
      $conta8 = $conta_ . "8";
      $conta9 = $conta_ . "9";
      $conta91 = $conta_ . "91";



      $sql_delete = "DELETE FROM " . $campos_associativos[$conta8] . " WHERE " . $campos_associativos[$conta9] . "=" . $_REQUEST[$campos_associativos[$conta9]];

      mysql_query($sql_delete, $conexao); 

      if(ISSET($_REQUEST[$campos_associativos[$conta5]]))
      {
        $valores = implode(":",$_REQUEST[$campos_associativos[$conta5]]);
        $array_valores = explode(":",$valores);

                                                            //($_REQUEST[$campos[$cont1]])
        for ($i=0;$i<count($_REQUEST[$campos_associativos[$conta1]]);$i++)
        {

          $sql_busca_ultimo = "SELECT " . $campos_associativos[$conta91] . " FROM " . $campos_associativos[$conta8] . " ORDER BY " . $campos_associativos[$conta91] . " DESC LIMIT 1";

          $rs_novo_registro = mysql_query($sql_busca_ultimo, $conexao);
          $linha_novo_registro = mysql_fetch_array($rs_novo_registro);
          $codigo_novo_registro = $linha_novo_registro[$campos_associativos[$conta91]]+1;

          $nome_do_campo = $campos_associativos[$conta5] . "[" . $i . "]";

          $sql_gravar = "INSERT INTO " . $campos_associativos[$conta8] . " (".$campos_associativos[$conta91].",".$campos_associativos[$conta9].",".$campos_associativos[$conta5].") VALUES (". $codigo_novo_registro . "," . $_REQUEST[$campos_associativos[$conta9]] . ", " . $array_valores[$i] . ")" ; 


          mysql_query($sql_gravar, $conexao); 
        }
      }
    }



























    header("Location: painel.php?pagina=" . $_REQUEST['pagina']);  


  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }

?>
