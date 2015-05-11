<?php

	session_start();
	include("include/sistema_conexao.php");
	include("include/sistema_protecao.php");
	include("include/sistema_link.php");

	if(isset($_POST['email']))
    {
	   $login = anti_injection($_POST['email']);
    }

    if(isset($_POST['senha']))
    {
      $senha = anti_injection($_POST['senha']);
      $senha = md5($senha);
    }

    //verifica se eh cadastrado
    $sql = "SELECT * FROM tabela_clientes WHERE email_cliente = '".$login."' AND senha_cliente = '".$senha."' AND publicar=1 AND ativo=1";

    $rs_usuario = mysql_query($sql,$conexao)or die(mysql_error());
    $usuario = mysql_fetch_array($rs_usuario);
    $usuario_num = mysql_num_rows($rs_usuario);


    if($usuario_num > 0)
    {
    	$_SESSION['codigo_logado_fullscren'] = $usuario['codigo_cliente'];
    	$_SESSION['logado_fullscren'] = '1';

    	$url = "area-clientes.html";
    	header("location:".$url); 
    	exit();

    }
    else
    {

      $link_ht = linkht('lo,','login_incorreto','Erro de login Full Scren');

      header("location:".$link_ht."");
      exit();
    }


?>