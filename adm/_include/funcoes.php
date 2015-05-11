<?

function VerificaUsuario(){
include("../../include/sistema_conexao.php");
  $sql = " SELECT * FROM ";
  $sql.= " tabela_usuarios";
  $sql.= " WHERE email_usuario LIKE '".$_SESSION['login_result']."'";
  $sql.= " AND senha_usuario LIKE '".$_SESSION['senha_result']."'";	
  
  $rs = mysql_query($sql,$conexao);
  
  $fetch = mysql_fetch_array($rs); 
  
}

?>