<?php

  ob_start();
  session_start(); 

  include("../../include/sistema_conexao.php"); 
  include("../../include/sistema_protecao.php"); 


  $login = anti_injection($_REQUEST['login']);
  $senha = anti_injection($_REQUEST['senha']);


  $sql = " SELECT * FROM ";
  $sql.= " tabela_adm_usuarios";
  $sql.= " WHERE email_usuario LIKE '".$login."'";
  $sql.= " AND senha_usuario LIKE '".md5($senha)."'";
  $sql.= " AND publicar=1";
  $sql.= " AND ativo=1";

/*   $sql = " SELECT * FROM ";
  $sql.= " tabela_adm_usuarios";
  $sql.= " WHERE email_usuario LIKE '".$login."'";
  $sql.= " AND senha_usuario LIKE '".$senha."'";
  $sql.= " AND publicar=1";
  $sql.= " AND ativo=1";*/


  $rs_usuarios = mysql_query($sql,$conexao);

  if(mysql_num_rows($rs_usuarios)>0)
  {
    

    $linha_usuario = mysql_fetch_array($rs_usuarios);

    $_SESSION['senha_result'] = $linha_usuario['senha_usuario'];
    $_SESSION['login_result'] = $linha_usuario['email_usuario'];
    $_SESSION['codigo_usuario'] = $linha_usuario['codigo_usuario'];
    $_SESSION['fw_codigo_usuario'] = $linha_usuario['codigo_usuario'];
    
    $_SESSION['nome_usuario'] = $linha_usuario['nome_usuario'];

    setcookie("fw_login", $_SESSION['login_result'], time()+172800, "/");


    header("Location: php_manutencao.php");  
	
  }
  else
  {
    header("Location: php_manutencao_login.php");  
  }

  ob_end_flush();
  
?>