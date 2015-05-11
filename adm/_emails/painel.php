<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {




  include("../_include/topo.php"); 
  include("../../include/sistema_conexao.php"); 
  include("../../include/sistema_data.php"); 
  include("../_include/funcao_selecao.php"); 
  include("../_include/funcao_confirma.php"); 
  include("configuracoes.php"); 



  $mostrar_filtros="";

  if(ISSET($_REQUEST['nome_campo_busca']))
  {
    $nome_campo_busca = $_REQUEST['nome_campo_busca'];
    $mostrar_filtros="ok";
  }
  else
  {
    $nome_campo_busca = "";
  }


  if(ISSET($_REQUEST['nome_campo_ordem']))
  {
    $nome_campo_ordem = $_REQUEST['nome_campo_ordem'];
    $mostrar_filtros="ok";
  }
  else
  {
    $nome_campo_ordem = $campo_ordenacao_padrao;
  }





  if(ISSET($_REQUEST['tipo_ordem']))
  {
    $tipo_ordem = $_REQUEST['tipo_ordem'];
    $mostrar_filtros="ok";
  }
  else
  {
    $tipo_ordem = $ordem_padrao;
  }


  if(ISSET($_REQUEST['expressao_busca']))
  {
    $expressao_busca = $_REQUEST['expressao_busca'];
    $mostrar_filtros="ok";
  }
  else
  {
    $expressao_busca = "";
  }



  if(ISSET($_REQUEST['pagina']))
  {
    $pagina = $_REQUEST['pagina'];
  }
  else
  {
    $pagina = "1";
  }


// Filtro e Ordena��o :::::::::::::::::::::::::::::::::::::




  $where="";

  $sql = "SELECT " . $tabela . ".* FROM " . $tabela;


  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont3 = $cont_ . "3";

    if($campos[$cont1]==$nome_campo_busca)
    {

      if(ISSET($_REQUEST['expressao_busca']))
      {
        if ($where=="")
        {
          $where = " WHERE ";
        }

        if(($campos[$cont3]=="inteiro")||($campos[$cont3]=="data")||($campos[$cont3]=="chave_primaria")||($campos[$cont3]=="moeda")||($campos[$cont3]=="real")||($campos[$cont3]=="logico"))        
        {
          $where.= " " . $campos[$cont1] . "='" . $expressao_busca . "'";
        }
        if(($campos[$cont3]=="varchar")||($campos[$cont3]=="blob"))        
        {
          $where.= " " . $campos[$cont1] . " LIKE '%" . $expressao_busca . "%'";
        }
      }
    }



    if(($campos[$cont3]=="chave_estrangeira")&&  ( isset($_REQUEST[$campos[$cont1]]) && ($_REQUEST[$campos[$cont1]]!="")    )     )
    {
      if ($where=="")
      {
        $where = " WHERE ";
      }
      else
      {
        $where.= " AND ";
      }

      $where.= " " . $campos[$cont1] . "='" . $_REQUEST[$campos[$cont1]] . "'";
    }

  }






  $sql.= $where;

  $sql.= " ORDER BY " . $nome_campo_ordem . " " . $tipo_ordem;


  $rs_dados = mysql_query($sql, $conexao);

  barra("Menu Principal","../index.php",$sistema_plural,"","","","","");  


?>

<script language="javascript">
<!--

  function mostrar_div(iDiv) 
  {

    var sDiv = document.getElementById(iDiv);

    if (sDiv.style.display == "none") 
    {
      sDiv.style.display = "block";
      sDiv.style.position = "static";
    }
    else 
    {
      sDiv.style.display = "none";
    }
  }



  function esconder_div(iDiv) 
  {
    var sDiv = document.getElementById(iDiv);

    sDiv.style.display = "none";
  }


-->
</script>



  <form action="painel.php" method="get">

    <input type="hidden" name="pagina" value="<? echo $pagina; ?>">

      <a class="caminho" href="impressao.php?sql=<? echo urlencode($sql); ?>"><b>&nbsp;&nbsp;&nbsp;:: Formato de Impress�o</b></a>
      <br><br>

<?
    if($mostrar_filtros!="")
    {
      include("painel_filtros.php"); 
    }
    else
    { 
?>
      <div id=link_painel_filtros><a href="javascript:esconder_div('link_painel_filtros');mostrar_div('painel_filtros');" class="caminho"><b>&nbsp;&nbsp;&nbsp;:: Op��es de Busca, Filtros e Ordena��o</b></a><br><br></div>

      <div id=painel_filtros style="display:none;"><?  include("painel_filtros.php"); ?></div>
<?
    }
  
    include("../_include/paginacao.php"); 
?>

    <br>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100%" height=30 bgcolor="#333333" align=center>
          <a class="caminho" href="inserir.php"><b><font color=#dddddd>:: Clique aqui para inserir novo(a) <? echo $sistema_singular; ?></font></b></a></td>
      </tr>
    </table>


      <br><br>

      <table cellspacing="0" cellpadding="0" width="100%">



