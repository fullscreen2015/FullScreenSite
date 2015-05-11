<?

  ob_start();

  session_start();

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



  
    include("../_include/usuarios_acesso.php");

    $codigo_modulo = $_REQUEST['codigo_modulo'];
    $permissao = 3;

    if(verifica_usuario2($codigo_modulo, $permissao))
    {


      include("../_sistema/configuracoes.php"); 
	  
      include("../../include/sistema_zeros.php");
      include("../../include/sistema_conexao.php");

      include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

      include("../_include/funcao_prepara_campos.php");
      include("../_include/funcao_form.php"); 
      include("../_include/topo.php"); 


      $dados_registrados = "";

      include("registrar_dados.php"); 

?>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.4.min.js"></script>

<link href="uploadify.css" rel="stylesheet" type="text/css" media="screen" />





<script type="text/javascript">

  $(function() {

    $('#custom_file_upload').uploadify({

      'uploader'       : 'uploadify.swf',
      'script'         : 'uploadify.php<? echo $dados_registrados; ?>',
      'cancelImg'      : 'cancel2.png',
      'folder'         : '<? echo $codigo_modulo; ?>',
      'multi'          : true,
      'auto'           : true,
      'fileExt'        : '*.jpg;*.gif;*.png',
      'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',
      'queueID'        : 'custom-queue',
      'queueSizeLimit' : 99,
      'simUploadLimit' : 10,
      'sizeLimit'   : <? echo $tamanho_maximo_imagem; ?>,
      'removeCompleted': false,

      'onComplete'  : function(event, ID, fileObj, response, data) {
        // $('#thumb').append(response);
        $('#thumb').append('<img class=thumb2 src="' + response + '" />');
      },

      'onSelectOnce'   : function(event,data) {
        $('#status-message').text(data.filesSelected + ' arquivos foram adicionados à fila.');
      },

      'onAllComplete'  : function(event,data) {
        $('#status-message').text(data.filesUploaded + ' arquivo(s) enviado(s), ' + data.errors + ' erro(s).');
        $('#mensagem-final').html('<a href="../_modulos/painel.php?codigo_modulo=<? echo $codigo_modulo; ?>"><img src=voltar.png border=0></a>');
      }

    });

  });

</script>



</head>

<body>

<?
   barra("Menu Principal","../index.php","Painel","../_modulos/painel.php?codigo_modulo=".$codigo_modulo,"Formulário","inserir.php?codigo_modulo=".zerosaesquerda($codigo_modulo,6),"Envio de Fotos em Lote","");  
?>













<div class="demo-box" style="float:left; margin:20px;">

  <div id="status-message" style="margin:10px 0px 10px 0px;">Por favor, selecione os arquivos para enviar:</div>

  <div id="custom-queue"></div>

  <div>
    <input style="margin:20px 0px 0px 0px;" id="custom_file_upload"  type="file" name="Filedata" />        
  </div>

</div>


<div style="float:left; width:90%;  margin:20px 0px 0px 20px;">
  <div id="thumb"></div>
</div>

<div id="mensagem-final" style="float:left; width:90%; margin:20px 0px 0px 20px;"></div>




</body>

</html>




<?

  }
  else
  {
    header("Location: " . $_SERVER['HTTP_REFERER']);  
  }









  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }

  ob_end_flush();

?>
