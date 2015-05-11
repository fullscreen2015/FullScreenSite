<?

  session_start(); 

  $caminho = realpath("../..");

  include("../../include/sistema_zeros.php");
  include("../../include/sistema_conexao.php");
  include("configuracoes.php");


  // Documento


  $erros_doc_upload=0;
  $errors = "";
  $acertos = "";



  if (ISSET($_FILES['doc_upload']))
  {
    if ($_FILES['doc_upload']['size'] > $tamanho_maximo_arquivo) 
    { 
      $erros_doc_upload++;
      $errors = $errors . "O tamanho do arquivo � maior que " . $tamanho_maximo_arquivo . " bytes<br>";
    }
  }
  else
  { 
    $erros_doc_upload++;
    $errors = $errors . "O arquivo não foi enviado corretamente<br>";
  }




  $codigo_registro = $_SESSION['session_codigo_registro'];
  $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  






  $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_SESSION['session_codigo_registro'], $conexao);
  $linha = mysql_fetch_array($rs_dados);



  $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos];

  if (file_exists($nome_arquivo))
  {  
    unlink($nome_arquivo);
  }  



  if($erros_doc_upload == 0)
  {

    $nome_arquivo_novo = str_replace(" ", "_", $_FILES['doc_upload']['name']);
    $nome_arquivo_novo = strtolower($nome_arquivo_novo);   


    $arquivo_novo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $nome_arquivo_novo;


    copy($_FILES['doc_upload']['tmp_name'], $arquivo_novo); 

    $acertos = $acertos . "Arquivo enviado com sucesso<br>";
    $errors = "Nenhum<br>";

    $sql = $nome_campo_documentos . "='" . $nome_arquivo_novo . "'";
    $sql = "UPDATE " . $tabela . " SET " . $sql . " WHERE " . $chave_primaria . "=" . $_SESSION['session_codigo_registro']; 
    mysql_query($sql, $conexao); 

  }


  header("Location: documento_enviado.php?acertos=".$acertos."&erros=".$errors); 


?>




