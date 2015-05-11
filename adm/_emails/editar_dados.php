<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

  

    include("../_include/topo.php"); 
    include("../../include/sistema_data.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../_include/funcao_form.php"); 
    include("configuracoes.php"); 



    $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_REQUEST[$chave_primaria], $conexao);
    $linha = mysql_fetch_array($rs_dados);



    barra("Menu Principal","../index.php",$sistema_plural,"painel.php","Editar " . $sistema_singular,"","","");  

?>

 
  <br>

    <form action="alterar.php" method="post">

      <input type="hidden" name="pagina" value="<? echo $_REQUEST['pagina']; ?>">
      <input type="hidden" name="<? echo $chave_primaria; ?>" value="<? echo $_REQUEST[$chave_primaria]; ?>">

      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="730" bgcolor="cccccc" align="center">

<?




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

    if($campos[$cont3]=="varchar")
    {
      echo "<br>";
      edit($campos[$cont2],$campos[$cont1],$campos[$cont4]);  
    }

    if($campos[$cont3]=="inteiro")
    {
      echo "<br>";
      edit_inteiro($campos[$cont2],$campos[$cont1],$campos[$cont4]);  
    }

    if($campos[$cont3]=="moeda")
    {
      echo "<br>";
      edit_moeda($campos[$cont2],$campos[$cont1],$campos[$cont4]);  
    }

    if($campos[$cont3]=="logico")
    {
      echo "<br>";
      check($campos[$cont2],$campos[$cont1]);  
    }

    if(($campos[$cont3]=="blob")||($campos[$cont3]=="blob_html"))
    {
      echo "<br><br>";
      textarea_edit($campos[$cont2],$campos[$cont1],$campos[$cont4]);  
    }

    if(($campos[$cont3]=="data_int")||($campos[$cont3]=="data_int_now"))
    {
      echo "<br>";
      data_int_edit($campos[$cont2],$campos[$cont1]);  
    }

    if(($campos[$cont3]=="data_date")||($campos[$cont3]=="data_date_now"))
    {
      echo "<br>";
      data_date_edit($campos[$cont2],$campos[$cont1]);  
    }

    if($campos[$cont3]=="hora")      
    {
      echo "<br>";
      hora_edit($campos[$cont2],$campos[$cont1]);  
    }

    if($campos[$cont3]=="hora_now")      
    {
      echo "<br>";
      hora_edit($campos[$cont2],$campos[$cont1]);  
    }

    if($campos[$cont3]=="chave_estrangeira")      
    {
      echo "<br><br>";
      select_edit($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7]);  
    }


  }



































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

    echo "<br><br>";
      select_multi_edit($campos_associativos[$conta2],$campos_associativos[$conta6],$campos_associativos[$conta5],$campos_associativos[$conta7],$campos_associativos[$conta8],$campos_associativos[$conta9]);  
  }





















  if($sistema_fotos==1)
  {  ?>

    <br><a class="caminho" href="editar_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>"><b>>> Gerenciar Fotos</b></a>

<?
  }
?>

            <br><br>

            <input class="submit" type="submit" value="Enviar Dados">

            <br>&nbsp;

          </td>

        </tr>

        <tr>
          <td>&nbsp;</td>
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