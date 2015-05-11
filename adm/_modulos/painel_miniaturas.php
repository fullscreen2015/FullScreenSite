<?

  $miniatura = "../_imagens/no-foto.gif";
  $preview = "../_imagens/no-foto.gif";



  // recolhendo dados do arquivo de configuracao

  if($exibicao_no_painel==1)
  {
    $nome_sistema_fotos_atual = $nome_sistema_fotos;
    $tipo_arquivo_pequeno_atual = $tipo_arquivo_pequeno;
    $numero_algarismos_atual = $numero_algarismos;
    $numero_algarismos_codigo_atual = $numero_algarismos_codigo;
    $tipo_sistema_fotos_atual = $tipo_sistema_fotos;

    $codigo_registro = $linha[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo_atual);

    $link_gerenciar_fotos = 'editar_foto.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] ;
  }


  if($exibicao_no_painel==2)
  {
    $chave_primaria_original = $chave_primaria;

    $dados_sfr = importa_sfr($fotos_sistema_associado);


    $codigo_registro = $dados_sfr[1];
    $nome_sistema_fotos_atual = $dados_sfr[2];
    $tipo_arquivo_pequeno_atual = $dados_sfr[3];
    $numero_algarismos_atual = $dados_sfr[4];
    $numero_algarismos_codigo_atual = $dados_sfr[5];
    $tipo_sistema_fotos_atual = $dados_sfr[6];


    if($codigo_registro!="")
    {
      $link_gerenciar_fotos = "painel.php?codigo_modulo=".$fotos_sistema_associado."&".$chave_primaria."=" . $linha[$chave_primaria];
      $nome_link_gerenciar_fotos = "Gerenciar Fotos";


      //link alterado para ir para lista de fotos do produto ao clicar na miniatura do produdo la listagem do painel
      
      /*$link_gerenciar_fotos = "../" . $fotos_sistema_associado . "/painel.php?".$chave_primaria."=" . $linha[$chave_primaria];
      $nome_link_gerenciar_fotos = "Gerenciar Fotos";*/


    }
    else
    {
      $link_gerenciar_fotos = "../" . $fotos_sistema_associado . "/inserir.php";
      $nome_link_gerenciar_fotos = "Inserir Foto";
    }



    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo_atual);  

  }


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

        $preview = $miniatura;

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

        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/" . $codigo_registro . "/fotos/" . $m . "." . $tipo_arquivo_pequeno_atual;
        if (file_exists($nome_arquivo))
        {  
          $preview = $nome_arquivo;
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


      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;


      if (file_exists($nome_arquivo))
      {  
        $preview = $nome_arquivo;
      }

    }  





    if($tipo_sistema_fotos_atual==4)
    {

      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;

      if (file_exists($nome_arquivo))
      {  
        $miniatura = $nome_arquivo;
      }  

      $preview = $miniatura;

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


        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno_atual;

        if (file_exists($nome_arquivo))
        {  
          $preview = $nome_arquivo;
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


      $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno_atual;

      if (file_exists($nome_arquivo))
      {  
        $preview = $nome_arquivo;
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


        $nome_arquivo = "../../" . $nome_sistema_fotos_atual . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno_atual;

        if (file_exists($nome_arquivo))
        {  
          $preview = $nome_arquivo;

        }  

      }  
    }  



  echo '<td width=40 align=center bgcolor=#ffffff>';
  echo '<a href="' . $link_gerenciar_fotos . '"';
  echo " rel='" . $preview . "'  class='preview'";
  echo '>';
  echo '<img src="' . $miniatura . '?' . rand(0,9999) . '" height=40 border=0></a></td>';

?>
