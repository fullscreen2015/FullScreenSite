<?

  $miniatura = "../_imagens/no-foto.gif";



    $nome_sistema_fotos_atual = $nome_sistema_fotos;
    $tipo_arquivo_pequeno_atual = $tipo_arquivo_pequeno;
    $numero_algarismos_atual = $numero_algarismos;
    $numero_algarismos_codigo_atual = $numero_algarismos_codigo;
    $tipo_sistema_fotos_atual = $tipo_sistema_fotos;

    $codigo_registro = $linha_relacionado[$chave_primaria_relacionado];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo_atual);  




    if($tipo_sistema_fotos_atual==1)
    {

      for($i=1;$i<=1000;$i++)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos_atual);  

        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno_atual;


        if (file_exists($nome_arquivo))
        {  
          $miniatura = $nome_arquivo;
        }  
      }  
    }  

    if($tipo_sistema_fotos_atual==2)
    {
      for($i=1;$i<=1000;$i++)
      {
        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos_atual);  

        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/" . $codigo_registro . "/thumbs/" . $m . "." . $tipo_arquivo_pequeno_atual;
        if (file_exists($nome_arquivo))
        {  
          $miniatura = $nome_arquivo;
        }  
      }  
    }  




    if($tipo_sistema_fotos_atual==3)
    {
      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;

      if (file_exists($nome_arquivo))
      {  
        $miniatura = $nome_arquivo;
      }
    }  





    if($tipo_sistema_fotos_atual==4)
    {

      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;

      if (file_exists($nome_arquivo))
      {  
        $miniatura = $nome_arquivo;
      }  
    }  





    if($tipo_sistema_fotos_atual==5)
    {

      for($i=1;$i<=1000;$i++)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos_atual);  


        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo_atual);  

        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno_atual;


        if (file_exists($nome_arquivo))
        {  
          $miniatura = $nome_arquivo;

        }  
      }  
    }  









    if($tipo_sistema_fotos_atual==6)
    {

      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;

      if (file_exists($nome_arquivo))
      {  
        $miniatura = $nome_arquivo;
      }  

    }  







    if($tipo_sistema_fotos_atual==7)
    {

      for($i=1000;$i>0;$i--)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos_atual);  


        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo_atual);  

        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno_atual;

        if (file_exists($nome_arquivo))
        {  
          $miniatura = $nome_arquivo;

        }  
      }  
    }  


?>
