<?

  if (mysql_num_rows($rs_dados)!=0)
  {

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

      <form method='get' style='border:0px; margin:0px 0px 0px 0px;'>

    <input type='hidden' name='pagina' value='" . $pagina . "'>

    <table cellspacing='0' cellpadding='0'><tr><td class=borda_preta>
    <table cellspacing='1' cellpadding='4' width='770' align=center>

      <tr>";

/*
    echo "

        <td width=280 bgcolor=#cccccc>
          <font class='relatorio'><b>Registros Por Página: </b></font>
          <select class='select' name='registros_por_pagina'>";

            echo "<option value='1' ";
            if ($registros_por_pagina==1) echo "selected";
            echo ">1</option>";

            echo "<option value='14' ";
            if ($registros_por_pagina==14) echo "selected";
            echo ">14</option>";

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
*/
          echo "<td bgcolor='#cccccc'> &nbsp; ";


          if ($pagina != 1)
          {  
            $pagina_anterior = $pagina-1;
            if($pagina>$paginas_show)
            {  
              echo " <a class='links_72' href='" . $_SERVER['PHP_SELF'] . "?pagina=1" . $rabicho . "'>";
              echo "[ <img alt='Primeira Página' src='../_imagens/seta_anterior.gif' border='0'> <img alt='Primeira Página' src='../_imagens/seta_anterior.gif' border='0'> ]</a> ";
            }  
            echo " <a class='links_72' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $pagina_anterior . $rabicho . "'>";
            echo "[ <img alt='Página Anterior' src='../_imagens/seta_anterior.gif' border='0'> ]</a> ";
          }

          echo $espaco_inicio;

          for($pag=1;$pag<=$var_numero_paginas;$pag++)  
          { 
            if(($pag>=$pagina_inicial)&&($pag<=$pagina_final))
            {
              if ($pag==$pagina)
              {  
                echo " <font class='links_72'><b>[ " . $pag . " ]</b></font> ";
              }
              else
              {  
                echo " <a class='links_72' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $pag .$rabicho . "'>";
                echo "[ ". $pag . " ]</a> ";
              }  
            }  
          }

          echo $espaco_final;

          if ($pagina != $var_numero_paginas) 
          { 
            $proxima_pagina = $pagina+1;

            echo " <a class='links_72' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $proxima_pagina . $rabicho . "'>";
            echo "[ <img alt='Próxima Página' src='../_imagens/seta_proxima.gif' border='0'> ]</a> ";

            if($pagina<$var_numero_paginas-$paginas_show)
            {  
              echo " <a class='links_72' href='" . $_SERVER['PHP_SELF'] . "?pagina=" . $var_numero_paginas . $rabicho . "'>";
              echo "[ <img alt='Última Página' src='../_imagens/seta_proxima.gif' border='0'> <img alt='Última Página' src='../_imagens/seta_proxima.gif' border='0'> ]</a> ";
            }  
          }  

          echo "&nbsp;&nbsp;&nbsp;<a class='links_72' href=../index.php>[ menu principal ]</a> ";


        echo "</td>

      </tr>
    </table>

</td>
      </tr>
    </table>


     </form>

";


   }

?>