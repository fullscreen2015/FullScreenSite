<?php

  // include("include/sistema_session_start.php");
  

  include('include/sistema_email_locaweb.php');
  include('include/sistema_conexao.php');
  include("include/sistema_protecao.php");

    error_reporting(0);


  if(isset($_REQUEST['nome']))
  {
    $nome = anti_injection($_REQUEST['nome']);
  }


  if(isset($_REQUEST['email']))
  {
    $email = anti_injection($_REQUEST['email']);
  }

  if(isset($_REQUEST['mensagem']))
  {
    $corpo_mensagem = anti_injection($_REQUEST['mensagem']);
  }

  $msg="";


  if(($nome != '')  and ($email != '') and ($corpo_mensagem != ''))
  {
    $data_mensagem = date("Ymd");

    //gera o id primary key
    $sql="SELECT codigo_contato FROM tabela_fale_conosco ORDER BY codigo_contato DESC LIMIT 1";
    $sel_codigo_mensagem = mysql_query($sql) or die(mysql_error());
    $codigo_mensagem = mysql_fetch_array($sel_codigo_mensagem);
    $novo_codigo = $codigo_mensagem['codigo_contato'] + 1;


    //insere mensagem com as informações do cliente no banco de dados

    $sql = "INSERT INTO tabela_fale_conosco (codigo_contato, nome_contato, email_contato, mensagem_contato, data_contato) VALUES ('".$novo_codigo."', '".$nome."', '".$email."', '".$corpo_mensagem."', '".$data_mensagem."')";
    mysql_query($sql,$conexao);
    


    // $msg="Dados enviados com sucesso!";



    $remetente = "contato@fullscreen.com.br";
    $destinatario = "contato@fullscreen.com.br";
    $cc = "";
    $cco = "testes@friwebdesign.com.br";
    $nome_visitante = $nome;
    $email_visitante = $email;
    $assunto = "Contato pelo site - Full Screen - " . $nome_visitante;

    /* montando a mensagem */
    $mensagem = "";
    $mensagem.= "Nome: " . $nome . "\n\n<br><br>";
    $mensagem.= "Email: " . $email. "\n\n<br><br>";
    $mensagem.= "Mensagem: " . $corpo_mensagem . "\n\n<br><br>";





    // Pegando o IP 

    if (getenv(HTTP_X_FORWARDED_FOR))
    { 
      $ip=getenv(HTTP_X_FORWARDED_FOR); 
    }
    else 
    { 
      $ip=getenv(REMOTE_ADDR);
    } 

    $ip_visitante = $ip;

    $ip_visitante = $ip_visitante . " ### " . gethostbyaddr ($ip_visitante);




    // Pegando a Data e Hora

    $data_hora_visitante = date("d") . "/" . date("m") . "/" . date("Y") . " - " . date("H") . ":" . date("i");

    $mensagem.= "IP: " . $ip_visitante . "\n\n<br><br>";
    $mensagem.= "Data / Hora: " . $data_hora_visitante . "\n\n<br><br>";
    $mensagem.= "Site de referência: " . $_SESSION['referencia'] . "\n\n<br><br>";


    // envia_email_padrao($remetente,$destinatario,$cc,$cco,$nome_visitante,$email_visitante,$assunto,$mensagem);
    envia_email_padrao($nome, $remetente, 'Contato pelo site - Full Screen', $destinatario,$cc,$cco,'Contato pelo site - Full Screen', 'contato@fullscreen.com.br', $assunto,$mensagem);

    $msg="msg_ok";
  }
  else
  {
   $msg="preencha_msg";
  }

  // if ($msg != "")
  // {
    header ("Location:conteudo.php?conteudo=principal&msg=".$msg);
  // }
  // else
  // {
    
  //    header ("Location:contato-ok.html");

  // }



?>