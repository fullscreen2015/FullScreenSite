<?php

// Inclui o arquivo class.phpmailer.php localizado na pasta include
require("class.phpmailer.php");

function email_locaweb($remetente,$destinatario,$cc,$cco,$nome_visitante,$email_visitante,$assunto,$mensagem)
{
  $emailsender = $remetente;

  /* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
  if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
  else $quebra_linha = "\n"; //Se "nÃ£o for Windows"

  $nomeremetente     = $nome_visitante;
  $emailremetente    = $email_visitante;
  $emaildestinatario = $destinatario;
  $comcopia          = $cc;
  $comcopiaoculta    = $cco;

  /* Montando o cabeÃ§alho da mensagem */
  $headers = "MIME-Version: 1.1" .$quebra_linha;
  $headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
  // Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
  $headers .= "From: " . $emailsender.$quebra_linha;

  if($comcopia!="")
  {
    $headers .= "Cc: " . $comcopia . $quebra_linha;
  }

  if($comcopiaoculta!="")
  {
    $headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
  }

  $headers .= "Reply-To: " . $emailremetente . $quebra_linha;
  // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

  /* Enviando a mensagem */
  //É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:
  echo $mensagem;
  // exit();
  if(!mail($email_destinatario, $assunto, $mensagem, $headers ,"-r" . $email_reply ))
  { 
    $headers .= "Return-Path: " . $email_reply . $quebra_linha; 
    if(!mail($email_destinatario, $assunto, $mensagem, $headers))
    {
      //$erro = " Erro ao tentar enviar o e-mail.<br/><br/>";
    }
  }
}


function email_locaweb2($nome_remetente,$email_remetente,$nome_destinatario,$email_destinatario,$cc,$bcc,$nome_reply,$email_reply,$assunto,$mensagem)
{
  // include("sistema_configuracoes.php");
  // Inicia a classe PHPMailer
  $mail = new PHPMailer();

  // Define os dados do servidor e tipo de conexão
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->IsSMTP(); // Define que a mensagem será SMTP
  $mail->Host = "smtp.fullscreen.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
  // $mail->Port = 587;
  // $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
  
  $mail->Username = $linha_configuracao["email_empresa"]; // Usuário do servidor SMTP (endereço de email)
  $mail->Password = $linha_configuracao["senha_email_empresa"]; // Senha do servidor SMTP (senha do email usado)

  $mail->From = $linha_configuracao["email_empresa"]; // Seu e-mail
  $mail->Sender = $linha_configuracao["email_empresa"]; // Seu e-mail
  $mail->FromName = "Contato - Full Screen"; // Seu nome

  /* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
  if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
  else $quebra_linha = "\n"; //Se "nÃ£o for Windows"

  /* Montando o cabeçalho da mensagem */
  $headers = "MIME-Version: 1.1" .$quebra_linha;
  $headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
  // Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.

  $headers .= "From: " . $nome_remetente . " <". $email_remetente . ">" . $quebra_linha;
  //  $headers .= "From: " . $email_remetente . $quebra_linha;

  if($cc!="") {
    $headers .= "Cc: " . $cc . $quebra_linha;
  }
  if($bcc!="") {
    $headers .= "Bcc: " . $bcc . $quebra_linha;
  }
  // $headers .= "Reply-To: " . $nome_reply . " <" . $email_reply . ">" . $quebra_linha;
  $headers .= "Reply-To: " . $email_reply . $quebra_linha;

  // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

  /* Enviando a mensagem */
  //É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:

  $erro="";

  // Define os destinatário(s)
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->AddAddress($email_destinatario, $nome_destinatario);

  
  if($cc!="") {
    $mail->AddCC($cc); // Copia 
  }

  if($bcc!="") {
    $mail->AddBCC($bcc); // Cópia Oculta
  }

  // Define os dados técnicos da Mensagem
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
  $mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)


  // Define a mensagem (Texto e Assunto)
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  if($assunto!="") {
    $mail->Subject  = $assunto; // Assunto da mensagem
  }
  if($mensagem!="") {
    $mail->Body = $mensagem;
  }

  $mail->AltBody = "";

  // Define os anexos (opcional)
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  //$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo

  //Envia o e-mail
  $enviado = $mail->Send();

  // Limpa os destinatários e os anexos
  $mail->ClearAllRecipients();
  $mail->ClearAttachments();

  //print_r($mail);

  // Exibe uma mensagem de resultado
  if ($enviado) {
  // echo "E-mail enviado com sucesso!";
  } else {

    $erro="";

    if(!mail($email_destinatario, $assunto, $mensagem, $headers ,"-r" . $email_reply )) { 
      $headers .= "Return-Path: " . $email_reply . $quebra_linha; 
      if(!mail($email_destinatario, $assunto, $mensagem, $headers)) {
        //$erro = " Erro ao tentar enviar o e-mail.<br/><br/>";
      }
    }

    // if($erro!="") {
    //   echo $erro;
    // }
    // else {
    //   echo ' E-mail enviado com sucesso!<br/><br/>' ;
    // }
  }
}


