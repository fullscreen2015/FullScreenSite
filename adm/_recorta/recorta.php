<?php

  session_start();

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_zeros.php"); 
  include("../../include/sistema_protecao.php");
  include("../_include/genthumbs.php"); 
  
  
  
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  
  

  if(!(ISSET($marca_dagua)))
  {
    $marca_dagua = 10;
  }

  if(!(ISSET($marca_dagua_padding)))
  {
    $marca_dagua_padding = 20;
  }




  if(ISSET($_SESSION['session_codigo_registro']))
  {
    $codigo_registro = $_SESSION['session_codigo_registro'];
  }
  else
  {
    $codigo_registro = "";
  }

  $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  


  $caminho = realpath("../..");


  $arquivo_original = $_POST['img'];

  $caminho_arquivo_original = realpath($arquivo_original);

  $hw = getimagesize($arquivo_original);
  $largura_original = $hw["0"];
  $altura_original = $hw["1"];



  $pasta_arquivo_final = $caminho . "/" . $nome_sistema_fotos . "/" . $_REQUEST['tamanho'] . "/";


  $tipo_arquivo_original = substr($arquivo_original, -3);




  // ZOOM #######################################

  $x = $_POST['x'];
  $y = $_POST['y'];
  $w = $_POST['w'];
  $h = $_POST['h'];





  // a variável "alterado" indica se houve alguma altera��o na seleção da foto, ou seja, se o usuário moveu alguma das setas de seleção
  $alterado = $_POST['alterado'];



  $zoom=100;
  if(ISSET($_REQUEST['zoom']))
  {
    if(($_REQUEST['zoom']!="")&&($_REQUEST['zoom']!="100"))
    {
      $zoom = $_REQUEST['zoom'];

      $x = ($x*100)/$zoom; 
      $y = ($y*100)/$zoom; 

      // a variável "alterado" indica se houve alguma altera��o na seleção da foto, ou seja, se o usuário moveu alguma das setas de seleção
      if($alterado==true)
      {

        $w = ($w*100)/$zoom; 
        $h = ($h*100)/$zoom; 
      }
    }
  }


  // FIM ZOOM ###################################





  // ###### DESCOBRINDO O NOME DO ARQUIVO FINAL DAS IMAGENS #######################



  if($_REQUEST['tamanho']=="thumbs")
  {

    if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
    {
      $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_arquivo_original = $codigo_registro . "." . $tipo_arquivo_original;
    }

    if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
    {
      // pegar os '$numero_algarismos' ultimos digitos do arquivo original
      $descer = strlen($arquivo_original) - $numero_algarismos - strlen($tipo_arquivo_ampliado)-1; 
      $subir = $numero_algarismos;
      $indice = substr($arquivo_original, $descer, $subir);

      $nome_arquivo = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_pequeno;
      $nome_arquivo_original = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_original;
    }
  }



  if($_REQUEST['tamanho']=="fotos")
  {

    if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
    {
      $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;
      $nome_arquivo_original = $codigo_registro . "." . $tipo_arquivo_original;
    }      


    if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
    {
      // pegar os '$numero_algarismos' ultimos digitos do arquivo original
      $descer = strlen($arquivo_original) - $numero_algarismos - strlen($tipo_arquivo_ampliado)-1;
      $subir = $numero_algarismos;
      $indice = substr($arquivo_original, $descer, $subir);

      $nome_arquivo = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_grande;
      $nome_arquivo_original = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_original;

    }
  }





  if($_REQUEST['tamanho']=="amp")
  {

    if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
    {
      $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_ampliado;
      $nome_arquivo_original = $codigo_registro . "." . $tipo_arquivo_original;
    }      


    if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
    {
      // pegar os '$numero_algarismos' ultimos digitos do arquivo original
      $descer = strlen($arquivo_original) - $numero_algarismos - strlen($tipo_arquivo_ampliado)-1;
      $subir = $numero_algarismos;

      $indice = substr($arquivo_original, $descer, $subir);


      $nome_arquivo = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_ampliado;
      $nome_arquivo_original = $codigo_registro . "_" . $indice . "." . $tipo_arquivo_original;



    }
  }






  // ####### DESCOBRINDO A ALTURA E LARGURA FINAIS DAS IMAGENS ##############################



  if($_REQUEST['tamanho']=="thumbs")
  {
    $conf_largura_imagem = $largura_thumbs;
    $conf_altura_imagem = $altura_thumbs;
    $conf_largura_maxima_imagem = $largura_maxima_thumbs;
    $conf_altura_maxima_imagem = $altura_maxima_thumbs;
  }

  if($_REQUEST['tamanho']=="fotos")
  {
    $conf_largura_imagem = $largura_foto;
    $conf_altura_imagem = $altura_foto;
    $conf_largura_maxima_imagem = $largura_maxima_foto;
    $conf_altura_maxima_imagem = $altura_maxima_foto;
  }


  if($_REQUEST['tamanho']=="amp")
  {
    $conf_largura_imagem = $largura_amp;
    $conf_altura_imagem = $altura_amp;
    $conf_largura_maxima_imagem = $largura_maxima_amp;
    $conf_altura_maxima_imagem = $altura_maxima_amp;
  }





  // Se tivermos na configura��o largura e altura exatos
  if(($conf_largura_imagem!=0)&&($conf_altura_imagem!=0))
  {
    $largura = $conf_largura_imagem;
    $altura = $conf_altura_imagem;
  }
  else
  {

    $largura = $w;
    $altura = $h;


    // Se tivermos na configura��o largura exata e altura livre

    if(($conf_largura_imagem!=0)&&($conf_altura_imagem==0))
    {
      $largura = $conf_largura_imagem;


      $conta = $largura/$w;
      $altura = $h*$conta;
    }


    // Se tivermos na configura��o largura livre e altura exata

    if(($conf_largura_imagem==0)&&($conf_altura_imagem!=0))
    {
      $altura = $conf_altura_imagem;


      $conta=$altura/$h;
      $largura = $w*$conta;
    }



    // Se tivermos na configura��o largura livre, altura livre

    if(($conf_largura_imagem==0)&&($conf_altura_imagem==0))
    {

      // Se tivermos na configura��o largura-maxima definida

      if(($conf_largura_maxima_imagem!=0)&&($conf_altura_maxima_imagem!=0))
      {


        // aqui que estava com erro

        if($w>$conf_largura_maxima_imagem)
        {
          $largura = $conf_largura_maxima_imagem;

          $w_original = ($w*$zoom)/100; 
          $h_original = ($h*$zoom)/100; 


          $conta = $largura/$w_original;
          $altura = $h_original*$conta;

        }

        if($altura>$conf_altura_maxima_imagem)
        {
          $conta = $conf_altura_maxima_imagem/$altura;

          $altura = $conf_altura_maxima_imagem;

          $largura = $largura*$conta;
        }


      }
      else
      {

        if($conf_largura_maxima_imagem!=0)
        {
          if($w>$conf_largura_maxima_imagem)
          {
            $largura = $conf_largura_maxima_imagem;

            $conta = $largura/$w;
            $altura = $h*$conta;

          }
        }



        // Se tivermos na configura��o altura-maxima definida

        if($conf_altura_maxima_imagem!=0)
        {
          if($h>$conf_altura_maxima_imagem)
          {
            $altura = $conf_altura_maxima_imagem;

            $conta=$altura/$h;
            $largura = $w*$conta;

          }
        }
      }
    }

  }






  // Criando Imagem

  $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";	
  recorta_arquivo2($caminho_arquivo_original,$pasta_arquivo_final,$nome_arquivo,$largura,$altura,$x,$y,$w,$h,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);








  $rabicho = "index.php?codigo_modulo=" . $codigo_modulo . "&caminho=" . $caminho_arquivo_original . "&pasta=" . $nome_sistema_fotos . "&arquivo=" . $nome_arquivo_original . "&sistema=" . $_REQUEST['sistema'] . "&cod=" . $codigo_registro . "&zoom=" . $zoom;




  if(ISSET($_REQUEST['fotos_para_cortar']))
  {

    if($_REQUEST['tamanho']=="thumbs")
    {
      $rabicho = $rabicho . "&tamanho_ok=retorna";
    }
    else
    {
      $rabicho = $rabicho . "&tamanho_ok=" . $_REQUEST['tamanho'];
    }

    $rabicho = $rabicho . "&fotos_para_cortar=" . $_REQUEST['fotos_para_cortar'];
  }
  else
  {
    $rabicho = $rabicho . "&tamanho_ok=" . $_REQUEST['tamanho'];
  }


  // a variável "tmo" quer dizer "tipo m�dulo de origem"
  // tmo=0 ou tso=NULL >>> o m�dulo de origem � igual ao sistema atual
  // tmo=1 >>> o m�dulo de origem � diferente do sistema atual

  if(ISSET($_REQUEST['tmo']))
  {
    $rabicho.="&tmo=" . $_REQUEST['tmo'];
  }




  header("Location: " . $rabicho);


?>