<?php

  ob_start();

  session_start(); 
  
  header("Content-Type: text/html; charset=ISO-8859-1",true);  
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("configuracoes.php");
    include("../_include/topo.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_resolucao.php"); 
    include("../../include/sistema_protecao.php"); 

    $sql_verificacao = " SELECT administrador_sistema";
    $sql_verificacao.= " FROM tabela_adm_usuarios";
    $sql_verificacao.= " WHERE codigo_usuario=" . $_SESSION['fw_codigo_usuario'];
    $rs_verificacao = mysql_query($sql_verificacao);
    $linha_verificacao = mysql_fetch_array($rs_verificacao);

    if($linha_verificacao['administrador_sistema']==1)
    {

      echo '<br><br><img src="../_imagens/seta_proxima.gif">&nbsp;';
      echo '<a href="php_backup.php" class=caminho>';
      echo '<b>Backup do Banco de Dados</b></font></a>';
    }

    echo '<br><br><img src="../_imagens/seta_proxima.gif">&nbsp;';
    echo '<a href="php_manutencao_sair.php" class=caminho>';
    echo '<b>Sair do Sistema</b></font></a>';

    echo '<br><br><img src="../_imagens/seta_proxima.gif">&nbsp;';
    echo '<a href="php_suporte.php" class=caminho>';
    echo '<b>Suporte Friweb</b></font></a>';

  }
  
?>    