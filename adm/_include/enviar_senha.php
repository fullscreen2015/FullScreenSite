<?php

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_protecao.php");
  include("../_sistema/configuracoes.php");
  include("../_include/topo.php"); 
  


  function gerar_senha ($tamanho, $maiuscula, $minuscula, $numeros, $codigos)
  {
    $maius = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $minus = "abcdefghijklmnopqrstuwxyz";
    $numer = "0123456789";
    $codig = '!@#$%&*()-+.,;?{[}]^><:|';
 
    $base = '';
    $base .= ($maiuscula) ? $maius : '';
    $base .= ($minuscula) ? $minus : '';
    $base .= ($numeros) ? $numer : '';
    $base .= ($codigos) ? $codig : '';
 
    srand((float) microtime() * 10000000);
    $senha = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $senha .= substr($base, rand(0, strlen($base)-1), 1);
    }
    return $senha;
  }
 





  barra("Sistema de Administra��o - Recupera��o de senha","../index.php","","","","","","");

  $email = anti_injection($_REQUEST['email']);


  // LOG  
  

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


  $acao = "Solicita��o de envio de senha via Esqueci Senha do usuário " . $email . ". IP: " . $ip_visitante;


  // Gravando LOG no banco de dados

  $sql = " INSERT INTO tabela_adm_log ";
  $sql.= " (usuario_log, acao_log, sistema_log, data_log) ";
  $sql.= " VALUES ('" . $email . "' ,'" . $acao . "','Esqueci Senha','" . date('d/m/Y - H:i:s') . "')";

  mysql_query($sql,$conexao);






  $sql = "SELECT * FROM tabela_adm_usuarios WHERE email_usuario LIKE '" . $email . "'";
  $rs_senha = mysql_query($sql, $conexao);
  $linha_senha = mysql_fetch_array($rs_senha);
	
  if(!empty($linha_senha))
  {
    $email = $linha_senha['email_usuario'];
		
    $nova_senha = gerar_senha(8, false, true, true, false);


    $sql = " UPDATE tabela_adm_usuarios ";
    $sql.= " SET senha_usuario='" . md5($nova_senha) . "' WHERE codigo_usuario=" . $linha_senha['codigo_usuario'];
    mysql_query($sql,$conexao);

    $mensagem = " Recupera��o de senha\n\n<br /><br /> ";
    $mensagem.= " Uma nova senha foi criada para acesso ao sistema:\n\n<br /><br /> ";
    $mensagem.= $nova_senha ;
		
    mail($email,"Sistema de Administra��o Friweb - Recuperar Senha",$mensagem,"From:".$email_site."\nContent-type: text/html\n") or die("Falha de envio!");






    // LOG  

    $acao = "Altera��o se senha via Esqueci Senha do usuário " . $linha_senha['codigo_usuario'] ;


    // Gravando LOG no banco de dados

    $sql = " INSERT INTO tabela_adm_log ";
    $sql.= " (usuario_log, acao_log, sistema_log, data_log) ";
    $sql.= " VALUES ('" . $linha_senha['nome_usuario'] . "' ,'" . $acao . "','Esqueci Senha','" . date('d/m/Y - H:i:s') . "')";

    mysql_query($sql,$conexao);




?>
	      <br><br>
      <table border="0" cellspacing="0" cellpadding="0" align=center>
        <tr>
          <td align=center>
           		<h2>Uma nova senha foi enviada para o email <?php echo $email; ?></h2>
                <?="<meta http-equiv='refresh' content='3;URL=../_sistema/php_manutencao_login.php' />";?>
           </td>
        </tr>
        <tr>
          <td align=center>
            <a href="../_sistema/php_suporte.php"><img src=../_imagens/friweb.png border=0></a>
           </td>
        </tr>
     </table>
  </body>
</html>
<?
	}
	else{
?>
	      <br><br>
      <table border="0" cellspacing="0" cellpadding="0" align=center>
        <tr>
          <td align=center>
            <h2>Email não encontrado!</h2>
            <a href="javascript:history.go(-1);">[voltar]</a>
           </td>
        </tr>
        <tr>
          <td align=center>
            <a href="php_suporte.php"><img src=../_imagens/friweb.png border=0></a>
           </td>
        </tr>
     </table>
<?
	}
	
 

?>



