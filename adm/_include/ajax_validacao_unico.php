<?

  header("Content-Type: text/html; charset=ISO-8859-1",true);

  include("../../include/sistema_conexao.php"); 

  $sql = "SELECT " . $_REQUEST['campo'] . " FROM ";
  $sql.= $_REQUEST['tabela'];
  $sql.= " WHERE " . $_REQUEST['campo'] . " LIKE '" . $_REQUEST['valor'] . "'";

  if($_REQUEST['exclusao']==1)
  {
    $sql.= " AND ativo=1";
  }


  if(ISSET($_REQUEST['valor_inicial']))
  {
    $sql.= " AND " . $_REQUEST['campo'] . " <> '" . $_REQUEST['valor_inicial'] . "'";
  }
  
  $rs_unico = mysql_query($sql,$conexao);

  $erro="";

  if(mysql_num_rows($rs_unico)>0)
  {
    $erro="Este valor já est� sendo utilizado. Por favor, experimente outro.";
  }


  if($erro!="")
  {
    echo '<img src="../_imagens/erro.png" alt="'.$erro.'" title="'.$erro.'">';
    echo "<input type='hidden' name='".$_REQUEST['campo']."_validacao' value='x' alt='ajax' title='".$erro."'>";
  }
  else
  {
    echo '<img src="../_imagens/ok.png">';
    echo "<input type='hidden' name='".$_REQUEST['campo']."_validacao' alt='ajax' value='ok'>";
  }

?>