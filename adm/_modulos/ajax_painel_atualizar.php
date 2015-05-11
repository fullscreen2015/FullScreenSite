<?

  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



    include("../../include/sistema_conexao.php"); 
    include("../_include/usuarios_acesso.php");
    include("../../include/sistema_protecao.php"); 
	
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);

    $permissao = 5;

    if(verifica_usuario2($codigo_modulo, $permissao))
    {
  

      include("../_include/funcao_prepara_campos.php");
      include("../../include/sistema_zeros.php"); 
      include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 




      $campo = utf8_decode($_REQUEST['campo']);
      $campo = prepara_campo($campo,'varchar');

      $valor = utf8_decode($_REQUEST['valor']);
      $valor = prepara_campo($valor,'varchar');

      $valor_chave_primaria = utf8_decode($_REQUEST['chave_primaria']);
      $valor_chave_primaria = prepara_campo($valor_chave_primaria,'chave_primaria');



      $sql = "UPDATE " . $tabela . " SET " . $campo . "='".$valor."' WHERE " . $chave_primaria . "=" . $valor_chave_primaria; 

      mysql_query($sql,$conexao)or die(mysql_error());




      // LOG  

      $acao = "Altera��o do registro com c�digo " . $valor_chave_primaria ;


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

      mysql_query($sql,$conexao)or die(mysql_error());







      echo "Dados gravados com sucesso!";

    }
    else
    {
      echo "Permiss�o negada.";
    }

  }
  else
  {
    echo "Permiss�o negada.";
  }




?>