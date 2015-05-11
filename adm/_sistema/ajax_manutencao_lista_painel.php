<?php

  ob_start();

  session_start(); 

  header("Content-Type: text/html; charset=ISO-8859-1",true);


  /*  echo "


  <script>

  function abrir_painel(codigo_painel,url_painel)
  {
    var nome_div = '#manutencao_painel_' + codigo_painel;
    var div = $(nome_div);
    var url = '../_paineis/' + url_painel;

    var aleatorio = Math.floor(Math.random()*100000);

    div.html('<img src=../_imagens/loading.gif>');
    div.load(url + '?a=' + aleatorio); 
  }


  </script> ";*/


?>

 

<?

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("configuracoes.php");
    include("../_include/topo.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_resolucao.php"); 
    include("../../include/sistema_protecao.php"); 


    $sql = " SELECT tabela_adm_paineis.*";
    $sql.= " FROM tabela_adm_paineis, tabela_adm_usuarios, tabela_adm_ass_usuario_painel";

    $sql.= " WHERE tabela_adm_paineis.publicar=1 ";
    $sql.= " AND email_usuario='" . $_SESSION['login_result'] . "'";
    $sql.= " AND tabela_adm_ass_usuario_painel.codigo_usuario=tabela_adm_usuarios.codigo_usuario";
    $sql.= " AND tabela_adm_ass_usuario_painel.codigo_painel=tabela_adm_paineis.codigo_painel";
    $sql.= " AND tabela_adm_paineis.ativo=1 ";

    $sql.= " GROUP BY tabela_adm_paineis.codigo_painel";
    $sql.= " ORDER BY descricao_painel ASC";

    $rs_paineis = mysql_query($sql, $conexao);


    if(mysql_num_rows($rs_paineis)>0)
    {

      echo '<span  style="float:left; width:100%;  display:inline; clear:both;">';


    
      //$comandos_js = "";

      $clear = 3;
      $y = 1;
      while($linha_painel = mysql_fetch_array($rs_paineis))
      {

        if($y==4){

          $booth = "clear:both;";
        }else{

          $booth = "";

        }


        echo '<span id="manutencao_painel_' . $linha_painel['codigo_painel']  . '" style="float:left; width:300px; height:250px; background-color:#cccccc; padding:10px; margin:0px 10px 10px 0px; display:block; '.$booth.' ">';


        echo "<iframe frameborder='0' scrolling='no' marginwidth='0'  marginheight='0'   width='300' height='240' src='../_paineis/".$linha_painel['arquivo_painel']."' ></iframe>";


        /*$chamada_funcao = "abrir_painel('" . $linha_painel['codigo_painel']  . "','" . $linha_painel['arquivo_painel']  . "');";

        echo '<a href="#" onclick="' . $chamada_funcao . '">abrir</a>';        

        echo '<h3>' . $linha_painel['descricao_painel'] . '</h3>';

        $url = "../_paineis/" . $linha_painel['arquivo_painel'];*/

        echo '</span>';

      /*  $comandos_js.= "
        ";
        $comandos_js.= "abrir_painel('" . $linha_painel['codigo_painel']  . "','" . $linha_painel['arquivo_painel']  . "');";

        $comandos_js.= "
        ";*/


     $y++; }

      echo '</span>';

    /*  if($comandos_js!="")
      {
        
        echo "
        ";
        echo "<script>";

        echo "
        ";

        echo $comandos_js;


        echo "
        ";

        echo "</script>";

      }*/

      


    }

    else
    {
      echo "Não existe nenhum painel dispon�vel. Obrigado!";
    }

  }
  
?>

<?php


 //echo "<iframe frameborder='0' scrolling='no' marginwidth='0'  marginheight='0'   width='1000' height='1000' src='../_sistema/ajax_manutencao_lista_painel2.php' ></iframe>";

	// include("../_sistema/ajax_manutencao_lista_painel2.php");


?>