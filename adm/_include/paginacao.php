<?

  if (mysql_num_rows($rs_dados)!=0)
  {


    if(ISSET($_REQUEST['registros_por_pagina']))
    {
      $registros_por_pagina=$_REQUEST['registros_por_pagina'];
    }
    else
    {
      $registros_por_pagina=10;
    }



    $var_numero_paginas = (mysql_num_rows($rs_dados)-((mysql_num_rows($rs_dados)-1) % $registros_por_pagina)) / $registros_por_pagina +1;
    $var_numero_paginas = (int) $var_numero_paginas;




    if(ISSET($_REQUEST['pagina']))
    {
      if($_REQUEST['pagina']!="")
      {

        if($_REQUEST['pagina']>$var_numero_paginas)
        {
          $pagina = $var_numero_paginas;
        }
        else
        {
          $pagina = $_REQUEST['pagina'];
        }

      }
      else
      {
        $pagina = "1";
      }
    }
    else
    {
      $pagina=1;
    }





    $paginas_show = 9;

    $arquivo_inicial = ($registros_por_pagina*($pagina-1))+1;
    $arquivo_final = ($registros_por_pagina*($pagina-1)) + $registros_por_pagina;




    $espaco_inicio="";
    $espaco_final="";
    $paginas_sobra = ($paginas_show-1)/2;

    if($paginas_show>=$var_numero_paginas)
    {
      $pagina_inicial=1;
      $pagina_final=$var_numero_paginas;
    }
    else
    {

      if($pagina<=$paginas_sobra)
      {
        $espaco_final="...";
        $pagina_inicial = 1;
        $pagina_final = $pagina_inicial + $paginas_show -1;
      }
      else
      {

        if($pagina>=($var_numero_paginas-$paginas_sobra))
        {
          $espaco_inicio="...";
          $pagina_inicial = $var_numero_paginas-$paginas_show+1;
          $pagina_final = $var_numero_paginas;
        }
        else
        {
          if($pagina-$paginas_sobra>1)
          {
            $espaco_inicio="...";
          }

          $espaco_final="...";
          $pagina_inicial = $pagina-$paginas_sobra;
          $pagina_final = $pagina+$paginas_sobra;
        }
      }
    }





    mysql_data_seek ($rs_dados, ($pagina-1)*$registros_por_pagina);





    $rabicho = "";

    reset ($_GET);
    while (list ($key, $val) = each ($_GET)) 
    {
      if($key!="pagina")
      {
        $rabicho.= "&" . $key . "=" . $val;
      }
    }



    echo "

    <table cellspacing='0' cellpadding='0' border='0' width='100%'>
      <tr>
        <td width=10 bgcolor=#cccccc height=30><img src=nada.gif width=1 height=1></td>
        <td width=280 bgcolor=#cccccc>
          <font class='caminho'><b>:: " . $sistema_plural . " Por Página: </b></font>
          <select class='select' name='registros_por_pagina'>";

            echo "<option value='10' ";
            if ($registros_por_pagina==10) echo "selected";
            echo ">10</option>";

            echo "<option value='20' ";
            if ($registros_por_pagina==20) echo "selected";
            echo ">20</option>";

            echo "<option value='50' ";
            if ($registros_por_pagina==50) echo "selected";
            echo ">50</option>";

            echo "<option value='100' ";
            if ($registros_por_pagina==100) echo "selected";
            echo ">100</option>";


          echo "</select> <input class='submit' type='submit' value='ok'></td>";

          echo "<td bgcolor='#cccccc'>";


          if ($pagina != 1)
          {  
            $pagina_anterior = $pagina-1;
            if($pagina>$paginas_show)
            {  
              echo " <a class='links_7' href='" . $_SERVER['PHP_SELF'] . "?pagina=1" . $rabicho . "'>";
              echo "[ <img alt='Primeira Página' src='../_imagens/seta_anterior.gif' border='0'> <img alt='Primeira Página' src='../_imagens/seta_anterior.gif' border='0'> ]</a> ";
            }  
            echo " <a class='links_7' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $pagina_anterior . $rabicho . "'>";
            echo "[ <img alt='Página Anterior' src='../_imagens/seta_anterior.gif' border='0'> ]</a> ";
          }

          echo $espaco_inicio;

          for($pag=1;$pag<=$var_numero_paginas;$pag++)  
          { 
            if(($pag>=$pagina_inicial)&&($pag<=$pagina_final))
            {
              if ($pag==$pagina)
              {  
                echo " <font class='links_7'><b>[ " . $pag . " ]</b></font> ";
              }
              else
              {  
                echo " <a class='links_7' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $pag .$rabicho . "'>";
                echo "[ ". $pag . " ]</a> ";
              }  
            }  
          }

          echo $espaco_final;

          if ($pagina != $var_numero_paginas) 
          { 
            $proxima_pagina = $pagina+1;

            echo " <a class='links_7' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $proxima_pagina . $rabicho . "'>";
            echo "[ <img alt='Próxima Página' src='../_imagens/seta_proxima.gif' border='0'> ]</a> ";

            if($pagina<$var_numero_paginas-$paginas_show)
            {  
              echo " <a class='links_7' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $var_numero_paginas . $rabicho . "'>";
              echo "[ <img alt='Última Página' src='../_imagens/seta_proxima.gif' border='0'> <img alt='Última Página' src='../_imagens/seta_proxima.gif' border='0'> ]</a> ";
            }  
          }  

          echo "&nbsp;&nbsp;&nbsp;<a class='links_7' href=javascript:history.back();>[ voltar ]</a> ";


        echo "</td>

        <td width=10 bgcolor=#cccccc height=30><img src=nada.gif width=1 height=1></td>
      </tr>
    </table>";


   }

?>