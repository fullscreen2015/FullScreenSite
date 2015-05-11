<?php

  ob_start();
  session_start(); 



  function listar_pasta($dir,$codigo)
  {

    $files = array(); 
    if ($handle = opendir($dir)) 
    {
      while (false !== ($entry = readdir($handle))) 
      {
        if ($entry != "." && $entry != "..") 
        {
          if (is_dir($dir."/".$entry) === true)
          {
            // echo "DIRECTORY: ".$entry."\n";
          }
          else
          {
            if(($pos = strpos ($entry, $codigo))===0)
            {
              $files[] = $entry;
            }
          }
        }
      }
      closedir($handle);
    }

    return $files;
  }

  



  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../_include/topo.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../_include/sistema_funcoes.php"); 
    include("../_include/funcao_confirma.php"); 


  	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
	
    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = (int)anti_injection($_REQUEST['pagina']);      
    }
    else
    {
      $pagina=1;
    }


	
   // session_register("session_codigo_registro");   
    $_SESSION['session_codigo_registro'] = $_REQUEST[$chave_primaria];

    $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_REQUEST[$chave_primaria], $conexao);
    $linha = mysql_fetch_array($rs_dados);

    barra("Menu Principal","../index.php",$sistema_plural,"painel.php?codigo_modulo=" . $codigo_modulo,"Editar " . $sistema_singular,"editar_dados.php?codigo_modulo=" . $codigo_modulo . "&pagina=" . $pagina . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria],"Editando Documento","");  
	
?>


 
  <br>



    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Incluindo Documento Neste Registro</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>


    <form method=post enctype="multipart/form-data" action="upload_documento.php">
	  <input type="hidden" name="codigo_modulo" value="<? echo $codigo_modulo; ?>">
    
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('post_max_size')); ?>" />  

      <table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="aaaaaa">
        <tr valign="top">

          <td width="40%" bgcolor="dddddd" align="center">
            <br>
            <font class=preto_8>
              <b>Indique aqui o arquivo (documento) a ser enviado ...</b><br><br>
              O arquivo deve seguir as seguintes especificações:<br><br>
              <b>Tamanho Máximo:</b> <? echo ini_get('post_max_size'); ?>bytes 

<?php
              if(isset($tipos_arquivo_aceitos_extensao))
              {
                if(count($tipos_arquivo_aceitos_extensao)>0)
                {
                  echo '<br><br>';
                  echo '<b>Formatos aceitos:</b> ';

                  $contz=0;
                  foreach ($tipos_arquivo_aceitos_extensao as $key => $formato) 
                  {
                    $contz++;
                    if($contz>1)
                    echo ", ";
                    echo $formato;
                  }
                }
              }
?>
              <br><br>

              <input class=input type="file" name="doc_upload" size="18"></font></td>

        </tr>
        <tr valign="top">
          <td colspan="2" bgcolor="dddddd" align="center">
            <input class=submit type="submit" value="   >>  Enviar Arquivos <<  "><br>&nbsp;</td>
        </tr>

      </table>
    </form>


<?php

    if(!(isset($tipo_sistema_documentos)))
    {
      $tipo_sistema_documentos = 1;
    }


    if($tipo_sistema_documentos==2)   
    {

      echo '<font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Enviar Documentos em Lote:</b></font>';
      echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>';
      echo '<br /><br />';
      echo '&nbsp;&nbsp;&nbsp;';
      echo '<a class="caminho" href="../_upload_documentos_lote/formulario.php?up_codigo_modulo=' . $codigo_modulo . '&' .$chave_primaria . '=' . anti_injection($_REQUEST[$chave_primaria])  . '">';
      echo '<b>>>> Clique Aqui!</b></a>';
      echo '<br /><br /><br /><br />';
    }
?>    

    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Arquivos desse Registro:</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>
    <br>




<?php

    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  
     



    if($tipo_sistema_documentos==1)   
    {
      $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos] ;

      if (file_exists($nome_arquivo))
      {  
        echo '&nbsp;&nbsp;&nbsp;';
        echo '<a  class=caminho onclick="';
        echo "return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar este arquivo?\n\n****************************'";
        echo '")" alt="clique para excluir" href="excluir_documento.php?codigo_modulo=' . $codigo_modulo;
        echo '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria];
        echo '&nome_arquivo=' . $codigo_registro . "_" . $linha[$nome_campo_documentos];
        echo '&pagina=' . $_REQUEST['pagina'] . '">';
        echo '<img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"></a>';

        echo '&nbsp;';
        echo '<a target="_blank" class=caminho alt="clique para download" href="' . $nome_arquivo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"></a>';
        echo '&nbsp;&nbsp;';

        echo '&nbsp;&nbsp;<font class=caminho>' . $linha[$nome_campo_documentos] . '</font>';
      }  
    }

    if($tipo_sistema_documentos==2)
    {
      $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  

      $lista = listar_pasta("../../" . $pasta_documentos,$codigo_registro);

      foreach ($lista as $key => $nome_arquivo) 
      {

        $arquivo = "../../" . $pasta_documentos . "/" . $nome_arquivo;

        if (file_exists($arquivo))
        {  
          $posicao_inicial = $numero_algarismos_documentos + $numero_algarismos_documentos_indice + 2;
          $nome_arquivo_exibicao = substr($nome_arquivo, $posicao_inicial);

          echo '<br>&nbsp;&nbsp;&nbsp;';

          echo '<a  class=caminho onclick="';
          echo "return confirmLink(this, '\\n****************************\\n\\nTem certeza que deseja\\napagar este arquivo?\\n\\n****************************'";
          echo ')" alt="clique para excluir" href="excluir_documento.php?codigo_modulo=' . $codigo_modulo;
          echo '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria];
          echo '&nome_arquivo=' . $nome_arquivo;
          echo '&pagina=' . $_REQUEST['pagina'] . '">';
          echo '<img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir">';
          echo '</a>';
          echo '&nbsp;';
          echo '<a target="_blank" class=caminho alt="clique para download" href="' . $arquivo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"></a>';
          echo '&nbsp;&nbsp;';
          echo '<font class=caminho>' . $nome_arquivo_exibicao . '</font>' ;
        }

      }


    }














?>




      </tr>
    </table>



  </body>
</html>




<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");  
    }

  ob_end_flush();
  
?>