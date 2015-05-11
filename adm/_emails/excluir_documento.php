<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php");
    include("configuracoes.php"); 

    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  

    $arquivo =  "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $_REQUEST['nome_arquivo'];

    if (file_exists($arquivo))
    {
      unlink($arquivo);
    }


    header("Location: editar_documento.php?" . $chave_primaria . "=" . $_REQUEST[$chave_primaria] . "&pagina=" . $_REQUEST['pagina']);  


    }
    else
    {
      header("Location: ../php_login.php");  
    }

?>