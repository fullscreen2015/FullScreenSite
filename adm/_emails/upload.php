<?



  session_start(); 

  $caminho = realpath("../..");

  include("../../include/sistema_zeros.php");
  include("../_include/genthumbs.php");
  include("configuracoes.php");



  $erros_amp_upload = 0;
  $erros_foto_upload = 0;
  $erros_thumbs_upload = 0;

  $acertos = "";
  $errors = "";

  $codigo_registro = $_SESSION['session_codigo_registro'];
  $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

  $redimensionamento_automatico = $_SESSION['red'];




if($redimensionamento_automatico==1)
{  

  if(is_uploaded_file($_FILES['foto_upload']['tmp_name'])) 
  {


    if(ISSET($_FILES['foto_upload']))
    {



      if($tipo_arquivo_grande=="gif")
      {

        if ($_FILES['foto_upload']['type'] <> "image/gif")
        {
          $erros_foto_upload++;
          $errors = $errors."Tipo de arquivo inv�lido (foto grande)<br>";
        }
      }

      if($tipo_arquivo_grande=="jpg")
      {
        if (($_FILES['foto_upload']['type'] <> "image/jpg") AND ($_FILES['foto_upload']['type'] <> "image/pjpeg") AND ($_FILES['foto_upload']['type'] <> "image/jpeg") AND ($_FILES['foto_upload']['type'] <> "image/jpe") AND ($_FILES['foto_upload']['type'] <> "image/jfif") AND ($_FILES['foto_upload']['type'] <> "image/pjp") AND ($_FILES['foto_upload']['type'] <> "image/JPG"))
        {
          $erros_foto_upload++;
          $errors = $errors."Tipo de arquivo inv�lido<br>";
        }
      }


      if($tipo_arquivo_grande=="png")
      {
        if ($_FILES['foto_upload']['type'] <> "image/png")
        {
          $erros_foto_upload++;
          $errors = $errors."Tipo de arquivo inv�lido<br>";
        }
      }

      if ($_FILES['foto_upload']['size'] > $tamanho_maximo_foto) 
      { 
        $erros_foto_upload++;
        $errors = $errors."O tamanho do arquivo � maior que " . $tamanho_maximo_foto . " bytes (foto grande)<br>";
      }

    }










    if($tipo_sistema_fotos==1)
    {
      if($erros_foto_upload == 0)
      {

        $indice_foto=1;
 
        for($i=1;$i<=1000;$i++)
        {
 
          $m = zerosaesquerda($i,$numero_algarismos);  

          $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

          if (file_exists($nome_arquivo))
          {  
            $indice_foto = $i+1;
          }  
        }  

        $indice_registro = $indice_foto;
        $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  





        

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";

        $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;


        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }










    if($tipo_sistema_fotos==3)
    {
      if($erros_foto_upload == 0)
      {

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

        $pasta_foto = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/";
        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";

        $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;


        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        // Criando Foto
        cria_arquivo($caminho_arquivo_original,$pasta_foto,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }













    if($tipo_sistema_fotos==4)
    {
      if($erros_foto_upload == 0)
      {

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";

        $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;


        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }













    if($tipo_sistema_fotos==5)
    {
      if($erros_foto_upload == 0)
      {

        $indice_foto=1;
 
        for($i=1;$i<=1000;$i++)
        {
 
          $m = zerosaesquerda($i,$numero_algarismos);  

          $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

          if (file_exists($nome_arquivo))
          {  
            $indice_foto = $i+1;
          }  
        }  

        $indice_registro = $indice_foto;
        $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  





        

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";
        $pasta_fotos = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/";

        $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;


        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        // Criando Foto
        cria_arquivo($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }









    if($tipo_sistema_fotos==6)
    {
      if($erros_foto_upload == 0)
      {

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

        $pasta_amp = $caminho . "/imagens/" . $nome_sistema_fotos . "/amp/";
        $pasta_foto = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/";
        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";

        $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;


        // Criando AMP
        cria_arquivo($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp);

        // Criando Foto
        cria_arquivo($caminho_arquivo_original,$pasta_foto,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);


      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }














    if($tipo_sistema_fotos==7)
    {
      if($erros_foto_upload == 0)
      {

        $indice_foto=1;
 
        for($i=1;$i<=1000;$i++)
        {
 
          $m = zerosaesquerda($i,$numero_algarismos);  

          $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

          if (file_exists($nome_arquivo))
          {  
            $indice_foto = $i+1;
          }  
        }  

        $indice_registro = $indice_foto;
        $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  





        

        copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


        $acertos = $acertos . "Fotos enviadas com sucesso<br>";
        $errors = "Nenhum<br>";


        //Cria thumbnail
 
        $caminho_arquivo_original = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

        $pasta_thumbs = $caminho . "/imagens/" . $nome_sistema_fotos . "/thumbs/";
        $pasta_fotos = $caminho . "/imagens/" . $nome_sistema_fotos . "/fotos/";
        $pasta_amp = $caminho . "/imagens/" . $nome_sistema_fotos . "/amp/";

        $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;


        // Criando Amp
        cria_arquivo($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp);

        // Criando Thumbs
        cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        // Criando Foto
        cria_arquivo($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

      }
      else
      {
        $acertos = "Ocorreu um erro!";
        $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
      }
    }







  }
  else
  {
    $acertos = "Ocorreu um erro!";
    $errors.= "<br>Contacte a Friweb.";
  }
















}
else
{















  // FOTO AMPLIADA

  if(ISSET($_FILES['amp_upload']))
  {

    if($tipo_arquivo_ampliado=="gif")
    {

      if ($_FILES['amp_upload']['type'] <> "image/gif")
      {
        $erros_amp_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto ampliada)<br>";
      }
    }

    if($tipo_arquivo_ampliado=="jpg")
    {
      if (($_FILES['amp_upload']['type'] <> "image/jpg") AND ($_FILES['amp_upload']['type'] <> "image/pjpeg"))
      {
        $erros_amp_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto ampliada)<br>";
      }
    }



    if ($_FILES['amp_upload']['size'] > $tamanho_maximo_amp) 
    { 
      $erros_amp_upload++;
      $errors = $errors."O tamanho do arquivo � maior que " . $tamanho_maximo_amp . " bytes (foto ampliada)<br>";
    }

    $imgsize = GetImageSize($_FILES['amp_upload']['tmp_name']); 
    $largura = $imgsize[0]; 
    $altura = $imgsize[1]; 

    if($largura_amp!=0)
    {
      if ($largura!=$largura_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo não tem " . $largura_amp . " pixels de largura<br>";
      }
    }

    if($altura_amp!=0)
    {
      if ($altura!=$altura_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo não tem " . $altura_amp . " pixels de altura<br>";
      }
    }

    if($largura_maxima_amp!=0)
    {
      if ($largura>$largura_maxima_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo tem mais que " . $largura_maxima_amp . " pixels de largura<br>";
      }
    }

    if($altura_maxima_amp!=0)
    {
      if ($altura>$altura_maxima_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo tem mais que " . $altura_maxima_amp . " pixels de altura<br>";
      }
    }

    if($largura_minima_amp!=0)
    {
      if ($largura<$largura_minima_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo tem menos que " . $largura_minima_amp . " pixels de largura<br>";
      }
    }

    if($altura_minima_amp!=0)
    {
      if ($altura<$altura_minima_amp)
      { 
        $erros_amp_upload++;
        $errors = $errors . "O arquivo tem menos que " . $altura_minima_amp . " pixels de altura<br>";
      }
    }


  }









  // FOTO GRANDE

  if(ISSET($_FILES['foto_upload']))
  {

    if($tipo_arquivo_grande=="gif")
    {

      if ($_FILES['foto_upload']['type'] <> "image/gif")
      {
        $erros_foto_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto grande)<br>";
      }
    }

    if($tipo_arquivo_grande=="jpg")
    {
      if (($_FILES['foto_upload']['type'] <> "image/jpg") AND ($_FILES['foto_upload']['type'] <> "image/pjpeg"))
      {
        $erros_foto_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto grande)<br>";
      }
    }



    if ($_FILES['foto_upload']['size'] > $tamanho_maximo_foto) 
    { 
      $erros_foto_upload++;
      $errors = $errors."O tamanho do arquivo � maior que " . $tamanho_maximo_foto . " bytes (foto grande)<br>";
    }

    $imgsize = GetImageSize($_FILES['foto_upload']['tmp_name']); 
    $largura = $imgsize[0]; 
    $altura = $imgsize[1]; 

    if($largura_foto!=0)
    {
      if ($largura!=$largura_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo não tem " . $largura_foto . " pixels de largura<br>";
      }
    }

    if($altura_foto!=0)
    {
      if ($altura!=$altura_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo não tem " . $altura_foto . " pixels de altura<br>";
      }
    }

    if($largura_maxima_foto!=0)
    {
      if ($largura>$largura_maxima_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo tem mais que " . $largura_maxima_foto . " pixels de largura<br>";
      }
    }

    if($altura_maxima_foto!=0)
    {
      if ($altura>$altura_maxima_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo tem mais que " . $altura_maxima_foto . " pixels de altura<br>";
      }
    }

    if($largura_minima_foto!=0)
    {
      if ($largura<$largura_minima_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo tem menos que " . $largura_minima_foto . " pixels de largura<br>";
      }
    }

    if($altura_minima_foto!=0)
    {
      if ($altura<$altura_minima_foto)
      { 
        $erros_foto_upload++;
        $errors = $errors . "O arquivo tem menos que " . $altura_minima_foto . " pixels de altura<br>";
      }
    }


  }












  // FOTO PEQUENA

  if(ISSET($_FILES['thumbs_upload']))
  {

    if($tipo_arquivo_pequeno=="gif")
    {
      if ($_FILES['thumbs_upload']['type'] <> "image/gif")
      {
        $erros_thumbs_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto pequena)<br>";
      }
    }

    if($tipo_arquivo_pequeno=="jpg")
    {
      if (($_FILES['thumbs_upload']['type'] <> "image/jpg") AND ($_FILES['thumbs_upload']['type'] <> "image/pjpeg"))
      {
        $erros_thumbs_upload++;
        $errors = $errors."Tipo de arquivo inv�lido (foto pequena)<br>";
      }
    }


    if ($_FILES['thumbs_upload']['size'] > $tamanho_maximo_thumbs) 
    { 
      $erros_thumbs_upload++;
      $errors = $errors."O tamanho do arquivo � maior que " . $tamanho_maximo_thumbs. " bytes (foto pequena)<br>";
    }

    $imgsize = GetImageSize($_FILES['thumbs_upload']['tmp_name']); 
    $largura = $imgsize[0]; 
    $altura = $imgsize[1]; 

    if($largura_thumbs!=0)
    {
      if ($largura!=$largura_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo não tem " . $largura_thumbs . " pixels de largura<br>";
      }
    }

    if($altura_thumbs!=0)
    {
      if ($altura!=$altura_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo não tem " . $altura_thumbs . " pixels de altura<br>";
      }
    }

    if($largura_maxima_thumbs!=0)
    {
      if ($largura>$largura_maxima_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo tem mais que " . $largura_maxima_thumbs . " pixels de largura<br>";
      }
    }

    if($altura_maxima_thumbs!=0)
    {
      if ($altura>$altura_maxima_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo tem mais que " . $altura_maxima_thumbs . " pixels de altura<br>";
      }
    }

    if($largura_minima_thumbs!=0)
    {
      if ($largura<$largura_minima_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo tem menos que " . $largura_minima_thumbs . " pixels de largura<br>";
      }
    }

    if($altura_minima_thumbs!=0)
    {
      if ($altura<$altura_minima_thumbs)
      { 
        $erros_thumbs_upload++;
        $errors = $errors . "O arquivo tem menos que " . $altura_minima_thumbs . " pixels de altura<br>";
      }
    }


  }






  if($tipo_sistema_fotos==1)
  {

    $indice_foto=1;
 
    for($i=1;$i<=1000;$i++)
    {
 
      $m = $i;
      $m = zerosaesquerda($m,$numero_algarismos);  

      $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  


    if($erros_thumbs_upload == 0)
    {

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 


      $acertos = $acertos . "Foto pequena enviada com sucesso<br>";
      $errors = "Nenhum<br>";
    }

  }







  if($tipo_sistema_fotos==2)
  {

    $indice_foto=1;

    for($i=1;$i<=1000;$i++)
    {
 
      $m = $i;
      $m = zerosaesquerda($m,$numero_algarismos);  

      $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/" . $codigo_registro . "/thumbs/" . $m . "." . $tipo_arquivo_pequeno;
      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  


    if($erros_foto_upload == 0)
    {


      copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/" . $codigo_registro .  "/fotos/" . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


      $acertos = $acertos . "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      //Cria thumbnail
 
      $caminho_mascara = $caminho."/imagens/fotos/mascara.png";
      $caminho_foto = $caminho."/imagens/fotos/" . $codigo_evento3 . "/fotos/" . $indice_foto3 . "." . $tipo_arquivo_grande;
      $caminho_thumbs = $caminho."/imagens/fotos/" . $codigo_evento3 . "/thumbs/";
      $nome_thumbs = $indice_foto3 . "." . $tipo_arquivo_pequeno;

      redimensiona($caminho_foto,640,480);
      insere_mascara($caminho_foto, $caminho_mascara, $caminho_foto,1,100);
      cria_thumbs($caminho_foto,$caminho_thumbs,$nome_thumbs,50,50,30);


    }

  }






  if($tipo_sistema_fotos==3)
  {

    if(($erros_foto_upload == 0)&&($erros_thumbs_upload == 0))
    {

      copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno); 

      $acertos = $acertos . "Fotos enviadas com sucesso<br>";
      $errors = "Nenhum<br>";
    }
    else
    {

      $acertos = "Ocorreu um erro!";
      $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
    }

  }





  if($tipo_sistema_fotos==4)
  {

    if($erros_thumbs_upload == 0)
    {

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "." . $tipo_arquivo_pequeno); 


      $acertos = $acertos . "Foto enviada com sucesso<br>";
      $errors = "Nenhum<br>";
    }
    else
    {
      $acertos = "Ocorreu um erro!";
      $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
    }

  }

















  if($tipo_sistema_fotos==5)
  {

    $indice_foto=1;
 
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

    for($i=1;$i<=1000;$i++)
    {
 
      $m = $i;
      $m = zerosaesquerda($m,$numero_algarismos);  

      $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  



    if(($erros_foto_upload == 0)&&($erros_thumbs_upload == 0))
    {
      copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 

      $acertos.= "Foto pequena enviada com sucesso<br>";
      $errors = "Nenhum<br>";
    }
    else
    {
      $acertos.= "Ocorreu um erro<br>";
      $errors = "Envio de fotos cancelado. Por favor, enviar novamente.<br>";

    }
  }










  if($tipo_sistema_fotos==6)
  {

    if(($erros_thumbs_upload == 0)&&($erros_foto_upload == 0)&&($erros_amp_upload == 0))
    {

      copy($_FILES['amp_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "." . $tipo_arquivo_ampliado); 

      copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno); 

      $acertos = $acertos . "Fotos enviadas com sucesso<br>";
      $errors = "Nenhum<br>";
    }
    else
    {

      $acertos = "Ocorreu um erro!";
      $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
    }

  }





















  if($tipo_sistema_fotos==7)
  {

    $indice_foto=1;
 
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

    for($i=1;$i<=1000;$i++)
    {
 
      $m = $i;
      $m = zerosaesquerda($m,$numero_algarismos);  

      $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  



    if(($erros_foto_upload == 0)&&($erros_thumbs_upload == 0))
    {


      copy($_FILES['amp_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Amplia��o enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['foto_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 

      $acertos.= "Foto pequena enviada com sucesso<br>";
      $errors = "Nenhum<br>";
    }
    else
    {
      $acertos.= "Ocorreu um erro<br>";
      $errors = "Envio de fotos cancelado. Por favor, enviar novamente.<br>";

    }
  }
}







    header("Location: foto_enviada.php?acertos=".$acertos."&erros=".$errors); 
?>




