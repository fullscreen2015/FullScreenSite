<?php

  ob_start();

  session_start(); 


  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("configuracoes.php");
    include("../_include/topo.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_resolucao.php"); 
    include("../../include/sistema_protecao.php"); 


    // Arquivo Personalizado 1 - Antes da Barra
  
    $ap1 = "../_personalizados/manutencao_1.php";
    
    if(file_exists($ap1))
    {
      include($ap1);
    }
    
    



    barra("Menu Principal","index.php","","","","","","");  


    echo '<div style="float:left; margin:0px 0px 0px 0px; padding:20px;">';

    echo '<div id="manutencao_botoes" style="float:left; width:100%; margin:0px 0px 0px 0px; clear:both;">';


    echo '<div style="float:left; margin:0px 20px 0px 0px; padding:20px;">';
    echo '<img style="cursor:pointer;" src="../_imagens/icones_painel.png" id="botao_lista_painel">';
    echo '</div>';

    echo '<div style="float:left; margin:0px 20px 0px 0px; padding:20px;">';
    echo '<img style="cursor:pointer;" src="../_imagens/icones_modulos.png" id="botao_lista_modulos">';
    echo '</div>';

    echo '<div style="float:left; margin:0px 20px 0px 0px; padding:20px;">';
    echo '<img style="cursor:pointer;" src="../_imagens/icones_relatorios.png" id="botao_lista_relatorios">';
    echo '</div>';

    echo '<div style="float:left; margin:0px 20px 0px 0px; padding:20px;">';
    echo '<img style="cursor:pointer;" src="../_imagens/icones_graficos.png" id="botao_lista_graficos">';
    echo '</div>';

    echo '<div style="float:left; margin:0px 20px 0px 0px; padding:20px;">';
    echo '<img style="cursor:pointer;" src="../_imagens/icones_sistema.png" id="botao_lista_sistema">';
    echo '</div>';

    echo '</div>';

    echo '<div id="manutencao_listas" style="float:left; margin:20px 0px 0px 0px; clear:both;">';

    echo '<div id="manutencao_lista_painel" style="float:left; width:100%; clear:both;"></div>';

    echo '<div id="manutencao_lista_modulos" style="float:left; width:600px;"></div>';

    echo '<div id="manutencao_lista_relatorios" style="float:left; width:600px;"></div>';

    echo '<div id="manutencao_lista_graficos" style="float:left; width:600px;"></div>';

    echo '<div id="manutencao_lista_sistema" style="float:left; width:600px;"></div>';

    echo '</div>';

    echo '</div>';

    // EXIBIR MENSAGENS GERAIS

    if(isset($_REQUEST['msg']))
    {
      echo "<script language='javascript'>";
      echo "window.onload=function(){";
      echo "alert('" . anti_injection($_REQUEST['msg']) . "')";
      echo "}";
      echo "</script>";
    }





    echo '</body>';
    echo '</html>';

    mysql_close($conexao);



  }
  else
  {
    header("Location: php_manutencao_login.php");  
  }

  ob_end_flush();

?>