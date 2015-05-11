<?php
ob_start();

  session_start(); 

	header("Content-Type: text/html; charset=ISO-8859-1",true);


 /* include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");


$sql_nome = "SELECT * FROM tabela_adm_usuarios WHERE codigo_usuario='".$_SESSION['fw_codigo_usuario']."' ";
$query_nome = mysql_query($sql_nome);
$linha_nome = mysql_fetch_array($query_nome);*/

?>	
<b>
<p>Olá, <? echo $_SESSION["nome_usuario"];?>!</p>
<p>Seja bem vindo ao sistema</p>
</b>