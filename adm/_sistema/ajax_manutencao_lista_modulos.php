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




    echo '<table cellpadding=4 cellspacing=1 border=0>';

    $sql = " SELECT DISTINCT tabela_adm_sistemas.codigo_sistema, descricao_sistema, campo_principal_sistema, tabela_sistema, sistema_exclusao";
    $sql.= " FROM tabela_adm_sistemas, tabela_adm_usuarios, tabela_adm_ass_usuario_sistema_acesso ";

    $sql.= " WHERE tabela_adm_sistemas.publicar='1' ";
    $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
    $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
    $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_sistema=tabela_adm_sistemas.codigo_sistema";

    $sql.= " ORDER BY descricao_sistema ASC";

    $rs_modulos = mysql_query($sql, $conexao);
    $x=0;
    while($linha_modulo = mysql_fetch_array($rs_modulos))
    {
      $x++;
      if($x%2)
      {
        $cor = "#e3e3e3";
      }
      else
      {
        $cor = "#d3d3d3";
      }


      $numero_registros = 0;
      if(($linha_modulo['tabela_sistema']!="")&&($linha_modulo['campo_principal_sistema']!=""))
      {

        $sql = " SELECT COUNT(" . $linha_modulo['campo_principal_sistema'] . ") as quantidade ";
        $sql.= " FROM " . $linha_modulo['tabela_sistema'];
        if($linha_modulo['sistema_exclusao']==1)
        {
          $sql.= " WHERE ativo=1";
        }

        $rs_modulo_atual = mysql_query($sql, $conexao);
        $linha_modulo_atual = mysql_fetch_array($rs_modulo_atual);
        $numero_registros = $linha_modulo_atual['quantidade'];
      }



      echo '<tr>';

      echo '<td width="400" bgcolor='.$cor.'>';
      echo '<img src="../_imagens/seta_proxima.gif">';
      echo '&nbsp;<a href="../_modulos/painel.php?codigo_modulo=' . $linha_modulo['codigo_sistema'] . '" class=caminho>';
      echo '<b>' . $linha_modulo['descricao_sistema'] . '</b></font></a>';
      echo '</td>';

      echo '<td bgcolor='.$cor.'>';



      $sql = " SELECT tabela_adm_sistemas.codigo_sistema";
      $sql.= " FROM tabela_adm_sistemas, tabela_adm_usuarios, tabela_adm_ass_usuario_sistema_acesso ";
      $sql.= " WHERE tabela_adm_sistemas.codigo_sistema=" . $linha_modulo['codigo_sistema'];
      $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_sistema=tabela_adm_sistemas.codigo_sistema";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_tipo=3";
      $rs_acesso = mysql_query($sql, $conexao);
      if(mysql_num_rows($rs_acesso)>0)
      {
        echo '<a alt="Inserir Registro" title="Inserir Registro" href="../_modulos/inserir.php?codigo_modulo=' . $linha_modulo['codigo_sistema'] . '" class=caminho>';
        echo '[+]</font></a>';
      }

      echo '</td>';

      echo '<td bgcolor='.$cor.'>';
      if($numero_registros==1)
      {
        echo '&nbsp;<a href="../_modulos/painel.php?codigo_modulo=' . $linha_modulo['codigo_sistema'] . '" class=caminho>';
        echo '[visualizar ' . $numero_registros . ' registro]</font></a>';
      }
      if($numero_registros>1)
      {
        echo '&nbsp;<a href="../_modulos/painel.php?codigo_modulo=' . $linha_modulo['codigo_sistema'] . '" class=caminho>';
        echo '[visualizar ' . $numero_registros . ' registros]</font></a>';
      }
      echo '</td>';
 

      echo '</tr>';

    }

    echo '</table>';

  }

?>