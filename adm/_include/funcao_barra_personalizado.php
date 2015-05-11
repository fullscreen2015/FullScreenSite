<?

  function barra($nome1,$link1,$nome2,$link2,$nome3,$link3,$nome4,$link4)
  {  
    global $conexao;


    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
    echo '<tr>';
    echo '<td height="3" bgcolor="#cccccc"><img src="nada.gif" width="1" height="1"></td>';
    echo '</tr>';
    echo '</table>';

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="top"> ';
    echo '<td bgcolor="#bbbbbb" width="100" weight="22">';

    echo '&nbsp;&nbsp;&nbsp;';
    echo '<a href="http://www.friweb.com.br" target="_blank"><img src=../../_imagens/logo-friweb-pequena.png style="margin-top:1px; border:0px;"></a></td>';

    echo '<td bgcolor="#bbbbbb">';
    if ($nome1!="")
    {  

      echo '&nbsp;&nbsp;&nbsp;';

      if ($link1!="")
      {  
        echo '<a href="' . $link1 . '" class="caminho"><b>' . $nome1 . '</b></a>';
      }
      else
      {
        echo '<font class="caminho"><b>' . $nome1 . '</b></font>';
      }

    }


    if ($nome2!="")
    {  

      if ($link2!="")
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<a href="' . $link2 . '" class="caminho"><b>' . $nome2 . '</b></a>';
      }
      else
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<font class="caminho"><b>' . $nome2 . '</b></font>';
      }

    }


    if ($nome3!="")
    {  

      if ($link3!="")
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<a href="' . $link3 . '" class="caminho"><b>' . $nome3 . '</b></a>';
      }
      else
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<font class="caminho"><b>' . $nome3 . '</b></font>';
      }

    }


    if ($nome4!="")
    {  
      if ($link4!="")
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<a href="' . $link4 . '" class="caminho"><b>' . $nome4 . '</b></a>';
      }
      else
      {  
        echo '<font class="caminho"><b> :: </b></font>';
        echo '<font class="caminho"><b>' . $nome4 . '</b></font>';
      }
    }

    echo '</td>';

    if(ISSET($_SESSION['login_result']))
    {

      $sql = " SELECT DISTINCT descricao_sistema, tabela_adm_sistemas.codigo_sistema";
      $sql.= " FROM tabela_adm_sistemas, tabela_adm_usuarios, tabela_adm_ass_usuario_sistema_acesso ";

      $sql.= " WHERE tabela_adm_sistemas.publicar='1' ";
      $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
      $sql.= " AND tabela_adm_ass_usuario_sistema_acesso.codigo_sistema=tabela_adm_sistemas.codigo_sistema";

      $sql.= " ORDER BY descricao_sistema ASC";

      $rs_sistemas = mysql_query($sql, $conexao);

      echo '<td bgcolor="#bbbbbb" align="right">';
      echo '<form name=menu style="border:0px; margin:0px;">';
      echo '<font class="caminho">Acesso Rápido </font>';
      echo '<select class="select" name=sistema onchange="javascript:abre_sistema(this.value);">';
      echo '<option value="">SELECIONE O MÓDULO ___</option>';
      while($linha_sistema = mysql_fetch_array($rs_sistemas))
      {
        echo '<option value="../_modulos/painel.php?codigo_modulo='.$linha_sistema['codigo_sistema'].'">'.$linha_sistema['descricao_sistema'].'</option>';
      }
      echo '</select>';
      echo '</form>';
      echo '</td>';
    }
  
    echo '<td bgcolor="#bbbbbb" align="right">';
    echo '<a href="../../_sistema/php_manutencao_sair.php" class="caminho"><b>logout >>></b></a>&nbsp;&nbsp;&nbsp;</td>';
    echo '</tr>';
    echo '</table>';

    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
    echo '<tr>';
    echo '<td height="2" bgcolor="#999999"><img src="nada.gif" width="1" height="1"></td>';
    echo '</tr>';
    echo '</table>';

    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
    echo '<tr>';
    echo '<td height="1" bgcolor="#000000"><img src="nada.gif" width="1" height="1"></td>';
    echo '</tr>';
    echo '</table>';

  } 

?>