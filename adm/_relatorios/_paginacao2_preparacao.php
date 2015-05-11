<?

  if (mysql_num_rows($rs_dados)!=0)
  {


    if(ISSET($_REQUEST['registros_por_pagina']))
    {
      $registros_por_pagina=$_REQUEST['registros_por_pagina'];
    }
    else
    {
      $registros_por_pagina=$registros_por_pagina_padrao;
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


  }

?>