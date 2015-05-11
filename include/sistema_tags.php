<?php


  function somenteTexto($string)
  {
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return trim(strip_tags(strtr($string, $trans_tbl)));
  }

  function abreviaString($texto, $limite, $tres_p = '...')
  {
    $totalCaracteres = 0;
    //Retorna o texto em plain/text
    $texto = somenteTexto($texto);
    //Cria um array com todas as palavras do texto
    $vetorPalavras = explode(" ",$texto);
    if(strlen($texto) <= $limite):
        $tres_p = "";
        $novoTexto = $texto;
    else:
        //Come�a a criar o novo texto resumido.
        $novoTexto = "";
        //Acrescenta palavra por palavra na string enquanto ela
        //não exceder o tamanho m�ximo do resumo
        for($i = 0; $i <count($vetorPalavras); $i++):
            $totalCaracteres += strlen(" ".$vetorPalavras[$i]);
            if($totalCaracteres <= $limite)
                $novoTexto .= ' ' . $vetorPalavras[$i];
            else break;
        endfor;
    endif;

    return ltrim($novoTexto . $tres_p);
  }




  $titulo = "";
  $palavras_chave = "";
  $descricao = "";





if($_REQUEST['conteudo'] == "clientes")
{

  

    $sql = " SELECT * FROM  tabela_portifolios WHERE publicar=1 AND ativo=1";

    $rs_tags = mysql_query($sql,$conexao);

    $titulo.= "Clientes Full Screen - ";

    while($linha_tag = mysql_fetch_array($rs_tags))
    {


    $titulo.= $linha_tag["nome_portifolio"]." ";
    $descricao.= str_replace("<br>"," ", $linha_tag["nome_portifolio"])." ";

    }

    // Separando as palavras da Descri��o, para criar as Keywords

    $palavras = $descricao;
    $palavras = str_replace(".","", $palavras);
    $palavras = str_replace(",","", $palavras);

    $palavras = explode(" ",$palavras);


    foreach ($palavras as $valor) 
    {
      if(strlen($valor)>2)
      {
        $palavras_chave.= $valor.", ";
      }
    }

} 


if($_REQUEST['conteudo'] == "produtos")
{

  

    $sql = " SELECT * FROM tabela_produtos WHERE publicar=1 AND ativo=1";

    $rs_tags = mysql_query($sql,$conexao);

    $titulo.= "Produtos: ";

    while($linha_tag = mysql_fetch_array($rs_tags))
    {


    $titulo.= $linha_tag["descricao_produto"]." ";
    $descricao.= str_replace("<br>"," ", $linha_tag["texto_produto"])." ";

    }

    // Separando as palavras da Descri��o, para criar as Keywords

    $palavras = $descricao;
    $palavras = str_replace(".","", $palavras);
    $palavras = str_replace(",","", $palavras);

    $palavras = explode(" ",$palavras);


    foreach ($palavras as $valor) 
    {
      if(strlen($valor)>2)
      {
        $palavras_chave.= $valor.", ";
      }
    }

} 


  if($_REQUEST['conteudo'] == "produtos_detalhe")
  {
  
      $codigo_produto = mysql_real_escape_string($_REQUEST['codigo_produto']);
 
      $sql = " SELECT * FROM tabela_produtos WHERE publicar=1 AND ativo=1 AND ".$codigo_produto;

      $rs_tags = mysql_query($sql,$conexao);

      while($linha_tag = mysql_fetch_array($rs_tags))
      {


      $titulo.= $linha_tag["descricao_produto"]." ";
      $descricao.= str_replace("<br>"," ", $linha_tag["texto_produto"])." ";

      }

      // Separando as palavras da Descri��o, para criar as Keywords

      $palavras = $descricao;
      $palavras = str_replace(".","", $palavras);
      $palavras = str_replace(",","", $palavras);

      $palavras = explode(" ",$palavras);


      foreach ($palavras as $valor) 
      {
        if(strlen($valor)>2)
        {
          $palavras_chave.= $valor.", ";
        }
      }
 
  } 



  
 // 01 - nome do link
