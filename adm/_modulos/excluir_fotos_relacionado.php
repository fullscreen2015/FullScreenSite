<?
  ob_start();
  session_start();

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php");

    $codigo_modulo = $_REQUEST['cm'];
    $codigo_modulo_relacionado = $_REQUEST['cmr'];
	include("../_configuracoes/" . zerosaesquerda($codigo_modulo_relacionado,6) . ".php"); 


    $chave_primaria_original = $_REQUEST['cpo'];
    $valor_chave_primaria_original = $_REQUEST['vcpo'];



    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = $_REQUEST['pagina'];
    }
    else
    {
      $pagina = "1";
    }



    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

    if($tipo_sistema_fotos==1)
    {
      for($j=1;$j<=1000;$j++)
      {

        $m = $j;
        $m = zerosaesquerda($m,$numero_algarismos);  

        $arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

        if (file_exists($arquivo))
        {
          unlink($arquivo);
        }

      }

    }


    if($tipo_sistema_fotos==3)
    {

      $arquivo =  "../../" . $nome_sistema_fotos. "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;
      $arquivo2 = "../../" . $nome_sistema_fotos. "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

      echo $arquivo;
      echo $arquivo2;


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

      $arquivo1 = "../../".$nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $arquivo2 = "../../".$nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

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

      for($j=1;$j<=1000;$j++)
      {

        $m = $j;
        $m = zerosaesquerda($m,$numero_algarismos);  
        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

        $arquivo =  "../../" . $nome_sistema_fotos .  "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;
        $arquivo2 =  "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


        if (file_exists($arquivo))
        {
          unlink($arquivo);
        }

        if (file_exists($arquivo2))
        {
          unlink($arquivo2);
        }

      }

    }



    if($tipo_sistema_fotos==6)
    {

      $arquivo1 =  "../../" . $nome_sistema_fotos. "/amp/" . $codigo_registro . "." . $tipo_arquivo_ampliado;
      $arquivo2 = "../../" . $nome_sistema_fotos. "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;
      $arquivo3 = "../../" . $nome_sistema_fotos. "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

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

      for($j=1;$j<=1000;$j++)
      {

        $m = $j;
        $m = zerosaesquerda($m,$numero_algarismos);  
        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

        $arquivo1 =  "../../" . $nome_sistema_fotos .  "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;
        $arquivo2 =  "../../" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;
        $arquivo3 =  "../../" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


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

    }


    header("location: editar_dados.php?codigo_modulo=" . $codigo_modulo . "&pagina=".$pagina . "&" . $chave_primaria_original . "=" . $valor_chave_primaria_original);



  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }
  
  ob_end_flush();
?>