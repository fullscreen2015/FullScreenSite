<?php

  ob_start();
  session_start(); 
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {




    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_protecao.php"); 
    include("../../include/sistema_zeros.php"); 
	
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 


      $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);

    // Arquivo Personalizado 1 - Antes da Exclusão
    // Arquivo Personalizado 2 - Após a Exclusão

  
    $ap1 = "../_personalizados/" . $codigo_modulo6 . "_excluir_1.php";
    $ap2 = "../_personalizados/" . $codigo_modulo6 . "_excluir_2.php";

    $mostrar_excluir=true;
    // verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
    if((isset($campo_usuario))&&($campo_usuario!=""))
    {
      if((isset($tipo_permissao_usuario))&&(($tipo_permissao_usuario==2)||($tipo_permissao_usuario==3)))
      {
        $sql_verificacao = " SELECT " . $campo_usuario;
        $sql_verificacao.= " FROM " . $tabela;
        $sql_verificacao.= " WHERE " . $chave_primaria . "=" . anti_injection($_REQUEST[$chave_primaria]);
        $rs_verificacao = mysql_query($sql_verificacao);
        $linha_verificacao = mysql_fetch_array($rs_verificacao);

        if($linha_verificacao[$campo_usuario]!=$_SESSION['codigo_usuario'])
        {
          // caso este registro não tenha sido feito pelo usuário logado, o link "excluir" não deve ser exibido.
          $mostrar_excluir=false;
        }
      }
    }






  include("../_include/usuarios_acesso.php");

  $permissao = 7;

  if((verifica_usuario2($codigo_modulo, $permissao))&&($mostrar_excluir==true))
  {


    // Arquivo Personalizado 1 - Antes da Exclusão
    // Arquivo Personalizado 2 - Após a Exclusão

    if(file_exists($ap1))
    {
      include($ap1);
    }







    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = anti_injection($_REQUEST['pagina']);
    }
    else
    {
      $pagina = "1";
    }


    $valor_chave_primaria = anti_injection($_REQUEST[$chave_primaria]);






    if($sistema_exclusao==0)
    {



      if(ISSET($_REQUEST[$chave_primaria]))
      {

        if($sistema_documentos==1)
        {

          $codigo_registro = anti_injection($_REQUEST[$chave_primaria]);
          $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documento);  

          $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . anti_injection($_REQUEST[$chave_primaria]), $conexao);
          $linha = mysql_fetch_array($rs_dados);

          $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos];


          if (file_exists($nome_arquivo))
          {
            unlink($nome_arquivo);
          }
        }





        // SISTEMA PRINCIPAL ##########################################################################

        $sql = "DELETE FROM " . $tabela . " WHERE " . $chave_primaria ." = " . anti_injection($_REQUEST[$chave_primaria]) ; 
        mysql_query($sql, $conexao); 

        // FIM SISTEMA PRINCIPAL ##########################################################################





        // CAMPOS ASSOCIATIVOS ##########################################################################

        for($conta=1;$conta<=$numero_campos_associativos;$conta++)
        {
          $conta_ = (10 + $conta);
          $conta1 = $conta_ . "1";
          $conta2 = $conta_ . "2";
          $conta3 = $conta_ . "3";
          $conta4 = $conta_ . "4";
          $conta5 = $conta_ . "5";
          $conta6 = $conta_ . "6";
          $conta7 = $conta_ . "7";
          $conta8 = $conta_ . "8";
          $conta9 = $conta_ . "9";
          $conta91 = $conta_ . "91";



          $sql = "DELETE FROM " . $campos_associativos[$conta8] . " WHERE " . $campos_associativos[$conta9] . "=" . anti_injection($_REQUEST[$campos_associativos[$conta9]]);

          mysql_query($sql, $conexao); 

        }

        // FIM CAMPOS ASSOCIATIVOS ##########################################################################
















        // CAMPOS INTERLA�ADOS - GRAVANDO ######################################################################


        for($x=1;$x<=$numero_campos_interlacados;$x++)
        {
          $inter_ = (10 + $x);
          $inter1 = $inter_ . "1";
          $inter2 = $inter_ . "2";
          $inter3 = $inter_ . "3";
          $inter4 = $inter_ . "4";
          $inter5 = $inter_ . "5";
          $inter6 = $inter_ . "6";
          $inter7 = $inter_ . "7";
          $inter8 = $inter_ . "8";
          $inter9 = $inter_ . "9";
          $inter10 = $inter_ . "10";
          $inter11 = $inter_ . "11";
          $inter12 = $inter_ . "12";



          $sql = "DELETE FROM " . $campos_interlacados[$inter9] . " WHERE " . $campos_interlacados[$inter11] . "=" . anti_injection($_REQUEST[$chave_primaria]);
          mysql_query($sql, $conexao); 


        }


        // FIM CAMPOS INTERLA�ADOS - GRAVANDO ######################################################################






















        // SISTEMAS RELACIONADOS ##########################################################################


        // preservando vari�veis do sistema original
        $chave_primaria_original = $chave_primaria;



        for($y=1;$y<=$numero_sistemas_relacionados;$y++)
        {

          include("../_configuracoes/" . zerosaesquerda($sistema_relacionado[$y],6) . ".php");
		  
          $tabela_relacionado = $tabela;
          $chave_primaria_relacionado = $chave_primaria;

          $sql = " DELETE FROM ";
          $sql.= $tabela_relacionado;
          $sql.= " WHERE ";
          $sql.= $chave_primaria_original  . "=" . anti_injection($_REQUEST[$chave_primaria_original]);

          mysql_query($sql, $conexao); 

        }

        // FIM SISTEMAS RELACIONADOS ##########################################################################









      }

    }
    else
    {

      if(ISSET($_REQUEST[$chave_primaria]))
      {
        $sql = "UPDATE " . $tabela . " SET ativo=0 WHERE " . $chave_primaria ." = " . $valor_chave_primaria; 
        mysql_query($sql, $conexao); 
      }

    }



    if(file_exists($ap2))
    {
      include($ap2);
    }



    // LOG  

    if($sistema_exclusao==0)
    {
      $acao = "Exclusão do registro com c�digo " . $valor_chave_primaria;
    }
    else
    {
      $acao = "Desativa��o do registro com c�digo " . $valor_chave_primaria ;
    }


    // Descobrindo qual � o sistema atual

    $sql = "SELECT * FROM tabela_adm_sistemas WHERE codigo_sistema='" . $codigo_modulo . "'";
    $rs_sistema = mysql_query($sql,$conexao) or die("Erro na consulta do sistema!");
    $linha_sistema = mysql_fetch_array($rs_sistema);

    // Descobrindo qual � o nome do usuário

    $sql = "SELECT * FROM tabela_adm_usuarios WHERE email_usuario='" . $_SESSION['login_result'] . "'";
    $rs_usuario = mysql_query($sql, $conexao);
    $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário!");

    // Gravando LOG no banco de dados

    $sql = " INSERT INTO tabela_adm_log ";
    $sql.= " (usuario_log, acao_log, sistema_log, data_log) ";
    $sql.= " VALUES ('" . $linha_usuario['nome_usuario'] . " (login: " . $_SESSION['login_result'] . ")" . "' ,'" . $acao . "','" . $linha_sistema['descricao_sistema'] . "','" . date('d/m/Y - H:i:s') . "')";

    mysql_query($sql,$conexao);





    if($sistema_exclusao==0)
    {

      if($sistema_fotos==1)
      {
        header("Location: excluir_fotos.php?codigo_modulo=" . $codigo_modulo . "&pagina=".$pagina . "&" . $chave_primaria ."=" . $valor_chave_primaria);  
      }
      else
      {
        header("Location: painel.php?codigo_modulo=" . $codigo_modulo . "&pagina=".$pagina);  
      }
    }
    else
    {
      header("Location: painel.php?codigo_modulo=" . $codigo_modulo . "&pagina=".$pagina);  
    }






  }
  else
  {
    header("Location: " . $_SERVER['HTTP_REFERER']);  
  }











  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }
  ob_end_flush();

?>
