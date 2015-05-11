<?

  /* Retorna usuario */

  $sql_user = "SELECT * FROM tabela_adm_usuarios WHERE email_usuario='".$_SESSION['login_result']."'";
  $rs_user = mysql_query($sql_user, $conexao);
  $fetch_user = mysql_fetch_array($rs_user);
  $user = $fetch_user['codigo_usuario'];
  
  
//  $sql_admin = "SELECT * FROM tabela_adm_usuarios WHERE tipo_usuario='administrador' ";
//  $rs_admin = mysql_query($sql_admin, $conexao);
//  $fetch_admin = mysql_fetch_array($rs_admin);
//  $admin = $fetch_admin['email_usuario'];  


  //echo "<b>usuário:</b> ".$fetch_user['email_usuario'];
  
  /* Retorna usuário */
  
  function filtra_por_usuario($codigo_usuario, $login){
  	if($codigo_usuario == $GLOBALS['user'] || $login == $GLOBALS['admin']){
		return true;
	}
	else{
		return false;
	}
  }
  
 ?>