// 02 - nome do arquivo
// 03 - titulo - 67 caracteres (total 85)
// 04 - palavras chave - 100 caracteres (total 118)
// 05 - descricao - 157 caracteres (total 175)



  $titulo_tamanho_maximo = 63;
  $descricao_tamanho_maximo = 153;
  $palavras_chave_tamanho_maximo = 200;


  if($titulo=="")
  {
  
    $links[11]="HOME";
    $links[12]="principal";
    $links[13]="Automa��o Comercial - Fullscreen - Sistema de Automa��o";
    $links[14]="automa��o comercial, sistema de automa��o comercial,nota fiscal eletr�nica, fullscreen, sistema de controle comercial";
    $links[15]="soluções em automa��o comercial, como nota fiscal eletr�nica e cupom fiscal. Tenha total controle operacional sobre seu com�rcio.";

    $links[21]="EMPRESA";
    $links[22]="empresa";
    $links[23]="Fullscreen Automa��o Comercial - soluções para seu com�rcio" ;
    $links[24]="empresa de automa��o comercial, fullscreen, empresa de automa��o, empresas de automa��o comercial, automa��o comercial rj, servi�os de hardware" ;
    $links[25]="A Fullscreen Automa��o Comercial, atua no desenvolvimento de soluções corporativas para empresas que buscam aprimorar seu controle interno." ;
  
    $links[31]="soluções";
    $links[32]="solucoes";
    $links[33]="Programa de Automa��o Comercial - Fullscreen Tecnologia de Computa��o" ;
    $links[34]="automa��o e controle industrial, controle automa��o, controle e automa��o, programa de automa��o comercial, sistema integrado comercial" ;
    $links[35]="Agilize seus processos manuais com o sistema de automa��o comercial. soluções que resultam o controle operacional total do seu neg�cio." ;

    $links[41]="PRODUTOS";
    $links[42]="produtos";
    $links[43]="Produtos Fullscreen - Hardware e Sofware" ;
    $links[44]="produtos de automa��o comercial, software de automa��o comercial, produtos fullscreen, programa para controle de estoque, impressora fiscal" ;
    $links[45]="Produtos Fullscreen para o seu controle operacional. Hardwares e softwares para agilizar os processos manuais do seu com�rcio." ;

    $links[51]="CLIENTES";
    $links[52]="clientes";
    $links[53]="Clientes Fullscreen - Automa��o Comercial" ;
    $links[54]="clientes fullscreen, amil esportes, big m�quinas, d�borah braune, estilo livre" ;
    $links[55]="Atendemos aos segmentos de Atacado/Distribui��o, Auto-Pe�as, pequenos com�rcios at� grandes lojas de departamentos. conheça nossos clientes." ;

    $links[61]="�REA DO CLIENTE";
    $links[62]="area-cliente-login";
    $links[63]="�rea do Clientes" ;
    $links[64]="�rea do cliente, acesso clientes" ;
    $links[65]="já � cliente Fullscreen? Ent�o acesse aqui com seu login e senha." ;

    $links[71]="CONTATO";
    $links[72]="contato";
    $links[73]="Contato Fullscreen - Fale Conosco" ;
    $links[74]="contato fullscreen, fale conosco fullscreen, entre em contato" ;
    $links[75]="Fale conosco Fullscreen. Deixe sua sugest�o, d�vida ou cr�tica que responderemos o mais breve poss�vel.." ;


    $numero_links = 7;
  

    $titulo = "Automa��o Comercial - Fullscreen - Sistema de Automa��o";
    $palavras_chave = "automa��o comercial, sistema de automa��o comercial,nota fiscal eletr�nica, fullscreen, sistema de controle comercial";
    $descricao = "soluções em automa��o comercial, como nota fiscal eletr�nica e cupom fiscal. Tenha total controle operacional sobre seu com�rcio.";




    for($i=1;$i<=$numero_links;$i++)
    {  

      $j1 = $i."1";
      $j2 = $i."2"; 
      $j3 = $i."3"; 
      $j4 = $i."4"; 
      $j5 = $i."5"; 

      $url = $_REQUEST['conteudo'];


      if($url==$links[$j2])
      {
        $titulo = $links[$j3];
        $palavras_chave = $links[$j4];
        $descricao = $links[$j5];
      }

    }

  }




  if(strlen($titulo)>$titulo_tamanho_maximo)
  {
    $titulo = abreviaString($titulo, $titulo_tamanho_maximo, '');
  }

  if(strlen($descricao)>$descricao_tamanho_maximo)
  {
    $descricao = abreviaString($descricao, $descricao_tamanho_maximo, '');
  }

  if(strlen($palavras_chave)>$palavras_chave_tamanho_maximo)
  {
    $palavras_chave = abreviaString($palavras_chave, $palavras_chave_tamanho_maximo, '');
  }


?>

  <meta name="description" content="<? echo $descricao; ?>" />

  <meta name="rating" content="general" />
  <meta name="robots" content="index,follow" />
  <meta name="Googlebot" content="all" />
  <meta name="revisit-after" content="15 days" />

  <meta name="keywords" content="<? echo $palavras_chave; ?>" />


  <title><? echo $titulo; ?></title>