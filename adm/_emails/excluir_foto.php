<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php");
    include("configuracoes.php"); 

    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

    if($tipo_sistema_fotos==1)
    {

      $j = $_REQUEST['indice_foto'];

      $m = $j;
      $m = zerosaesquerda($m,$numero_algarismos);  

      $arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" .$codigo_registro ."_". $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($arquivo))
      {
        unlink($arquivo);
      }

    }

    if($tipo_sistema_fotos==3)
    {

      $arquivo =  "../../imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;
      $arquivo2 = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

      if (file_exists($arquivo))
      {
        unlink($arquivo);
      }

      if (file_exists($arquivo2))
      {
        unlink($arquivo2);
      }

    }





    if($tipo_sistema_fotos==4)
    {

      $arquivo1 = "../../imagens/".$nome_sistema_fotos. "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $arquivo2 = "../../imagens/".$nome_sistema_fotos. "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

      if (file_exists($arquivo1))
      {
        unlink($arquivo1);
      }


      if (file_exists($arquivo2))
      {
        unlink($arquivo2);
      }

    }




    if($tipo_sistema_fotos==5)
    {

      $j = $_REQUEST['indice_foto'];

      $m = $j;
      $m = zerosaesquerda($m,$numero_algarismos);  
      $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

      $arquivo =  "../../imagens/" . $nome_sistema_fotos .  "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;
      $arquivo2 =  "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


      if (file_exists($arquivo))
      {
        unlink($arquivo);
      }

      if (file_exists($arquivo2))
      {
        unlink($arquivo2);
      }

    }







    if($tipo_sistema_fotos==6)
    {

      $arquivo1 =  "../../imagens/".$nome_sistema_fotos . "/amp/" . $codigo_registro . "." . $tipo_arquivo_ampliado;
      $arquivo2 = "../../imagens/".$nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;
      $arquivo3 = "../../imagens/".$nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;


      if (file_exists($arquivo1))
      {
        unlink($arquivo1);
      }

      if (file_exists($arquivo2))
      {
        unlink($arquivo2);
      }

      if (file_exists($arquivo3))
      {
        unlink($arquivo3);
      }

    }








    if($tipo_sistema_fotos==7)
    {

      $j = $_REQUEST['indice_foto'];

      $m = $j;
      $m = zerosaesquerda($m,$numero_algarismos);  
      $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

      $arquivo1 =  "../../imagens/" . $nome_sistema_fotos .  "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;
      $arquivo2 =  "../../imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;
      $arquivo3 =  "../../imagens/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


      if (file_exists($arquivo1))
      {
        unlink($arquivo1);
      }

      if (file_exists($arquivo2))
      {
        unlink($arquivo2);
      }

      if (file_exists($arquivo3))
      {
        unlink($arquivo3);
      }


    }






    header("Location: editar_foto.php?" . $chave_primaria . "=" . $_REQUEST[$chave_primaria] . "&red=" . $_REQUEST['red']);  


    }
    else
    {
      header("Location: ../php_login.php");  
    }

?>