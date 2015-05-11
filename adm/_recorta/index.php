<?php

  session_start();

  
  include("../../include/sistema_conexao.php");
  include("../../include/sistema_zeros.php");
  include("../../include/sistema_protecao.php");
  
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

  
  




  if(ISSET($_SESSION['session_codigo_registro']))
  {
    $codigo_registro = $_SESSION['session_codigo_registro'];
  }
  else
  {
    $codigo_registro = "";
  }




  $arquivo="";
  if(ISSET($_REQUEST['arquivo']))
  {
    $arquivo=$_REQUEST['arquivo'];
  }

  $caminho="";
  if(ISSET($_REQUEST['caminho']))
  {
    $caminho=$_REQUEST['caminho'];
  }

  $pasta="";
  if(ISSET($_REQUEST['pasta']))
  {
    $pasta=$_REQUEST['pasta'];
  }
  





  // fun��o para calcular o MDC (m�ximo divisor comun)
  function mdc($a,$b)
  {
    return ($a % $b) ? mdc($b,$a % $b) : $b;
  }






  // a variável $tamanho recebe o pr�ximo tamanho a ser redimensionado (amp, foto ou thumbs)

  $tamanho = "";



  if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==4))
  {
    if(ISSET($_REQUEST['tamanho_ok']))
    {
      $tamanho = "";
    }
    else
    {
      $tamanho = "thumbs";
    }
  }



  if(($tipo_sistema_fotos==2)||($tipo_sistema_fotos==3)||($tipo_sistema_fotos==5))
  {

    if(ISSET($_REQUEST['tamanho_ok']))
    {
      if($_REQUEST['tamanho_ok']=='fotos')
      {
        $tamanho = "thumbs";
      }
      if($_REQUEST['tamanho_ok']=='thumbs')
      {
        $tamanho = "";
      }
    }
    else
    {
      $tamanho = "fotos";
    }

  }




  if(($tipo_sistema_fotos==6)||($tipo_sistema_fotos==7))
  {

    if(ISSET($_REQUEST['tamanho_ok']))
    {
      if($_REQUEST['tamanho_ok']=='amp')
      {
        $tamanho = "fotos";
      }
      if($_REQUEST['tamanho_ok']=='fotos')
      {
        $tamanho = "thumbs";
      }
      if($_REQUEST['tamanho_ok']=='thumbs')
      {
        $tamanho = "";
      }
    }
    else
    {
      $tamanho = "amp";
    }

  }





  if((ISSET($_REQUEST['fotos_para_cortar']))&&($_REQUEST['fotos_para_cortar']!=""))
  {

    if(ISSET($_REQUEST['tamanho_ok']))
    {
      if($_REQUEST['tamanho_ok']=="retorna")
      {
        $tamanho="fotos";
      }
    }
  }


  // se a variável $tamanho estiver vazia, quer dizer que todos os tamanhos já foram redimensionados.
  // caso contr�rio, o sistema prossegue normalmente

  if($tamanho!="")
  {


    include("../_include/topo.php"); 

?>

    <script language="javascript" src="../_js/jquery.imgareaselect.js"></script>
<?


    include("../../include/sistema_resolucao.php");


    $mostrar_thumbs = "";
    $fotos_para_cortar="";
    if((ISSET($_REQUEST['fotos_para_cortar']))&&($_REQUEST['fotos_para_cortar']!=""))
    {








      $array_fotos_para_cortar = explode(",",$_REQUEST['fotos_para_cortar']);



      $foto_para_corte = "../../" . $array_fotos_para_cortar[0];









      // por exemplo, ".jpg" tem 4 caracteres
      $numero_caracteres_extensao=4;


      if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
      {
        // esta variavel recebe o n�mero de caracteres do arquivo. exemplo: "000006_000001.jpg" tem 17 caracteres
        $quantidade_caracteres_arquivo = $numero_algarismos + 1 + $numero_algarismos_codigo + $numero_caracteres_extensao;

        $posicao_inicial = 0-$quantidade_caracteres_arquivo;

        $codigo_registro = substr($foto_para_corte, $posicao_inicial, $numero_algarismos);
        $arquivo=substr($foto_para_corte, $posicao_inicial, $quantidade_caracteres_arquivo);

        // para descobrir o �ndice, a f�rmula � diferente
        $quantidade_caracteres_arquivo = $numero_algarismos_codigo + $numero_caracteres_extensao;
        $posicao_inicial = 0-$quantidade_caracteres_arquivo;
        $indice = substr($foto_para_corte, $posicao_inicial, $numero_algarismos_codigo);

        $_SESSION['session_indice']=$indice;
      }

      if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
      {
        // esta variavel recebe o n�mero de caracteres do arquivo. exemplo: "000006.jpg" tem 10 caracteres
        $quantidade_caracteres_arquivo = $numero_algarismos + $numero_caracteres_extensao;

        $posicao_inicial = 0-$quantidade_caracteres_arquivo;

        $codigo_registro = substr($foto_para_corte, $posicao_inicial, $numero_algarismos);
        $arquivo=substr($foto_para_corte, $posicao_inicial, $quantidade_caracteres_arquivo);
      }


      $_SESSION['session_codigo_registro']=$codigo_registro;









      $caminho = realpath("../..");

      $caminho = $caminho . "/" . $pasta . "/originais/" . $arquivo;





      $numero_fotos_para_cortar = count($array_fotos_para_cortar);

      $fotos_para_cortar="";
      $mostrar_thumbs = "";

      if($numero_fotos_para_cortar>0)
      {
        if($tamanho=="thumbs")
        {
          $inicio = 1;
        }
        else
        {
          $inicio = 0;
        }

        for($aa=$inicio;$aa<$numero_fotos_para_cortar;$aa++)
        {

          if($fotos_para_cortar!="")
          {
            $fotos_para_cortar.= ",";
          }   
          $fotos_para_cortar.= $array_fotos_para_cortar[$aa];

        }





        for($aa=0;$aa<$numero_fotos_para_cortar;$aa++)
        {

          if($foto_para_corte=="../../".$array_fotos_para_cortar[$aa])
          {
            $mostrar_thumbs.="<img style='border:5px solid #ffffff;' height=30 src='../../" . $array_fotos_para_cortar[$aa] . "'> ";
          }
          else
          {
            $mostrar_thumbs.="<img style='border:5px solid #dddddd;' height=30 src='../../" . $array_fotos_para_cortar[$aa] . "'> ";
          }

        }





      }
    }
    else
    {
      $foto_para_corte = "../../" . $_REQUEST['pasta'] . "/originais/" . $_REQUEST['arquivo'];
    }


    $foto_tamanhos = GetImageSize($foto_para_corte);
    $largura_foto_corte = $foto_tamanhos[0]; 
    $altura_foto_corte = $foto_tamanhos[1]; 











    $zoom=100;
    if(ISSET($_REQUEST['zoom']))
    {
      if(($_REQUEST['zoom']!="")&&($_REQUEST['zoom']!="100"))
      {
        $zoom = $_REQUEST['zoom'];
      }
    }
    else
    {

      // SELECIONA O ZOOM IDEAL PARA O TAMANHO DA FOTO

      $escala_zoom[0] = "10";
      $escala_zoom[1] = "25";
      $escala_zoom[2] = "50";
      $escala_zoom[3] = "100";

      if($zoom=="100")
      {
        $escala = "3";
      }

      if($zoom=="50")
      {
        $escala = "2";
      }

      if($zoom=="25")
      {
        $escala = "1";
      }

      if($zoom=="10")
      {
        $escala = "0";
      }




      $largura_tela = $largura_tela - 60;

      $largura_foto_exibicao = ($largura_foto_corte * $zoom) / 100;


      $altura_tela = $altura_tela - 60;

      $altura_foto_exibicao = ($altura_foto_corte * $zoom) / 100;


      $razao_largura = $largura_tela/$largura_foto_exibicao * 100;
      $razao_altura = ($altura_tela-200)/$altura_foto_exibicao * 100;


      if($razao_largura<$razao_altura)
      {
        $razao = $razao_largura;
      }
      else
      {
        $razao = $razao_altura;
      }

      if(($razao>50)&&($razao<100))
      {
        if($escala>=1)
        {
          $escala-=1;
        }
      }

      if(($razao<=50)&&($razao>25))
      {
        if($escala>=2)
        {
          $escala-=2;
        }
        else
        {
          if($escala>=1)
          {
            $escala-=1;
          }
        }
      }

      if(($razao<=25)&&($razao>10))
      {
        if($escala>=3)
        {
          $escala-=3;
        }
        else
        {
          if($escala>=2)
          {
            $escala-=2;
          }
          else
          {
            if($escala>=1)
            {
              $escala-=1;
            }
          }
        }
      }

      $zoom = $escala_zoom[$escala];



    }











    // ################### THUMBS ###########################

    if($tamanho=="thumbs")
    {
      $titulo = "Recortando a Miniatura";

      $tem_proporcao="";

      // trabalhando com largura e altura fixas

      if(($largura_thumbs!=0)&&($altura_thumbs!=0))
      {
        $largura = $largura_thumbs;
        $altura = $altura_thumbs;
        $largura_minima = $largura_thumbs;
        $altura_minima = $altura_thumbs;
        $tem_proporcao="ok";



        // define o tamanho ideal inicial para a m�scara de corte

        $proporcao_inicial = $largura_foto_corte/$largura_thumbs;
        $altura_inicial_teste = $altura_thumbs * $proporcao_inicial;
        if($altura_inicial_teste>$altura_foto_corte)
        {
          $proporcao_inicial = $altura_foto_corte/$altura_thumbs;
        }

        $largura_inicial = $largura_thumbs * $proporcao_inicial;
        $altura_inicial = $altura_thumbs * $proporcao_inicial;



      }
      else
      {
        $largura_inicial = $largura_foto_corte-40;
        $altura_inicial = $altura_foto_corte-40;

        if($largura_minima_thumbs!=0)
        {
          $largura_minima = $largura_minima_thumbs;
        }
        else
        {
          $largura_minima = 1;
        }

        if($altura_minima_thumbs!=0)
        {
          $altura_minima = $altura_minima_thumbs;
        }
        else
        {
          $altura_minima = 1;
        }

        if($largura_thumbs!=0)
        {
          $largura_minima = $largura_thumbs;
          $largura_inicial = $largura_thumbs;
        }

        if($altura_thumbs!=0)
        {
          $altura_minima = $altura_thumbs;
          $altura_inicial = $altura_thumbs;
        }


      }
    }



    // ################### FOTO ###########################

    if($tamanho=="fotos")
    {
      $titulo = "Recortando a Foto";

      $tem_proporcao="";

      // trabalhando com largura e altura fixas

      if(($largura_foto!=0)&&($altura_foto!=0))
      {
        $largura = $largura_foto;
        $altura = $altura_foto;
        $largura_minima = $largura_foto;
        $altura_minima = $altura_foto;

        $tem_proporcao="ok";



        // define o tamanho ideal inicial para a m�scara de corte

        $proporcao_inicial = $largura_foto_corte/$largura_foto;
        $altura_inicial_teste = $altura_foto * $proporcao_inicial;
        if($altura_inicial_teste>$altura_foto_corte)
        {
          $proporcao_inicial = $altura_foto_corte/$altura_foto;
        }

        $largura_inicial = $largura_foto * $proporcao_inicial;
        $altura_inicial = $altura_foto * $proporcao_inicial;

      }
      else
      {
        $largura_inicial = $largura_foto_corte-40;
        $altura_inicial = $altura_foto_corte-40;

        if($largura_minima_foto!=0)
        {
          $largura_minima = $largura_minima_foto;
        }
        else
        {
          $largura_minima = 1;
        }

        if($altura_minima_foto!=0)
        {
          $altura_minima = $altura_minima_foto;
        }
        else
        {
          $altura_minima = 1;
        }

        if($largura_foto!=0)
        {
          $largura_minima = $largura_foto;
          $largura_inicial = $largura_foto;
        }

        if($altura_foto!=0)
        {
          $altura_minima = $altura_foto;
          $altura_inicial = $altura_foto;
        }


      }
    }






    // ################### AMP ###########################

    if($tamanho=="amp")
    {
      $titulo = "Recortando a Amplia��o";

      $tem_proporcao="";

      // trabalhando com largura e altura fixas

      if(($largura_amp!=0)&&($altura_amp!=0))
      {
        $largura = $largura_amp;
        $altura = $altura_amp;
        $largura_minima = $largura_amp;
        $altura_minima = $altura_amp;
        $tem_proporcao="ok";


        // define o tamanho ideal inicial para a m�scara de corte

        $proporcao_inicial = $largura_foto_corte/$largura_amp;
        $altura_inicial_teste = $altura_amp * $proporcao_inicial;
        if($altura_inicial_teste>$altura_foto_corte)
        {
          $proporcao_inicial = $altura_foto_corte/$altura_amp;
        }

        $largura_inicial = $largura_amp * $proporcao_inicial;
        $altura_inicial = $altura_amp * $proporcao_inicial;


      }
      else
      {
        $largura_inicial = $largura_foto_corte-40;
        $altura_inicial = $altura_foto_corte-40;

        if($largura_minima_amp!=0)
        {
          $largura_minima = $largura_minima_amp;
        }
        else
        {
          $largura_minima = 1;
        }

        if($altura_minima_amp!=0)
        {
          $altura_minima = $altura_minima_amp;
        }
        else
        {
          $altura_minima = 1;
        }

        if($largura_amp!=0)
        {
          $largura_minima = $largura_amp;
          $largura_inicial = $largura_amp;
        }

        if($altura_amp!=0)
        {
          $altura_minima = $altura_amp;
          $altura_inicial = $altura_amp;
        }



      }
    }



    $subtitulo = "";
    if(ISSET($numero_fotos_para_cortar))
    {
      if($numero_fotos_para_cortar!="")
      {
        if($numero_fotos_para_cortar>1)
        {
          $subtitulo.= "Restam " . $numero_fotos_para_cortar . " imagens";
        }
        else
        {
          $subtitulo.= "Resta " . $numero_fotos_para_cortar . " imagem";
        }
      }
    }






    if($tem_proporcao!="")
    {
      $mdc = mdc($largura,$altura);
      $divisor=$largura/$mdc;
      $dividendo=$altura/$mdc;
      $proporcao = $divisor . ":" . $dividendo;
    }


 

    $x1_inicial = ((int)$largura_foto_corte-(int)$largura_inicial)/2;
    $y1_inicial = ((int)$altura_foto_corte-(int)$altura_inicial)/2;


    $x2_inicial = $largura_inicial + $x1_inicial;
    $y2_inicial = $altura_inicial + $y1_inicial;





    // ZOOM ##################################################################


    $x1_inicial = (int)($x1_inicial*$zoom)/100;
    $x2_inicial = ($x2_inicial*$zoom)/100;
    $y1_inicial = ($y1_inicial*$zoom)/100;
    $y2_inicial = ($y2_inicial*$zoom)/100;

    $x1_inicial = (int)$x1_inicial;

    $altura_minima = ($altura_minima*$zoom)/100;
    $largura_minima = ($largura_minima*$zoom)/100;
    $largura_foto_corte = ($largura_foto_corte*$zoom)/100;
    $altura_foto_corte = ($altura_foto_corte*$zoom)/100;

    // FIM ZOOM ##################################################################



?>

<link rel="stylesheet" href="../_css/crop_main.css" />
<link rel="stylesheet" href="../_css/crop_imgareaselect-animated.css" />

<script language="javascript">
//<![CDATA[

  $(function()
  {
	
    $('#foto_para_corte')
    .imgAreaSelect
    (
      {
        onSelectChange: function selectChange(img, selection)
        {
          $('#x').val(selection.x1);
          $('#y').val(selection.y1);
          $('#h1').val(selection.height);
          $('#w1').val(selection.width);
          $w = $('#w').text(selection.width+' px');
          $h = $('#h').text(selection.height+' px');										
          $('#alterado').val(true);
        },

        handles: true,

<?  
        if($tem_proporcao!="")
        {
          echo 'aspectRatio: "' . $proporcao . '",
';
        }
?>
        x1: <? echo $x1_inicial; ?>,
        x2: <? echo $x2_inicial; ?>,
        y1: <? echo $y1_inicial; ?>,
        y2: <? echo $y2_inicial; ?>,
        minHeight: <? echo $altura_minima; ?>,
        minWidth: <? echo $largura_minima; ?>,
        imageWidth: <? echo $largura_foto_corte; ?>,
        imageHeight: <? echo $altura_foto_corte; ?>,
        persistent:true
      }
    ); 
  });
//]]
</script>



</head>

<body>

<?
    barra("Menu Principal","../index.php","Painel","../_modulos/painel.php?codigo_modulo=" . $codigo_modulo,"Editar " . $sistema_singular , "../_modulos/editar_foto.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria . "=" . $codigo_registro , "Enviando Foto","javascript:history.back();");  
?>


<div id="estrutura">
	
    <h1><? echo $titulo; ?></h1>
    <h3><? echo $subtitulo; ?></h3>

    <? echo $mostrar_thumbs; ?>

    <p class=caminho>Selecione a �rea da imagem que deseja aproveitar, depois clique no bot�o "Recortar"</p>

<?

    if(ISSET($_REQUEST['cod']))
    {
      $cod = $_REQUEST['cod'];
    }
    else
    {
      $cod = $codigo_registro;
    }

    $url = "index.php?codigo_modulo=" . $codigo_modulo . "&arquivo=" . $arquivo . "&caminho=" . $caminho . "&pasta=" . $pasta . "&sistema=" . $_REQUEST['sistema'] . "&cod=".$cod;

    if(ISSET($_REQUEST['tamanho_ok']))
    {
      $url.="&tamanho_ok=" . $_REQUEST['tamanho_ok'];
    }


    // a variável "tmo" quer dizer "tipo m�dulo de origem"
    // tmo=0 ou tso=NULL >>> o m�dulo de origem � igual ao sistema atual
    // tmo=1 >>> o m�dulo de origem � diferente do sistema atual

    if(ISSET($_REQUEST['tmo']))
    {
      $url.="&tmo=" . $_REQUEST['tmo'];
    }




?>

    <p class=caminho>
      Zoom:

<?
      $zoom_100 = "100%";
      if($zoom=="100")
      {
        $zoom_100 = "<b>100%</b>";
      }

      $zoom_50 = "50%";
      if($zoom=="50")
      {
        $zoom_50 = "<b>50%</b>";
      }

      $zoom_25 = "25%";
      if($zoom=="25")
      {
        $zoom_25 = "<b>25%</b>";
      }

      $zoom_10 = "10%";
      if($zoom=="10")
      {
        $zoom_10 = "<b>10%</b>";
      }
?>

      <a class=caminho href="<? echo $url; ?>&zoom=100"><? echo $zoom_100; ?></a> |
      <a class=caminho href="<? echo $url; ?>&zoom=50"><? echo $zoom_50; ?></a> |
      <a class=caminho href="<? echo $url; ?>&zoom=25"><? echo $zoom_25; ?></a> |
      <a class=caminho href="<? echo $url; ?>&zoom=10"><? echo $zoom_10; ?></a>
    </p>


    <form action="recorta.php" method="post">

        <input value="<? echo $x1_inicial; ?>" type="hidden" name="x" id="x" />
        <input value="<? echo $y1_inicial; ?>" type="hidden" name="y" id="y" />
        <input value="<? echo $altura_inicial; ?>" type="hidden" name="h" id="h1" />
        <input value="<? echo $largura_inicial; ?>" type="hidden" name="w" id="w1" />
        <input value="" type="hidden" name="alterado" id="alterado" />
        <input value="<? echo $fotos_para_cortar; ?>" type="hidden" name="fotos_para_cortar" id="fotos_para_cortar" />

        <input type="hidden" name="img" value="<? echo $foto_para_corte; ?>" />
        <input type="hidden" name="sistema" value="<? echo $_REQUEST['sistema']; ?>" />
        <input type="hidden" name="tamanho" value="<? echo $tamanho; ?>" />
        <input type="hidden" name="cod" value="<? echo $cod; ?>" />
        <input type="hidden" name="zoom" value="<? echo $zoom; ?>" />
        <input type="hidden" name="codigo_modulo" value="<? echo $codigo_modulo; ?>" />
<?
        // a variável "tmo" quer dizer "tipo m�dulo de origem"
        // tmo=0 ou tso=NULL >>> o m�dulo de origem � igual ao sistema atual
        // tmo=1 >>> o m�dulo de origem � diferente do sistema atual

        if(ISSET($_REQUEST['tmo']))
        {
          echo '<input type="hidden" name="tmo" value="' . $_REQUEST['tmo'] . '" />';
        }
?>


        <input type="submit" value=' Recortar ' />
    </form>

    <br />
    
    <img width="<? echo $largura_foto_corte; ?>" height="<? echo $altura_foto_corte; ?>" src="<? echo $foto_para_corte; ?>?<?php echo rand(0,9999); ?>" id="foto_para_corte" alt="Foto para Corte" />

    <br />
    
</div>

     
</body>
</html>



<?php

  }
  else
  {
    $acertos="ok";
    $errors="";



    $sistema_de_origem="mesmo";

    // a variável "tmo" quer dizer "tipo m�dulo de origem"
    // tmo=0 ou tso=NULL >>> o m�dulo de origem � igual ao sistema atual
    // tmo=1 >>> o m�dulo de origem � diferente do sistema atual

    if(ISSET($_REQUEST['tmo']))
    {
      if($_REQUEST['tmo']==1)
      {
        $sistema_de_origem="outro";
      }
    }


    if($sistema_de_origem=="mesmo")
    {
      header("Location: ../_modulos/editar_foto.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria . "=" . $codigo_registro); 
    }
    else
    {
      $nome_sistema_de_origem=$_SESSION['nome_sistema_de_origem'];
      $nome_chave_primaria_sistema_de_origem=$_SESSION['nome_chave_primaria_sistema_de_origem'];
      $valor_chave_primaria_sistema_de_origem=$_SESSION['valor_chave_primaria_sistema_de_origem'];

      // aqui, vai para o m�dulo original
      header("Location: ../_modulos/painel.php?codigo_modulo=" . $codigo_modulo); 


    }


  }
  
?>