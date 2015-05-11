<?php

  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {













  $caminho = realpath("../..");

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_zeros.php");
  include("../../include/sistema_protecao.php");
  include("../_include/genthumbs.php");

  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

  

  $pasta = basename(getcwd());

  $erros_amp_upload = 0;
  $erros_foto_upload = 0;
  $erros_thumbs_upload = 0;

  $acertos = "";
  $errors = "";

  $codigo_registro = $_SESSION['session_codigo_registro'];
  $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  



if($_POST['modo']=="com")
{  


  if(is_uploaded_file($_FILES['foto_upload']['tmp_name'])) 
  {


    if(ISSET($_FILES['foto_upload']))
    {



      $tipo_arquivo_original = "";

      if ($_FILES['foto_upload']['type'] == "image/gif")
      {
        $tipo_arquivo_original = "gif";
      }

      if (($_FILES['foto_upload']['type'] == "image/jpg") || ($_FILES['foto_upload']['type'] == "image/pjpeg") || ($_FILES['foto_upload']['type'] == "image/jpeg") || ($_FILES['foto_upload']['type'] == "image/jpe") || ($_FILES['foto_upload']['type'] == "image/jfif") || ($_FILES['foto_upload']['type'] == "image/pjp") || ($_FILES['foto_upload']['type'] == "image/JPG"))
      {
        $tipo_arquivo_original = "jpg";
      }

      if (($_FILES['foto_upload']['type'] == "image/png")||($_FILES['foto_upload']['type'] == "image/x-png"))
      {
        $tipo_arquivo_original = "png";
      }


 



      if($tipo_arquivo_original=="")
      {
        $erros_foto_upload++;
        $errors = $errors."Tipo de arquivo inv�lido<br>";
      }





      if ($_FILES['foto_upload']['size'] > $tamanho_maximo_imagem) 
      { 
        $erros_foto_upload++;
        $errors = $errors."O tamanho do arquivo � maior que " . $tamanho_maximo_imagem . " bytes (foto grande)<br>";
      }



      // No caso do redimensionamento automático 2 (com seleção), � necessário testar a largura e altura da foto enviada.

      if($redimensionamento_automatico==2)
      {
        $imgsize = GetImageSize($_FILES['foto_upload']['tmp_name']); 
        $largura = $imgsize[0]; 
        $altura = $imgsize[1]; 

        if($largura_minima!=0)
        {
          if ($largura<$largura_minima)
          { 
            $erros_foto_upload++;
            $errors = $errors . "O arquivo tem menos que " . $largura_minima . " pixels de largura<br>";
          }
        }

        if($altura_minima!=0)
        {
          if ($altura<$altura_minima)
          { 
            $erros_foto_upload++;
            $errors = $errors . "O arquivo tem menos que " . $altura_minima . " pixels de altura<br>";
          }
        }

        //////////////////LARGURA E ALTURA M�XIMAS /////////////////////

        if($largura_maxima!=0)
        {
          if ($largura>$largura_maxima)
          { 
            $erros_foto_upload++;
            $errors = $errors . "O arquivo tem mais que " . $largura_maxima . " pixels de largura<br>";
          }
        }

        if($altura_maxima!=0)
        {
          if ($altura>$altura_maxima)
          { 
            $erros_foto_upload++;
            $errors = $errors . "O arquivo tem mais que " . $altura_maxima . " pixels de altura<br>";
          }
        }

        /////////////////////////////////////////////////////////////////
      }




    }





    if($erros_foto_upload == 0)
    {





      // ################### REDIMENSIONAMENTO COM seleção ##################################


      if($redimensionamento_automatico==2)
      {




        // Os sistemas de tipo 1, 5 e 7 possuem mais de uma foto por registro. Por isso, percorremos todas as fotos at� encontrar a �ltima e somar 1 para ter o �ndice da pr�xima

        if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $ultimo_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

            if (file_exists($ultimo_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_original;  
        }
        


        // Os sistemas de tipo 3, 4 e 6 possuem somente uma foto por registro.

        if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
        {
          $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_original;  


          // apagando o arquivo original anterior para evitar problemas

          $original_atual = "../../" . $nome_sistema_fotos . "/originais/" . $nome_arquivo;

          if(file_exists($original_atual))
          {
            unlink($original_atual);
          }


        }



        $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/originais/" . $nome_arquivo;

        copy($_FILES['foto_upload']['tmp_name'], $caminho_arquivo_original); 





        if(!(ISSET($criar_borda)))
        {
          $criar_borda = "0";
        }

        if($criar_borda==1)
        {


          $pasta_arquivo_final = "../../" . $nome_sistema_fotos . "/originais" ;


          $hw = getimagesize($caminho_arquivo_original);
          $largura_original = $hw["0"];
          $altura_original = $hw["1"];

          $tamanho_maior = $altura_original;
          if($largura_original>$altura_original)
          {
            $tamanho_maior = $largura_original;
          }

          $largura_borda = (int)$tamanho_maior/2;

          $largura_final = $tamanho_maior + $largura_borda;
          $altura_final = $largura_final;

          cria_borda($caminho_arquivo_original,$pasta_arquivo_final,$nome_arquivo,$largura_final,$altura_final,$largura_original,$altura_original,$r,$g,$b);

        }



        // Redireciona
        header("location: ../_recorta/index.php?codigo_modulo=" . $codigo_modulo . "&caminho=" . $caminho_arquivo_original . "&pasta=" . $nome_sistema_fotos . "&arquivo=" . $nome_arquivo . "&sistema=" . $pasta . "&cod=" . $codigo_registro);
        exit();
      }







      // ################### REDIMENSIONAMENTO automático ##################################


      if($redimensionamento_automatico==1)
      {



        if($tipo_sistema_fotos==1)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  

          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

          $acertos = $acertos . "Fotos enviadas com sucesso<br>";
          $errors = "Nenhum<br>";

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        }




        if($tipo_sistema_fotos==3)
        {
 
          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

          $acertos = $acertos . "Fotos enviadas com sucesso<br>";
          $errors = "Nenhum<br>";

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_foto = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo_foto = $codigo_registro . "." . $tipo_arquivo_grande;
          $nome_arquivo_thumbs = $codigo_registro . "." . $tipo_arquivo_pequeno;


          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo_thumbs,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

          // Criando Foto
          cria_arquivo($caminho_arquivo_original,$pasta_foto,$nome_arquivo_foto,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

        }





        if($tipo_sistema_fotos==4)
        {

          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

          $acertos = $acertos . "Fotos enviadas com sucesso<br>";
          $errors = "Nenhum<br>";

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;

          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        }






        if($tipo_sistema_fotos==5)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  
       

          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";
          $pasta_fotos = $caminho . "/" . $nome_sistema_fotos . "/fotos/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);
 
          // Criando Foto
          cria_arquivo($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

        }






        if($tipo_sistema_fotos==6)
        {

          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 


          $acertos = $acertos . "Fotos enviadas com sucesso<br>";
          $errors = "Nenhum<br>";


          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_amp = $caminho . "/" . $nome_sistema_fotos . "/amp/";
          $pasta_foto = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;


          // Criando AMP
          cria_arquivo($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp);

          // Criando Foto
          cria_arquivo($caminho_arquivo_original,$pasta_foto,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);

          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

        }







        if($tipo_sistema_fotos==7)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  
       

          copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";
          $pasta_fotos = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_amp = $caminho . "/" . $nome_sistema_fotos . "/amp/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          // Criando Amp
          cria_arquivo($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp);

          // Criando Thumbs
          cria_arquivo($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs);

          // Criando Foto
          cria_arquivo($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto);
        }



      }


      $acertos = $acertos . "Foto enviada com sucesso<br>";
      $errors = "Nenhum<br>";

    }
    else
    {
      $acertos = "Ocorreu um erro!";
      $errors.= "<br>Envio de fotos cancelado. Por favor, enviar novamente.";
    }

  }
  else
  {
    $acertos = "Ocorreu um erro!";
    $errors.= "<br>Verifique se o arquivo enviado não tem mais bytes que o permitido.";
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
      if (($_FILES['amp_upload']['type'] <> "image/jpg") AND ($_FILES['amp_upload']['type'] <> "image/pjpeg") AND ($_FILES['amp_upload']['type'] <> "image/jpeg") AND ($_FILES['amp_upload']['type'] <> "image/jpe") AND ($_FILES['amp_upload']['type'] <> "image/jfif") AND ($_FILES['amp_upload']['type'] <> "image/pjp") AND ($_FILES['amp_upload']['type'] <> "image/JPG"))
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
      if (($_FILES['foto_upload']['type'] <> "image/jpg") AND ($_FILES['foto_upload']['type'] <> "image/pjpeg") AND ($_FILES['foto_upload']['type'] <> "image/jpeg") AND ($_FILES['foto_upload']['type'] <> "image/jpe") AND ($_FILES['foto_upload']['type'] <> "image/jfif") AND ($_FILES['foto_upload']['type'] <> "image/pjp") AND ($_FILES['foto_upload']['type'] <> "image/JPG"))
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
      if (($_FILES['thumbs_upload']['type'] <> "image/jpg") AND ($_FILES['thumbs_upload']['type'] <> "image/pjpeg") AND ($_FILES['thumbs_upload']['type'] <> "image/jpeg") AND ($_FILES['thumbs_upload']['type'] <> "image/jpe") AND ($_FILES['thumbs_upload']['type'] <> "image/jfif") AND ($_FILES['thumbs_upload']['type'] <> "image/pjp") AND ($_FILES['thumbs_upload']['type'] <> "image/JPG"))
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

      $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  


    if($erros_thumbs_upload == 0)
    {

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 


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

      $nome_arquivo = "../../" . $nome_sistema_fotos . "/" . $codigo_registro . "/thumbs/" . $m . "." . $tipo_arquivo_pequeno;
      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  


    if($erros_foto_upload == 0)
    {


      copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/" . $codigo_registro .  "/fotos/" . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


      $acertos = $acertos . "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      //Cria thumbnail
 
      $caminho_mascara = $caminho."/fotos/mascara.png";
      $caminho_foto = $caminho."/fotos/" . $codigo_evento3 . "/fotos/" . $indice_foto3 . "." . $tipo_arquivo_grande;
      $caminho_thumbs = $caminho."/fotos/" . $codigo_evento3 . "/thumbs/";
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

      copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno); 

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

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "." . $tipo_arquivo_pequeno); 


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

      $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  



    if(($erros_foto_upload == 0)&&($erros_thumbs_upload == 0))
    {
      copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 

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

      copy($_FILES['amp_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "." . $tipo_arquivo_ampliado); 

      copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno); 

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

      $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_arquivo))
      {  
        $indice_foto = $i+1;
      }  
    }  

    $indice_registro = $indice_foto;
    $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  



    if(($erros_foto_upload == 0)&&($erros_thumbs_upload == 0))
    {


      copy($_FILES['amp_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Amplia��o enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['foto_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

      $acertos.= "Foto grande enviada com sucesso<br>";
      $errors = "Nenhum<br>";


      copy($_FILES['thumbs_upload']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro  . "_" . $indice_registro . "." . $tipo_arquivo_pequeno); 

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




    header("Location: foto_enviada.php?codigo_modulo=" . $codigo_modulo . "&acertos=".$acertos."&erros=".$errors); 











  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }
                 
  ob_end_flush();
?>