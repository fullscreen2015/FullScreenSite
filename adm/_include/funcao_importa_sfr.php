<?php

  function importa_sfr($codigo_modulo)
  {

    global $chave_primaria_original;
    global $conexao;
    global $linha;

    $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 

    $nome_sistema_fotos_atual = $nome_sistema_fotos;
    $tipo_arquivo_pequeno_atual = $tipo_arquivo_pequeno;
    $numero_algarismos_atual = $numero_algarismos;
    $numero_algarismos_codigo_atual = $numero_algarismos_codigo;
    $tipo_sistema_fotos_atual = $tipo_sistema_fotos;

    $tabela_sfr = $tabela;
    $chave_primaria_sfr = $chave_primaria;
    $sql = " SELECT " . $chave_primaria_sfr . " FROM " . $tabela_sfr . " WHERE " . $chave_primaria_original . "=" . $linha[$chave_primaria_original];
    $rs_sfr = mysql_query($sql,$conexao);
    $linha_sfr = mysql_fetch_array($rs_sfr);


    $codigo_registro   = $linha_sfr[$chave_primaria_sfr];

    $dados_sfr[1] = $codigo_registro;
    $dados_sfr[2] = $nome_sistema_fotos_atual;
    $dados_sfr[3] = $tipo_arquivo_pequeno_atual;
    $dados_sfr[4] = $numero_algarismos_atual;
    $dados_sfr[5] = $numero_algarismos_codigo_atual;
    $dados_sfr[6] = $tipo_sistema_fotos;

    return $dados_sfr;
    
  }

?>