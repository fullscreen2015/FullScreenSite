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


    $sql = " SELECT tabela_adm_graficos.*";
    $sql.= " FROM tabela_adm_graficos, tabela_adm_usuarios, tabela_adm_ass_usuario_grafico";

    $sql.= " WHERE tabela_adm_graficos.publicar='1' ";
    $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
    $sql.= " AND tabela_adm_ass_usuario_grafico.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
    $sql.= " AND tabela_adm_ass_usuario_grafico.codigo_grafico=tabela_adm_graficos.codigo_grafico";
 
    $sql.= " GROUP BY tabela_adm_graficos.codigo_grafico";
    $sql.= " ORDER BY descricao_grafico ASC";

    $rs_graficos = mysql_query($sql, $conexao);


    if(mysql_num_rows($rs_graficos)>0)
    {


      echo '<table cellpadding=4 cellspacing=1 border=0>';




      $x=0;
      while($linha_grafico = mysql_fetch_array($rs_graficos))
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



        $quantidade_itens_grafico = "";
        if(ISSET($linha_grafico['sql_grafico']))
        {
          if($linha_grafico['sql_grafico']!="")
          {
            $rs_quantidade_itens_grafico=mysql_query($linha_grafico['sql_grafico'],$conexao);
            $quantidade_itens_grafico = mysql_num_rows($rs_quantidade_itens_grafico);
          }
        }

        echo '<tr>';

        echo '<td bgcolor='.$cor.'>';
        echo '<img src="../_imagens/seta_proxima.gif">';

        echo ' <a href="../_graficos/' . $linha_grafico['arquivo_grafico'] . '" class=caminho>';
        echo '<b>' . $linha_grafico['descricao_grafico'] . '</b></a>';


        echo '</td>';

        echo '<td bgcolor='.$cor.'>';

        echo '<font class=caminho>';

        if($quantidade_itens_grafico != "")
        {
          if($quantidade_itens_grafico==1)
          {
            echo ' ['.$quantidade_itens_grafico.' registro]';
          }
          else
          {
            echo ' ['.$quantidade_itens_grafico.' registros]';
          }
        }
        
        echo '</font>';

        echo '</td>';
    
        echo '</tr>';

      }

      echo '</table>';
    }

    else
    {
      echo "Não existe nenhum gr�fico dispon�vel. Obrigado!";
    }

  }
  
?>