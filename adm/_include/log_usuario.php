<?
  function gravar_log(nome_usuario, acao_tipo, nome_sistema, tempo_acao)
  {
    $sql = "INSERT INTO tabela_adm_log (nome_usuario, acao_tipo, nome_sistema, tempo_acao) VALUES ('".USUARIO."' ,'".ACAO."','".SISTEMA."','".DATA."')";
    $rs_log = mysql_query($sql, CONEXAO) or die("Falha ao inserir Log!");
  }
?>