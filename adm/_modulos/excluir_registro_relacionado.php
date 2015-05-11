<?
  ob_start();
  session_start(); 
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



  include("../../include/sistema_protecao.php"); 
  include("../_include/usuarios_acesso.php");
  
  $codigo_modulo = (int)anti_injection($_REQUEST['cm']);


  $permissao = 7;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {

    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php"); 

	include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
    

    $chave_primaria_original = $chave_primaria;
    $valor_chave_primaria_original = $_REQUEST[$chave_primaria];






    $tabela_relacionado = $_REQUEST['tb'];
    $chave_primaria_relacionado = $_REQUEST['cp'];
    $sistema_exclusao = $_REQUEST['se'];
    $codigo_modulo_relacionado = $_REQUEST['cmr'];

	include("../_configuracoes/" . zerosaesquerda($codigo_modulo_relacionado,6) . ".php"); 







    if(ISSET($_REQUEST[$chave_primaria_relacionado]))
    {



      if($sistema_documentos==1)
      {

        $codigo_registro = $_REQUEST[$chave_primaria_relacionado];
        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documento);  

        $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_REQUEST[$chave_primaria], $conexao);
        $linha = mysql_fetch_array($rs_dados);

        $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos];

        if (file_exists($nome_arquivo))
        {
          unlink($nome_arquivo);
        }
      }




      if($sistema_exclusao==0)
      {
        $sql = "DELETE FROM " . $tabela_relacionado . " WHERE " . $chave_primaria_relacionado ." = " . $_REQUEST[$chave_primaria_relacionado] ; 
      }
      else
      {
        $sql = "UPDATE " . $tabela_relacionado . " SET ativo=0 WHERE " . $chave_primaria_relacionado ." = " . $_REQUEST[$chave_primaria_relacionado] ; 
      }


      

      mysql_query($sql, $conexao); 

    }











      // LOG  

      if($sistema_exclusao==0)
      {
        $acao = "Exclusão do registro relacionado com c�digo " . $_REQUEST[$chave_primaria_relacionado] ;
      }
      else
      {
        $acao = "Desativa��o do registro relacionado com c�digo " . $_REQUEST[$chave_primaria_relacionado] ;
      }


      // Descobrindo qual � o sistema atual

      $sql = "SELECT * FROM tabela_adm_sistemas WHERE codigo_sistema='" . $codigo_modulo . "'";

      $rs_sistema = mysql_query($sql,$conexao) or die("Erro na consulta do sistema!");
      $linha_sistema = mysql_fetch_array($rs_sistema);

      // Descobrindo qual � o nome do usuário

      $sql = "SELECT * FROM tabela_adm_usuarios WHERE email_usuario='" . $_SESSION['login_result'] . "'";
      $rs_usuario = mysql_query($sql, $conexao);
      $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário!");

      // Gravando LOG no banco de dados

      $sql = " INSERT INTO tabela_adm_log ";
      $sql.= " (usuario_log, acao_log, sistema_log, data_log) ";
      $sql.= " VALUES ('" . $linha_usuario['nome_usuario'] . " (login: " . $_SESSION['login_result'] . ")" . "' ,'" . $acao . "','" . $linha_sistema['descricao_sistema'] . "','" . date('d/m/Y - H:i:s') . "')";

      mysql_query($sql,$conexao);






    if($sistema_exclusao==0)
    {

      if($sistema_fotos==1)
      {
        header("Location: excluir_fotos_relacionado.php?pagina=" . $_REQUEST['pagina'] . "&" . $chave_primaria ."=" . $_REQUEST[$chave_primaria_relacionado] . "&cm=" . $codigo_modulo . "&cmr=" . $codigo_modulo_relacionado . "&cpo=" . $chave_primaria_original . "&vcpo=" .  $valor_chave_primaria_original);
      }
      else
      {
        header("Location: " . $_SERVER['HTTP_REFERER']);  
      }
    }
    else
    {
      header("Location: " . $_SERVER['HTTP_REFERER']);  
    }











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
