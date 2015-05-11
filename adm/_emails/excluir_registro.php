<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("configuracoes.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php"); 



    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = $_REQUEST['pagina'];
    }
    else
    {
      $pagina = "1";
    }




    if(ISSET($_REQUEST[$chave_primaria]))
    {

      if($sistema_documentos==1)
      {

        $codigo_registro = $_REQUEST[$chave_primaria];
        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documento);  

        $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_REQUEST[$chave_primaria], $conexao);
        $linha = mysql_fetch_array($rs_dados);

        $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos];


        if (file_exists($nome_arquivo))
        {
          unlink($nome_arquivo);
        }
      }

      $sql = "DELETE FROM " . $tabela . " WHERE " . $chave_primaria ." = " . $_REQUEST[$chave_primaria] ; 
      mysql_query($sql, $conexao); 



    for($conta=1;$conta<=$numero_campos_associativos;$conta++)
    {
      $conta_ = (10 + $conta);
      $conta1 = $conta_ . "1";
      $conta2 = $conta_ . "2";
      $conta3 = $conta_ . "3";
      $conta4 = $conta_ . "4";
      $conta5 = $conta_ . "5";
      $conta6 = $conta_ . "6";
      $conta7 = $conta_ . "7";
      $conta8 = $conta_ . "8";
      $conta9 = $conta_ . "9";
      $conta91 = $conta_ . "91";



      $sql_delete = "DELETE FROM " . $campos_associativos[$conta8] . " WHERE " . $campos_associativos[$conta9] . "=" . $_REQUEST[$campos_associativos[$conta9]];

      mysql_query($sql_delete, $conexao); 

    }




    }




    if($sistema_fotos==1)
    {
      header("Location: excluir_fotos.php?pagina=".$pagina . "&" . $chave_primaria ."=" . $_REQUEST[$chave_primaria]);  
    }
    else
    {
      header("Location: painel.php?pagina=".$pagina);  
    }






  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }

?>
