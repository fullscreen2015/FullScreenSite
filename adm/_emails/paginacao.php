<?

  if (mysql_num_rows($rs_dados)!=0)
  {

    $_SESSION['session_var_pagina'] = $pagina;

    if ($_SESSION['session_var_pagina']=="")
    {
      $_SESSION['session_var_pagina']=1;
    }

    $registros_por_pagina = 10;

    mysql_data_seek ($rs_dados, ($_SESSION['session_var_pagina']-1)*$registros_por_pagina);


    $var_numero_paginas = (mysql_num_rows($rs_dados)-((mysql_num_rows($rs_dados)-1) % $registros_por_pagina)) / $registros_por_pagina +1;
    $var_numero_paginas = (int) $var_numero_paginas;

?>


    <table cellspacing="1" cellpadding="4" border="0" width="780">
      <tr>
        <td bgcolor="dddddd" align="center">
          <font class="links_7">
            Páginas: </font>&nbsp;

<?        if ($_SESSION['session_var_pagina'] != 1)
          {  ?>
            <a class="links_7" href="<? echo $PHP_SELF; ?>?pagina=<? echo $_SESSION['session_var_pagina']-1; ?>&codigo_anunciante=<? echo $codigo_anunciante; ?>">
              [ <img src="../_imagens/seta_anterior.gif" border="0"> anterior ]</a>
<?        }

          for($pag=1;$pag<=$var_numero_paginas;$pag++)  
          { 
            if ($pag==$pagina)
            {  ?>

              <font class="links_7"><b>
                [ <? echo $pag; ?> ]</b></font>

<?          }
            else
            {  ?>

              <a class="links_7" href="<? echo $PHP_SELF; ?>?pagina=<? echo $pag; ?>&codigo_anunciante=<? echo $codigo_anunciante; ?>">
                [ <? echo $pag; ?> ]</a>

<?          }  ?>


<?        }

          if ($_SESSION['session_var_pagina'] != $var_numero_paginas) 
          {  ?>
            <a class="links_7" href="<? echo $PHP_SELF; ?>?pagina=<? echo $_SESSION['session_var_pagina']+1; ?>&codigo_anunciante=<? echo $codigo_anunciante; ?>">
              [ próxima <img src="../_imagens/seta_proxima.gif" border="0"> ]</a>
<?        }  ?>
        </td>
      </tr>
    </table>


<?  }  ?>
