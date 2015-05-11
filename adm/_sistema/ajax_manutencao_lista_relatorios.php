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


    $sql = " SELECT tabela_adm_relatorios.*";
    $sql.= " FROM tabela_adm_relatorios, tabela_adm_usuarios, tabela_adm_ass_usuario_relatorio";

    $sql.= " WHERE tabela_adm_relatorios.publicar='1' ";
    $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
    $sql.= " AND tabela_adm_ass_usuario_relatorio.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
    $sql.= " AND tabela_adm_ass_usuario_relatorio.codigo_relatorio=tabela_adm_relatorios.codigo_relatorio";
 
    $sql.= " GROUP BY tabela_adm_relatorios.codigo_relatorio";
    $sql.= " ORDER BY descricao_relatorio ASC";

    $rs_relatorios = mysql_query($sql, $conexao);


    echo '<table cellpadding=4 cellspacing=1 border=0>';

    ?>


    <?


    $x=0;
    while($linha_relatorio = mysql_fetch_array($rs_relatorios))
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



      $quantidade_itens_relatorio = "";
      if(ISSET($linha_relatorio['sql_relatorio']))
      {
        if($linha_relatorio['sql_relatorio']!="")
        {
          if((substr_count($linha_relatorio['sql_relatorio'], 'COUNT'))&&(substr_count($linha_relatorio['sql_relatorio'], 'quantreg')))
          {
            $rs_quantidade_itens_relatorio=mysql_query($linha_relatorio['sql_relatorio'],$conexao);
            $linha_quantidade_itens_relatorio = mysql_fetch_array($rs_quantidade_itens_relatorio);
            $quantidade_itens_relatorio = $linha_quantidade_itens_relatorio['quantreg'];
          }
          else
          {
            $rs_quantidade_itens_relatorio=mysql_query($linha_relatorio['sql_relatorio'],$conexao);
            $quantidade_itens_relatorio = mysql_num_rows($rs_quantidade_itens_relatorio);
          }
        }
      }

      echo '<tr>';

      echo '<td bgcolor='.$cor.'>';
      echo '<img src="../_imagens/seta_proxima.gif">';

      echo ' <a href="../_relatorios/' . $linha_relatorio['arquivo_relatorio'] . '" class=caminho>';
      echo '<b>' . $linha_relatorio['descricao_relatorio'] . '</b></a>';


      echo '</td>';

      echo '<td bgcolor='.$cor.'>';

      echo '<font class=caminho>';

      if($quantidade_itens_relatorio != "")
      {
        if($quantidade_itens_relatorio==1)
        {
          echo ' ['.$quantidade_itens_relatorio.' registro]';
        }
        else
        {
          echo ' ['.$quantidade_itens_relatorio.' registros]';
        }
      }
      
      echo '</font>';

      echo '</td>';
  
      echo '</tr>';

    }

    echo '</table>';

  }

?>