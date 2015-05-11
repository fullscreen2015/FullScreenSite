<?php
  
   header("Content-Type: text/html; charset=ISO-8859-1",true);    
  
  session_start(); 
  
   include("../../include/sistema_conexao.php");

   echo '<script src="../_js/funcoes.js" type="text/javascript"></script>';


   echo "<div id='acesso_rapido' style='margin-top:-5px;''>";
    if(ISSET($_SESSION['login_result']))
    {

      $sql = " SELECT DISTINCT descricao_sistema, tabela_adm_sistemas.codigo_sistema";
      $sql.= " FROM tabela_adm_sistemas, tabela_adm_usuarios, tabela_adm_ass_usuario_sistema_acesso ";

      $sql.= " WHERE tabela_adm_sistemas.publicar='1' ";
      $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_sistema=tabela_adm_sistemas.codigo_sistema";
      $sql.= " AND tabela_adm_usuarios.publicar=1";
      $sql.= " AND tabela_adm_sistemas.publicar=1";

      $sql.= " ORDER BY descricao_sistema ASC";

      $rs_sistemas = mysql_query($sql, $conexao);

      echo '<td bgcolor="#bbbbbb" align="left">';
      echo '<form name=menu style="border:0px; margin:0px 0px 0px -45px;">';
      echo '<font class="relatorio">Acesso Rápido</font>';
      echo '<select class="select" name=sistema onchange="javascript:abre_sistema(this.value);">';
      echo '<option value=""><font class="relatorio">SELECIONE O MÓDULO ___</font></option>';
      while($linha_sistema = mysql_fetch_array($rs_sistemas))
      {
        echo '<option value="_modulos/painel.php?codigo_modulo='.$linha_sistema['codigo_sistema'].'"><font class="relatorio">'.$linha_sistema['descricao_sistema'].'</font></option>';
      }


      $sql = " SELECT DISTINCT descricao_relatorio, arquivo_relatorio";
      $sql.= " FROM tabela_adm_relatorios, tabela_adm_usuarios, tabela_adm_ass_usuario_relatorio ";

      $sql.= " WHERE tabela_adm_relatorios.publicar='1' ";
      $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
      $sql.= " AND tabela_adm_ass_usuario_relatorio.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
      $sql.= " AND tabela_adm_ass_usuario_relatorio.codigo_relatorio=tabela_adm_relatorios.codigo_relatorio";
      $sql.= " AND tabela_adm_usuarios.publicar=1";
      $sql.= " AND tabela_adm_relatorios.publicar=1";

      $sql.= " ORDER BY descricao_relatorio ASC";

      $rs_relatorios = mysql_query($sql,$conexao);

      while($linha_relatorio = mysql_fetch_array($rs_relatorios))
      {
        echo '<option value="_relatorios/'.$linha_relatorio['arquivo_relatorio'].'"><font class="relatorio">R - '.$linha_relatorio['descricao_relatorio'].'</font></option>';
      }

      echo '</select>';

      echo '</form>';
      echo '</td>';
    }

    echo "</div>";

?>