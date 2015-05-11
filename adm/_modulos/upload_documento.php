<?php

  ob_start();
  session_start(); 




  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



    $caminho = realpath("../..");

  
    include("../../include/sistema_conexao.php");
    include("../../include/sistema_zeros.php");
    include("../_include/genthumbs.php");
    include("../_include/funcao_acentos.php");
    include("../_include/sistema_funcoes.php");    

    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);


    if($codigo_modulo==0)
    {
      $msg = "Arquivo maior que o permitido. Por favor, envie um arquivo menor. Obrigado!";
      header("Location: " . $_SERVER['HTTP_REFERER'] . "&msg=" . $msg);  
      exit();
    }

    
    include("../_configuracoes/" . $codigo_modulo6 . ".php"); 

     

    $codigo_registro = $_SESSION['session_codigo_registro'];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  
    

    // Arquivo Personalizado 0 - logo ap�s a leitura das configurações
    // Arquivo Personalizado 1 - Dentro do IF que testa se o arquivo foi enviado (opção true)
    // Arquivo Personalizado 2 - Dentro do IF que testa se o arquivo foi enviado (opção false)
    // Arquivo Personalizado 3 - Dentro do IF que testa se o tipo de sistema � 1 ou 2 (opção 1)
    // Arquivo Personalizado 4 - Dentro do IF que testa se o tipo de sistema � 1 ou 2 (opção 2)
    // Arquivo Personalizado 5 - Antes de redirecionar

    
    $ap0 = "../_personalizados/" . $codigo_modulo6 . "_updoc_0.php";
    $ap1 = "../_personalizados/" . $codigo_modulo6 . "_updoc_1.php";
    $ap2 = "../_personalizados/" . $codigo_modulo6 . "_updoc_2.php";
    $ap3 = "../_personalizados/" . $codigo_modulo6 . "_updoc_3.php";
    $ap4 = "../_personalizados/" . $codigo_modulo6 . "_updoc_4.php";
    $ap5 = "../_personalizados/" . $codigo_modulo6 . "_updoc_5.php";



    if(file_exists($ap0))
    {
      include($ap0);
    }










    $tamanho_maximo_arquivo = return_bytes(ini_get('post_max_size'));

    // Documento


    $erros_doc_upload=0;
    $errors = "";
    $acertos = "";


    if(!(isset($tipo_sistema_documentos)))
    {
      $tipo_sistema_documentos = 1;
    }

    $tipos_arquivo_proibidos_extensao = array();

    if(!(isset($tipos_arquivo_aceitos_mime)))
    {
      $tipos_arquivo_aceitos_mime = array();

    }

    if(!(isset($tipos_arquivo_aceitos_extensao)))
    {
      $tipos_arquivo_aceitos_extensao = array();

      $tipos_arquivo_proibidos_extensao = array('exe','bat','php','htaccess');
    }



    if (ISSET($_FILES['doc_upload']))
    {

      if(file_exists($ap1))
      {
        include($ap1);
      }


      if ($_FILES['doc_upload']['size'] > $tamanho_maximo_arquivo) 
      { 
        $erros_doc_upload++;
        $errors = $errors . "O arquivo enviado tem " . $_FILES['doc_upload']['size']  . " e � maior que " . $tamanho_maximo_arquivo . " bytes<br>";
      }

      if(verifica_extensao($tipos_arquivo_aceitos_mime,$tipos_arquivo_aceitos_extensao,$tipos_arquivo_proibidos_extensao,$_FILES['doc_upload']['name'],$_FILES['doc_upload']['type'])==false)
      {

        $erros_doc_upload++;
        $errors = $errors."Tipo de arquivo não permitido (" . $_FILES['doc_upload']['type']. ")<br>";
      }


    }
    else
    { 
      if(file_exists($ap2))
      {
        include($ap2);
      }

      $erros_doc_upload++;
      $errors = $errors . "O arquivo não foi enviado corretamente<br>";
    }






   
    

    if($tipo_sistema_documentos==1)   
    {

      if(file_exists($ap3))
      {
        include($ap3);
      }


      $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_SESSION['session_codigo_registro'], $conexao);
      $linha = mysql_fetch_array($rs_dados);

      $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos];

      if (file_exists($nome_arquivo))
      {  
        unlink($nome_arquivo);
      }  

    }


    if($tipo_sistema_documentos==2)   
    {
      if(file_exists($ap4))
      {
        include($ap4);
      }
    }

    if($erros_doc_upload == 0)
    {

      $nome_arquivo_novo = $_FILES['doc_upload']['name'];

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



      copy($_FILES['doc_upload']['tmp_name'], $arquivo_novo); 

      $acertos = $acertos . "Arquivo enviado com sucesso<br>";
      $errors = "Nenhum<br>";

    }


    if(file_exists($ap5))
    {
      include($ap5);
    }


    header("Location: documento_enviado.php?codigo_modulo=" . $codigo_modulo . "&acertos=".$acertos."&erros=".$errors); 

  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }

  ob_end_flush();

?>