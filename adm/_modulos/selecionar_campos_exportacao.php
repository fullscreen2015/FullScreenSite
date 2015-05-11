<?php
  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


  include("../../include/sistema_conexao.php"); 
  include("../../include/sistema_data.php"); 

  include("../../include/sistema_protecao.php"); 
  include("../../include/sistema_zeros.php"); 
  
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  

  function retira_quebra_linha($variavel){
    
    $variavel = trim($variavel);
    $variavel = str_replace("\r", "", $variavel);
    $variavel = str_replace("\n", "", $variavel);
    $variavel = str_replace("\r\n", "", $variavel);
    $variavel = str_replace("\t", "", $variavel);
    //$variavel = str_replace(" ", "", $variavel);
    $variavel = preg_replace("/(<br.*?>)/i","", $variavel);

return $variavel;
}



  $sql = urldecode($_REQUEST['sql']);
  $sql = str_replace("\'", "'", $sql);
  $sql = strtolower($sql);
  $sql = str_replace("update", "erro", $sql);
  $sql = str_replace("alter table", "erro", $sql);
  $sql = str_replace("insert", "erro", $sql);
  $sql = str_replace("delete", "erro", $sql);
  $sql = str_replace("drop table", "erro", $sql);
  $sql = str_replace("show tables", "erro", $sql);



$data = "";

  $rs_dados = mysql_query($sql, $conexao);

  ?>


  

<table>
<form name="seleciona_campos"  action="exportar_exibicao.php" method="post">

<input type="hiddens" name="sql" value="<?=$_REQUEST['sql'];?>">
<input type="hiddens" name="pagina" value="<?=$_REQUEST['pagina'];?>">
<input type="hiddens" name="codigo_modulo" value="<?=$_REQUEST['codigo_modulo'];?>">
<input type="hiddens" name="table" value="<?=$_REQUEST['table'];?>">



  <?

          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $cont_ = (10 + $cont);
            $cont1 = $cont_ . "1";
            $cont2 = $cont_ . "2";
            $cont9 = $cont_ . "9";
           // if($campos[$cont9]==1) 
           // {

              ?>

            <tr><td>
              <input type="checkbox" name="campos_selecionados[]" value="<?=$cont;?>">
              <?
              echo $campos[$cont2];
              //$data .= retira_quebra_linha($campos[$cont2]).";";

            ?>

          </td></tr>

            <?

           // }

              
          }  

         

?>

<td><tr>
  <input type="submit" name="exportar" value="Exportar">
</td></tr>
</form>
</table>

   


<?

//================================================================
  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");
  }
  
  ob_end_flush();


 





?>