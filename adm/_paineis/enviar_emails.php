<?php

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../../include/sistema_zeros.php"); 

  echo '<link rel="stylesheet" href="../_css/paineis.css" type="text/css" />
  ';

  echo "<h1>Enviar E-mails</h1>";


  /////NEWSLETTER ANIVERSARIANTES
/*  $arquivo_dados = "../_personalizados/newsletter_aniversariantes/ultimo_envio.txt";
  $ultimo_envio = "";
  $data_atual = date("Ymd");

  $id = fopen($arquivo_dados,"rb");
  if((filesize($arquivo_dados))>0)
  {
    $ultimo_envio=fread($id,filesize($arquivo_dados));
  }
  fclose($id);

  if($ultimo_envio!=$data_atual)    
  {
    echo "<a target='_blank' href='../_personalizados/newsletter_aniversariantes/index.php'>";
    echo "Enviar emails para aniversariantes";
    echo "</a>";
  }*/

////////////////////////////////////////////////////////



//////AVISE-ME QUANDO CHEGAR
 $sql_aviseme = " SELECT tabela_ec_aviseme_produtos.codigo_produto ";
  $sql_aviseme.= " FROM tabela_ec_aviseme_produtos, tabela_ec_aviseme ";
  $sql_aviseme.= " WHERE tabela_ec_aviseme_produtos.avisado = 0 ";
  $sql_aviseme.= " AND tabela_ec_aviseme_produtos.codigo_produto = tabela_ec_aviseme.codigo_produto ";
  $sql_aviseme.= " AND tabela_ec_aviseme.avisado = 0 ";
  $sql_aviseme.= " GROUP BY tabela_ec_aviseme_produtos.codigo_produto ";

  $rs_aviseme = mysql_query($sql_aviseme,$conexao);
  if(mysql_num_rows($rs_aviseme)>0)
  {
    echo "<a target='_blank' href='../_personalizados/newsletter_aviseme/produtos.php'>";
    echo "Enviar emails 'avise-me'";
    echo "</a>";
  }


  ///////////////////////////////////////////////////



  /////BOLETOS EM ABERTO
    $arquivo_dados = "../../boletophp/data_envio_ultima_cobranca.txt";
  $ultimo_envio = "";
  $data_atual = date("Ymd");

  $id = fopen($arquivo_dados,"rb");
  if((filesize($arquivo_dados))>0)
  {
    $ultimo_envio=fread($id,filesize($arquivo_dados));
  }
  fclose($id);

  if($ultimo_envio!=$data_atual)    
  {
    echo "<a target='_blank' href='../_personalizados/newsletter_boletos_em_aberto/index.php'>";
    echo "Enviar e-mails boletos";
    echo "</a>";
  }






///EXPEDIDOS + 20 DIAS /// VERIFICAR 

  $data_hoje = date('Ymd');

  $data_diminuida = diminiu_data($data_hoje,20);

  $sql_aviseme = " SELECT tabela_ec_pedidos_detalhes.codigo_pedido, pedido_expedido_data ";
  $sql_aviseme.= " FROM tabela_ec_pedidos_detalhes ";
  $sql_aviseme.= " WHERE ativo = 1 ";
  $sql_aviseme.= " AND pedido_expedido_data<=" . $data_diminuida;
  $sql_aviseme.= " AND pedido_expedido_data <>''";
  $sql_aviseme.= " AND codigo_situacao = 4 ";
  $sql_aviseme.= " GROUP BY tabela_ec_pedidos_detalhes.codigo_pedido ";

  $rs_aviseme = mysql_query($sql_aviseme,$conexao);

  if(mysql_num_rows($rs_aviseme)>0)
  {
    echo "<a target='_blank' href='../_personalizados/pedidos_expedidos/index.php'>";
    echo "Enviar e-mails <br>
    'pedidos expedidos a mais de 20 dias' ";
    
    echo "</a>";
 }




?>





</div>



