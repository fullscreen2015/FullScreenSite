<?php


  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);






    if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


  if (!empty($_FILES)) 
  {

    include("../../include/sistema_zeros.php");
    include("../../include/sistema_conexao.php");
    include("../_include/funcao_acentos.php");
    include("../_include/sistema_funcoes.php");    

    $caminho = realpath("../..");



    // recebe o nome da pasta do sistema atual que foi colocado no campo "folder" do formulario
    
    $array_configuracao = explode("/",$_REQUEST['folder']);
    $qt = count($array_configuracao);
    $pasta_configuracao = $array_configuracao[$qt-1];

    $codigo_modulo = (int)anti_injection($pasta_configuracao);
    $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);

    // insere o arquivo de configuração correspondente ao sistema atual
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 


    if(!(isset($tipo_sistema_documentos)))
    {
        $tipo_sistema_documentos = 1;
    }


    $sql = "LOCK TABLES " . $tabela . " WRITE ";
    mysql_query($sql,$conexao);


    $codigo_registro = (int)anti_injection($_REQUEST[$chave_primaria]);
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  

    $tipos_arquivo_proibidos_extensao = array();

    if(!(isset($tipos_arquivo_aceitos_extensao)))
    {
      $tipos_arquivo_aceitos_extensao = array();

      $tipos_arquivo_proibidos_extensao = array('exe','bat','php','htaccess');
    }
    else
    {
      if(count($tipos_arquivo_aceitos_extensao)==0)
      {
        $tipos_arquivo_proibidos_extensao = array('exe','bat','php','htaccess');   
      }
    }


    $fazer_upload=false;

    if((ISSET($_REQUEST['fileext']))&&($_REQUEST['fileext']!=""))
    {

      $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
      $fileTypes  = str_replace(';','|',$fileTypes);
      $typesArray = explode('|',$fileTypes);
      $fileParts  = pathinfo($_FILES['Filedata']['name']);

	    if (in_array(strtolower($fileParts['extension']),$typesArray)) 
      {
        $fazer_upload=true;
      }
      else
      {
        $fazer_upload=false;
      }

    }
    else
    {
      $fazer_upload=true;
    }


/*
    print_r($tipos_arquivo_proibidos_extensao);
    echo "<br />";
    echo $_FILES['Filedata']['name'];
    echo "<br />";
    echo $_FILES['Filedata']['type'];
    echo "<br /><br />";
*/

    if(verifica_extensao($tipos_arquivo_aceitos_mime,$tipos_arquivo_aceitos_extensao,$tipos_arquivo_proibidos_extensao,$_FILES['Filedata']['name'],$_FILES['Filedata']['type'])==false)
    {
      $fazer_upload=false;
    }



    if($fazer_upload==true)
    {

        $fileParts  = pathinfo($_FILES['Filedata']['name']);

        $tempFile = $_FILES['Filedata']['tmp_name'];

        $tipo_arquivo_original = strtolower($fileParts['extension']);
 



        // Decidir o nome do arquivo

        $nome_arquivo_novo = iconv("UTF-8","ISO-8859-1",$_FILES['Filedata']['name']);

        $nome_arquivo_novo = str_replace("?", "", $nome_arquivo_novo);
        $nome_arquivo_novo = str_replace("!", "", $nome_arquivo_novo);
        $nome_arquivo_novo = str_replace(":", "", $nome_arquivo_novo);
        $nome_arquivo_novo = str_replace("@", "", $nome_arquivo_novo);
        $nome_arquivo_novo = str_replace(" ", "_", $nome_arquivo_novo);

        $nome_arquivo_novo = strtolower($nome_arquivo_novo);   
        $nome_arquivo_novo = tirar_acentos($nome_arquivo_novo);   



        if($tipo_sistema_documentos==1)   
        {
          $arquivo_novo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $nome_arquivo_novo;

          $sql = $nome_campo_documentos . "='" . $nome_arquivo_novo . "'";
          $sql = "UPDATE " . $tabela . " SET " . $sql . " WHERE " . $chave_primaria . "=" . $_SESSION['session_codigo_registro']; 
          mysql_query($sql, $conexao); 
        }

        if($tipo_sistema_documentos==2)   
        {

          $codigo_indice = encontrar_novo_indice("../../" . $pasta_documentos,$codigo_registro,$numero_algarismos_documentos,$numero_algarismos_documentos_indice);
          $codigo_indice = zerosaesquerda($codigo_indice,$numero_algarismos_documentos_indice);

          $arquivo_novo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $codigo_indice . "_" . $nome_arquivo_novo;
        }





        copy($_FILES['Filedata']['tmp_name'], $arquivo_novo); 









        echo '<br>';
        echo '<a target="_blank" class=caminho alt="clique para download" href="' . $arquivo_novo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"></a>';
        echo '&nbsp;&nbsp;';
        echo '<font class=caminho>' . $arquivo_novo . '</font>' ;
        echo '';

  
    }
    else 
    {
      echo '<br>';
      echo '<img src=../_imagens/excluir.png border=0 alt="Upload Cancelado" title="Upload Cancelado">';
      echo '&nbsp;&nbsp;';
      echo '<font class=caminho>' ;
      echo iconv("UTF-8","ISO-8859-1",$_FILES['Filedata']['name']);
      echo ' (upload cancelado - tipo de arquivo inválido)';
      echo '</font>' ;      
    }


    $sql = "UNLOCK TABLES";
    mysql_query($sql,$conexao);



  }









  }
  else
  {
    echo "Permissão negada.";
  }




?>