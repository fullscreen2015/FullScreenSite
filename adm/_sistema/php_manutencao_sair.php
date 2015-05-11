<?
  ob_start();
  session_start(); 

//  $_SESSION['senha_result']="";
//  $_SESSION['login_result']="";


  unset($_SESSION['senha_result']);
  unset($senha_result); 

  unset($_SESSION['login_result']);
  unset($login_result); 

  unset($_SESSION['fw_codigo_usuario']);
  unset($fw_codigo_usuario); 




  header("Location: php_manutencao_login.php");
  ob_end_flush();
?>