<?php

  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {








  
  include("../_include/usuarios_acesso.php");
  include("../../include/sistema_protecao.php"); 
  



  // Arquivo Personalizado 1 - Antes de publicar
  // Arquivo Personalizado 2 - Depois de publicar

  
    $ap1 = "../_personalizados/" . $codigo_modulo6 . "_publicar_1.php";
    $ap2 = "../_personalizados/" . $codigo_modulo6 . "_publicar_2.php";

    


  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	
  $permissao = 5;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {

	
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php"); 

    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = $_REQUEST['pagina'];
    }
    else
    {
      $pagina = "1";
    }
      
    if(file_exists($ap1))
    {
      include($ap1);
    }
    

    if(ISSET($_REQUEST[$chave_primaria]))
    {
      if(ISSET($_REQUEST['campo']))
      {
        $campo=$_REQUEST['campo'];
      }
      else
      {
        $campo='publicar';
      }


      $sql = "UPDATE " . $tabela . " SET " . $campo . "=" . $_REQUEST['cod'] . " WHERE " . $chave_primaria ." = " . $_REQUEST[$chave_primaria];

     
      mysql_query($sql, $conexao);

      
      if(file_exists($ap2))
      {
        include($ap2);
      }
    

    }










    // LOG  

    $acao = "Publica��o do registro com c�digo " . $_REQUEST[$chave_primaria] ;

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





    header("Location: " . $_SERVER['HTTP_REFERER']);



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