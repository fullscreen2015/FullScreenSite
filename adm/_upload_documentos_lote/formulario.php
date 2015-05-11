<?php

  ob_start();

  session_start();


  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_zeros.php");
    include("../../include/sistema_conexao.php");
    include("../_include/sistema_funcoes.php");    

    include("../_include/usuarios_acesso.php");
    $codigo_modulo = (int)anti_injection($_REQUEST['up_codigo_modulo']);
    $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);

    
    $permissao = 3;

    if(verifica_usuario2($codigo_modulo, $permissao))
    {

 

      $pasta_sistema = $_REQUEST['up_codigo_modulo'];

      include("../_sistema/configuracoes.php"); 
      include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

      if(!(isset($tipo_sistema_documentos)))
      {
        $tipo_sistema_documentos = 1;
      }

      include("../_include/funcao_prepara_campos.php");
      include("../_include/funcao_form.php"); 
      include("../_include/topo.php"); 


      $dados_registrados = "";

      include("registrar_dados.php"); 

      $link_retorno = "";
      $link_retorno = '<a href="../_modulos/painel.php?codigo_modulo=' . $codigo_modulo . '"><img src=voltar.png border=0></a>';
      if(ISSET($_REQUEST[$chave_primaria]))
      {
        $link_retorno.= '<br /><br /><a class=caminho href="../_modulos/editar_dados.php?codigo_modulo=' . $codigo_modulo . '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria] .'">Editar registro</a>';
        $link_retorno.= '<br /><br /><a class=caminho href="../_modulos/editar_documento.php?codigo_modulo=' . $codigo_modulo . '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria] .'">Gerenciar Documentos</a>';        
      }



      if(isset($tipos_arquivo_aceitos_extensao))
      {

        if(count($tipos_arquivo_aceitos_extensao)>0)
        {
          // echo 'oi';
        }
        else
        {
          // $tipo_arquivo_aceitos_extensao=array('doc','docx');
        }
      }
      else
      {
        // $tipo_arquivo_aceitos_extensao=array('doc','docx');        
        $tipos_arquivo_aceitos_extensao=array();        
      }


      $extensoes_aceitas = "";
      $extensoes_texto = "";
      foreach ($tipos_arquivo_aceitos_extensao as $key => $extensao_arquivo) 
      {
        if($extensoes_aceitas!="")
        {
          $extensoes_aceitas.=";";          
          $extensoes_texto.=", ";
        }
        $extensoes_aceitas.="*." . $extensao_arquivo;
        $extensoes_texto.="." . strtoupper($extensao_arquivo);
      }

      if($extensoes_aceitas=="")
      {
        $extensoes_aceitas = "";
      }

      if($extensoes_texto=="")
      {
        $extensoes_texto ="qualquer tipo de arquivo";
      }
      else
      {
        $extensoes_texto = "(" . $extensoes_texto . ")";
      }

      
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
      'fileExt'        : '<?php echo $extensoes_aceitas; ?>',
      'fileDesc'       : '<?php echo $extensoes_texto; ?>',
      'queueID'        : 'custom-queue',
      'queueSizeLimit' : 99,
      'simUploadLimit' : 10,
      'sizeLimit'   : <? echo  return_bytes(ini_get('post_max_size')); ?>,
      'removeCompleted': false,

      'onComplete'  : function(event, ID, fileObj, response, data) {
         $('#thumb').append(response);
        // $('#thumb').append('<img class=thumb2 src="' + response + '" />');
      },

      'onSelectOnce'   : function(event,data) {
        $('#status-message').text(data.filesSelected + ' arquivos foram adicionados à fila.');
      },

      'onAllComplete'  : function(event,data) {
        $('#status-message').text(data.filesUploaded + ' arquivo(s) enviado(s), ' + data.errors + ' erro(s).');
        $('#mensagem-final').html('<? echo $link_retorno; ?>');
      }

    });

  });

</script>



</head>

<body>

<?php

  if($tipo_sistema_documentos==1)
  {
    barra("Menu Principal","../index.php","Painel","../_modulos/painel.php?codigo_modulo=" . $_REQUEST['up_codigo_modulo'], "Formulário" , "inserir.php?up_codigo_modulo=" . $_REQUEST['up_codigo_modulo'] , "Envio de Documentos em Lote","");    
  }


  if($tipo_sistema_documentos==2)
  {
    barra("Menu Principal","../index.php","Painel","../_modulos/painel.php?codigo_modulo=" . $_REQUEST['up_codigo_modulo'], "Envio de Documentos em Lote" , "" , "","");      
  }


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
