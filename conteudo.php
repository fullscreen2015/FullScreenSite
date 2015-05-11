<?php

  session_start();
  
  include_once "include/sistema_conexao.php";
  include_once "include/sistema_zeros.php";
  include_once "include/sistema_link.php";
  include_once "include/sistema_protecao.php";

  ob_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta name="google-site-verification" content="Ig26dewFUpdeMHuoD-ZIjlVUTymgA9zK4PgU_e_3RQE" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


  <?php include_once 'include/sistema_tags.php'; ?>

  <meta name="author" content="Friweb Agência Digital - www.friweb.com.br">

  
  <meta name="geo.region" content="br-rj">
  <meta name="city" content="nova friburgo">
  <meta name="state" content="rio de janeiro">
  <meta name="country" content="brazil">  


  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style_css3.css">
  <link rel="stylesheet" href="fontes/stylesheet.css">
  
  <link rel="icon" href="imagens/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="css/carrossel.css">
  <link rel="stylesheet" href="carrossel/tango/skin.css">


  <link rel="stylesheet" href="css/slide_dinamico.css">
  
  <link rel="stylesheet" href="css/feature-carousel.css">

  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/contraste.css">
   
  <script src="js/modernizr.js"></script>
  <script src="js/jquery.min.js"></script>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34474267-47', 'auto');
  ga('send', 'pageview');

</script>


</head>

<body>

  <section id="geral">
    <?php
      include_once "include/layout_topo.php";

      // echo '<section class="container_slid">';
        include_once "include/layout_slide.php";
      // echo '</section>';

      echo '<div id="conteudo" class="row">';

        if(isset($_REQUEST['conteudo']))
        {
          if(file_exists("include/conteudo_" . $_REQUEST['conteudo'] . ".php"))
          {
            $conteudo = $_REQUEST['conteudo'];
          }
          else
          {
            $conteudo = "principal";
          }

        }
        else
        {
          $conteudo = "principal";
        }

        include("include/conteudo_" . $conteudo . ".php");

      echo '</div>';

      include_once "include/layout_rodape.php";

    ?>
  </section>    

  <script src="js/swfobject.js"></script>
  <script src="js/swfobject-init.js"></script>

  <script src="js/ddaccordion.js"></script>
  <script src="js/jquery.jcarousel.min.js"></script>
  
  <script src="js/jquery.lazyload.js"></script>
  <script src="js/jquery.cookie.js"></script>

  <script src="js/menu-selecionado.js"></script>
  <script src="js/jquery.featureCarousel.min.js"></script>

  <script src="js/jquery.carouFredSel-6.0.4-packed.js"></script>
 
  <!-- Slide -->
  <script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/jquery.themepunch.revolution.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/configuracao_slide.js"></script>



 
  <script src="js/configuracao.js"></script>

</body>      

</html>

<?php
  
  if(isset($_REQUEST['msg']))
  {

    if($_REQUEST['msg'] == "login_incorreto")
    {
      echo '<script>alert("Dados de login incorreto. Por favor verifique.");</script>';

    }

    if($_REQUEST['msg'] == "realiza_login")
    {
      echo '<script>alert("Por favor realize o login.");</script>';

    }

    if($_REQUEST['msg'] == "preencha_msg")
    {
      echo '<script>alert("Por favor, preencha todos os campos corretamente.");</script>';

    }

    if($_REQUEST['msg'] == "msg_ok")
    {
      echo '<script>alert("Sua mensagem foi enviada com sucesso. Em breve entraremos em contato. Obrigado.");</script>';

    }

  }
  if($conteudo != 'principal')
  {
    echo "<script language=javascript>";
      echo "$('html,body').stop().animate({scrollTop: $('#conteudo').offset().top}, 2000);";
    echo "</script>";
  }

  ob_end_flush();

?>