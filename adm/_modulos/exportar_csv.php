<?php
ob_start();
session_start();



if(ISSET($_SESSION['fw_codigo_usuario']))
{

  include("../../include/sistema_conexao.php"); 
  include("../_include/usuarios_acesso.php");
  include("../../include/sistema_protecao.php"); 
  include("../../include/sistema_zeros.php"); 
    
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
  $permissao = 1;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {



function retira_quebra_linha($variavel){

    
    $variavel = trim($variavel);
    $variavel = str_replace(";", ".", $variavel);
    $variavel = str_replace("\r", "", $variavel);
    $variavel = str_replace("\n", "", $variavel);
    $variavel = str_replace("\r\n", "", $variavel);
    $variavel = str_replace("\t", "", $variavel);
    //$variavel = str_replace(" ", "", $variavel);
    $variavel = preg_replace("/(<br.*?>)/i","", $variavel);

return $variavel;
}



// $table = $_REQUEST["table"]; // tabela que vai ser feita a sql
// $file = $_REQUEST["table"]; //nome do arquivo

$table = $tabela;
$file = $table;






 $result = mysql_query("SHOW COLUMNS FROM ".$table."");
 $i = 0;
 
 $csv_output  = "";

if (mysql_num_rows($result) > 0) {
while ($row = mysql_fetch_assoc($result)) {
$csv_output .= retira_quebra_linha($row['Field']).";";
$i++;}
}
$csv_output .= "\r\n";

 $values = mysql_query("SELECT * FROM ".$table."");
 
while ($rowr = mysql_fetch_row($values)) {
for ($j=0;$j<$i;$j++) {
$csv_output .= retira_quebra_linha($rowr[$j]).";";
}
$csv_output .= "\r\n";
}
 
$filename = $file."_".date("Y_m_d",time());
 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
 
print $csv_output;
 
exit;



}
  
  else
  {
    if(ISSET($_SERVER['HTTP_REFERER']))
    {
      $url = $_SERVER['HTTP_REFERER'];
    }
    else
    {
      $url = "../";
    }
    header("Location: " . $url);  

  }

}
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");
  }
  
  ob_end_flush();


?>