function  envia_email_padrao($nome_remetente, $email_remetente, $nome_destinatario, $email_destinatario,$cc,$bcc,$nome_reply, $email_reply, $assunto,$msg)
{
  // include("sistema_configuracoes.php");

  $nome_remetente = "Full Screen";
  $email_remetente = "contato@fullscreen.com.br";

  // $url = "http://www.fullscreen.com.br";

  // //topo
  // $topo = $url . '/imagens/newsletter/topo.png';

  // //rodape
  // $rodape = $url . '/imagens/newsletter/rodape.png';

  // INICIO
  $mensagem =  '<table style="text-align: justify; background-color: #ffffff; font-family: Arial; font-size: 14px; color: #999999; width: 550px;"CELLSPACING=0 >';

    // TOPO - MODELO 1
/*
  $mensagem.= ' <tr> ';
  $mensagem.= ' <td width=550 style="height:100px; background:#' . $linha_configuracao['cor_empresa'] . '; text-align:center;"><a href="' . $url . '"><img border=0 src="'.$logo.'"></a></td>';
  $mensagem.= ' </tr>';
*/

  // TOPO - MODELO 2
  // $mensagem.= ' <tr> ';
  // $mensagem.= ' <td colspan="2"><a href="' . $url . '"><img border=0 src="'.$topo.'"></a></td>';
  // $mensagem.= ' </tr>';



  // CONTEUDO
  $mensagem.= ' <tr><td colspan="2" style="padding: 20px 10px 10px 10px;">';
  $mensagem.= $msg;

  // RODAPÉ - MODELO 1

  // $mensagem.= ' <tr>';
  // $mensagem.= ' <td style="height:24px; background:#' . $linha_configuracao['cor_empresa'] . ';" align=center><p style="color:#ffffff;">' . $nome_do_site . ' | <a href="' . $url . '"><font color=ffffff>' . $url_visualizacao . '</font></a></p></td>';
  $mensagem.= ' </tr>';

  // RODAPÉ - MODELO 2
  // $mensagem.= '<tr  height="194">';
  // $mensagem.= ' <td><a href="' . $url . '"><img border=0 src="'.$rodape.'"></a></td>';
  /*$mensagem.= '  
    <td>
    
    <img style="float: left; " src="'.$url.'/imagens/newsletter/contato.png" />
    <a href="http://twitter.com/laralizlingerie"><img style="float: left; margin-left: 177px; margin-top: 100px" alt="Twitter Lara Liz" src="'.$url.'/imagens/newsletter/twitter.png" /></a>
    <a href="http://facebook.com/laralizmodaintima"><img style="float: left; margin-left: 177px; margin-top: 5px" alt="Facebook Lara Liz" src="'.$url.'/imagens/newsletter/facebook.png" /></a>
    </td>
      
  </tr>';*/

  // $mensagem .= '<td>
  // <map name="link_map">
  // <area title="Full Screen" alt="Full Screen" shape="rect" coords="355,35,530,50" href="http://www.fullscreen.com.br">
  // <area title="Fale Conosco - Full Screen" alt="Fale Conosco - Full Screen" shape="rect" coords="50,75,300,90" href="mailto:contato@fullscreen.com.br">
  // </map>
  // <img alt="Full Screen" src='.$rodape.' usemap="#link_map"></td>'; 
   // $mensagem.= '<tr>
   // <td colspan="2"><a href="http://www.laraliz.com.br"><img src="''"/></a></td>
   // </tr>';

  // FIM
  $mensagem.= ' </table> ';
   // echo $mensagem;
 
  
  email_locaweb2($nome_remetente,$email_remetente,$nome_destinatario,$email_destinatario,$cc,$bcc,$nome_remetente,$email_remetente,$assunto,$mensagem);

}




?>