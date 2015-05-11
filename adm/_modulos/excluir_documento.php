<?php

  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php");
    include("../../include/sistema_protecao.php");
	
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  




    // $arquivo =  "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $_REQUEST['nome_arquivo'];

    $arquivo =  "../../" . $pasta_documentos . "/" . $_REQUEST['nome_arquivo'];


    if (file_exists($arquivo))
    {
      unlink($arquivo);
    }


    header("Location: editar_documento.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria] . "&pagina=" . $_REQUEST['pagina']);  


  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }


  ob_end_flush();
?>