<?      $j=0;
        while (($linha = mysql_fetch_array($rs_dados)) && ($j < $registros_por_pagina))
        {
          $j++; ?>

          <tr>
            <td height=1 bgcolor=#999999><img src=nada.gif width=1 height=1></td>
          </tr>
          <tr>
            <td width="100%" bgcolor="#cccccc" height=20>

              <font class="caminho">
<?
                for($cont=1;$cont<=$numero_campos;$cont++)
                {
                  $cont_ = (10 + $cont);
                  $cont1 = $cont_ . "1";
                  $cont2 = $cont_ . "2";
                  $cont3 = $cont_ . "3";
                  $cont5 = $cont_ . "5";
                  $cont6 = $cont_ . "6";
                  $cont7 = $cont_ . "7";
                  $cont8 = $cont_ . "8";
                  if($campos[$cont8]==1) 
                  {
                    switch ($campos[$cont3]) 
                    {

                      case "logico":
                        if($linha[$campos[$cont1]]==0)                                                                                                
                        {
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Não"; 
                        }
                        if($linha[$campos[$cont1]]==1)                                                                                                
                        {
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Sim"; 
                        }
 
                        break;
                      case "moeda":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> R$ " . number_format($linha[$campos[$cont1]],2,',','.'); 
                        break;
                      case "real":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . number_format($linha[$campos[$cont1]],3,',','.'); 
                        break;
                      case "hora":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
                        break;
                      case "hora_now":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
                        break;
                      case "data_int_now":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
                        break;
                      case "data_int":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
                        break;
                      case "data_date":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdata($linha[$campos[$cont1]]); 
                        break;
                      case "chave_estrangeira":

                        $sql_ce = " SELECT DISTINCT " . $campos[$cont7] . " FROM " . $campos[$cont6]; 

                        if(stripos($campos[$cont6],"WHERE"))
                        {
                          $sql_ce.= " AND " ;
                        }
                        else
                        {
                          $sql_ce.= " WHERE " ;
                        }

                        $sql_ce.= $campos[$cont5] . "=" . $linha[$campos[$cont1]];

                        $rs_ce = mysql_query($sql_ce, $conexao);
                        $linha_ce = mysql_fetch_array($rs_ce);

                        $campos_para_mostrar = explode(",",$campos[$cont7]);

                        $valores_para_mostrar="";

                        foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
                        {
                          $tracinho = "";

                          if($valores_para_mostrar!="")
                          {
                            $tracinho = " - ";
                          }
          
                          $valores_para_mostrar.= $tracinho;
                          $valores_para_mostrar.= $linha_ce["$nome_do_campo_para_mostrar"];
                        }



                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $valores_para_mostrar; 


                        break;
                      default:
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $linha[$campos[$cont1]]; 
                    }

                 }

                }  ?>

            </td>
          </tr>
          <tr>
            <td width="100%" bgcolor="#bbbbbb" height=20>

                &nbsp;&nbsp;
                <a onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar este(a) <? echo $sistema_singular; ?> ?\n\n****************************')" class="caminho" href="excluir_registro.php?pagina=<? echo $pagina; ?>&<? echo $chave_primaria; ?>=<? echo $linha[$chave_primaria]; ?>">>> Excluir <? echo $sistema_singular; ?></a>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="caminho" href="editar_dados.php?pagina=<? echo $pagina; ?>&<? echo $chave_primaria; ?>=<? echo $linha[$chave_primaria]; ?>">>> Editar <? echo $sistema_singular; ?></a>

<?              if($sistema_fotos==1)
                {  ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a class="caminho" href="editar_foto.php?pagina=<? echo $pagina; ?>&<? echo $chave_primaria; ?>=<? echo $linha[$chave_primaria]; ?>">>> Gerenciar Fotos</a>
<?              }  ?>

<?              if($sistema_documentos==1)
                {  ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a class="caminho" href="editar_documento.php?pagina=<? echo $pagina; ?>&<? echo $chave_primaria; ?>=<? echo $linha[$chave_primaria]; ?>">>> Gerenciar Documento</a>
<?              }  ?>

              </font></td>

          </tr>

          <tr>
            <td height=1 bgcolor=#333333><img src=nada.gif width=1 height=1></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>

<?      }  
        if($j==0)
        {  ?>

          <tr>
            <td height=20 width="100%" bgcolor="#ff0000">
              <font class="caminho">
                &nbsp;&nbsp;&nbsp;
                <b>Nenhum registro foi encontrado</b></font></td>
          </tr>

<?      }  ?>

      </table>

    <br>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100%" height=30 bgcolor="#333333" align=center>
          <a class="caminho" href="inserir.php"><b><font color=#dddddd>:: Clique aqui para inserir novo(a) <? echo $sistema_singular; ?></font></b></a></td>
      </tr>
    </table>


    </form>


  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");  
    }

?>