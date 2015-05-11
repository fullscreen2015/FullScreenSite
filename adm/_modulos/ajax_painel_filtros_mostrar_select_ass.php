<?php

  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_conexao.php"); 
    include("../_include/usuarios_acesso.php");
    include("../../include/sistema_zeros.php"); 
  	include("../../include/sistema_protecao.php"); 

	
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	
	
    $permissao = 5;

    if(verifica_usuario2($codigo_modulo, $permissao))
    {
  

      include("../_include/funcao_selecao.php");
      include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 



      $cont = utf8_decode($_REQUEST['cont']);

      $codigo_registro = (int)utf8_decode($_REQUEST['codigo_registro']);

      $valor_atual = (int)utf8_decode($_REQUEST['valor_atual']);



    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont4 = $cont_ . "4";
    $cont5 = $cont_ . "5";
    $cont6 = $cont_ . "6";
    $cont7 = $cont_ . "7";
    $cont8 = $cont_ . "8";
    $cont9 = $cont_ . "9";
    $cont91 = $cont_ . "91";


      $sistema_exclusao = 0;
      if($campos[$cont4]=="0")      
      {
        $sistema_exclusao = 1;
      }

/*  $campo_ass_tabela = explode(",",$campos_associativos[$cont6]);
  $campo_ass_tabela = trim($campo_ass_tabela[0]);

  $campo_ass_desc = explode(",",$campos_associativos[$cont7]);
  $campo_ass_desc = trim($campo_ass_desc[0]);*/

  $campo_ass_tabela = $campos_associativos[$cont6];
    $campo_ass_desc = $campos_associativos[$cont7];
  
        select_painel_filtros_edit_ass($campos_associativos[$cont2],$campo_ass_tabela,$campos_associativos[$cont5],$campo_ass_desc,$campos_associativos[$cont1],$sistema_exclusao,$codigo_registro,$valor_atual,$campos_associativos[$cont8]);  


    }
    else
    {
      echo "Permissão negada.";
    }

  }
  else
  {
    echo "Permissão negada.";
  }




?>