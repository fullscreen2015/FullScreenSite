<?php

  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../../include/sistema_data.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_protecao.php"); 


    $codigo_produto = utf8_decode($_REQUEST['codigo_produto']);
    $codigo_produto = (int)anti_injection($codigo_produto);

    $sql = " UPDATE tabela_ec_produtos_detalhes ";
    $sql.= " SET comprado=1 ";
    $sql.= " , data_marcacao_comprado=" . date("Ymd");
    $sql.= " WHERE codigo_produto=" . $codigo_produto;

    mysql_query($sql,$conexao);

    echo "produto comprado em " . fwdatai(date("Ymd"));

  }

?>