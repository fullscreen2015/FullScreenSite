<?

function VerificaSistema($sistema, $pag)
{
  include("../../include/sistema_conexao.php"); 

  $sql = "SELECT * FROM tabela_adm_sistemas WHERE pasta_sistema='".$sistema."'";
  $rs = mysql_query($sql,$conexao) or die("erro consulta 1!");
  $fetch = mysql_fetch_array($rs);
	  
  $sql1 = "SELECT * FROM tabela_adm_usuarios WHERE codigo_usuario='".$_SESSION['fw_codigo_usuario']."'";
  $rs1 = mysql_query($sql1, $conexao);
  $fetch1 = mysql_fetch_array($rs1) or die("erro consulta 2!");
	  
	  
  $sql2 = "SELECT * FROM tabela_adm_ass_usuario_sistema_acesso WHERE codigo_usuario='".$fetch1['codigo_usuario']."' AND codigo_sistema='".$fetch['codigo_sistema']."'";
  $rs2 = mysql_query($sql2, $conexao) or die("erro consulta 3!");
	  
  define("CONEXAO", $conexao);
  define("DATA", date('Y/m/d h:i:s'));
  define("SISTEMA", $fetch['descricao_sistema']);	  
  define("USUARIO", $fetch1['nome_usuario']);	
  define("ACAO", $pag );
	  
  while($fetch2 = mysql_fetch_array($rs2))
  {
    if(($fetch2['codigo_tipo']==$pag))
    {
      return true;
    }
  }

  echo "<script>alert('Voc� não tem acesso a esta �rea!');window.location='".$_SERVER['HTTP_REFERER']."'</script>";
	  
  return false;
}






function verifica_usuario($pasta,$permissao)
{
  include("../../include/sistema_conexao.php"); 

  $sql = "SELECT * FROM tabela_adm_sistemas WHERE pasta_sistema='" . $pasta . "'";
  $rs_sistema = mysql_query($sql,$conexao) or die("Erro na consulta do sistema!");
  $linha_sistema = mysql_fetch_array($rs_sistema);
	  
  $sql = "SELECT * FROM tabela_adm_usuarios WHERE codigo_usuario='" . $_SESSION['fw_codigo_usuario'] . "'";
  $rs_usuario = mysql_query($sql, $conexao);
  $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário! COD 001");
	  
	  
  $sql = "SELECT * FROM tabela_adm_ass_usuario_sistema_acesso WHERE codigo_usuario='" . $linha_usuario['codigo_usuario'] . "' AND codigo_sistema='" . $linha_sistema['codigo_sistema'] . "'";
  $rs_acesso = mysql_query($sql, $conexao) or die("Erro na consulta do acesso!  COD 002");



  while($linha_acesso = mysql_fetch_array($rs_acesso))
  {

    if(($linha_acesso['codigo_tipo']==$permissao))
    {
      return true;
    }
  }

  return false;

}







function verifica_usuario2($codigo_modulo,$permissao)
{
  include("../../include/sistema_conexao.php"); 

	  
  $sql = "SELECT * FROM tabela_adm_ass_usuario_sistema_acesso WHERE codigo_usuario=" . $_SESSION['fw_codigo_usuario'] . " AND codigo_sistema=" . $codigo_modulo;
  $rs_acesso = mysql_query($sql, $conexao) or die("Erro na consulta do acesso!  COD 002");


  while($linha_acesso = mysql_fetch_array($rs_acesso))
  {

    if(($linha_acesso['codigo_tipo']==$permissao))
    {
      return true;
    }
  }

  return false;

}

















function verifica_usuario_relatorio($arquivo)
{
  include("../../include/sistema_conexao.php"); 

  $sql = "SELECT * FROM tabela_adm_relatorios WHERE arquivo_relatorio='" . $arquivo . "'";
  $rs_relatorio = mysql_query($sql,$conexao) or die("Erro na consulta do relatorio!  COD 003");
  $linha_relatorio = mysql_fetch_array($rs_relatorio);
	  
  $sql = "SELECT * FROM tabela_adm_usuarios WHERE codigo_usuario='" . $_SESSION['fw_codigo_usuario'] . "'";
  $rs_usuario = mysql_query($sql, $conexao);
  $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário!  COD 004");
	  
	  
  $sql = "SELECT * FROM tabela_adm_ass_usuario_relatorio WHERE codigo_usuario='" . $linha_usuario['codigo_usuario'] . "' AND codigo_relatorio='" . $linha_relatorio['codigo_relatorio'] . "'";
  $rs_acesso = mysql_query($sql, $conexao) or die("Erro na consulta do acesso!  COD 005");
  if(mysql_num_rows($rs_acesso)>0)
  {
    return true;
  }

  return false;

}






function verifica_usuario_grafico($arquivo)
{
  include("../../include/sistema_conexao.php"); 

  $sql = "SELECT * FROM tabela_adm_graficos WHERE arquivo_grafico='" . $arquivo . "'";
  $rs_grafico = mysql_query($sql,$conexao) or die("Erro na consulta do grafico!  COD 003");
  $linha_grafico = mysql_fetch_array($rs_grafico);
	  
  $sql = "SELECT * FROM tabela_adm_usuarios WHERE codigo_usuario='" . $_SESSION['fw_codigo_usuario'] . "'";
  $rs_usuario = mysql_query($sql, $conexao);
  $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário!  COD 004");
	  
	  
  $sql = "SELECT * FROM tabela_adm_ass_usuario_grafico WHERE codigo_usuario='" . $linha_usuario['codigo_usuario'] . "' AND codigo_grafico='" . $linha_grafico['codigo_grafico'] . "'";
  $rs_acesso = mysql_query($sql, $conexao) or die("Erro na consulta do acesso!  COD 005");
  if(mysql_num_rows($rs_acesso)>0)
  {
    return true;
  }

  return false;

}

?>