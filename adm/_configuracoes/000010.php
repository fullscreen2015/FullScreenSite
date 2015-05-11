<?php

  include("../_sistema/configuracoes.php");

// Sistema de Exportação TXT, CSV

  // 0 - Não Exibe Link para Exportação
  // 1 - Exibe Link para Exportação
  $sistema_exportacao = 1;

// Sistema de Exclusão

  // 0 - O sistema exclui o registro do banco de dados
  // 1 - O sistema marca o campo "ativo" da tabela como ZERO e não exclui o registro do banco de dados
  $sistema_exclusao = 1;

  //Quer que possua confirmação na hora da exclusão
  //0 - não confirmar
  //1 - confirmar
  $confirmar_exclusao = 1;


// Sistema de Fotos


  $sistema_fotos = 1;
  // 1 - Existe sistema de fotos
  // 2 - Não existe sistema de fotos

  $redirecionamento_direto = 1;
  // 1 - Após inserir o registro, sistema redireciona para ao gerenciador de fotos
  // 2 - Após inserir o registro, sistema redireciona para ao painel
  // *** Esta variável só tem efeito, caso a variável $sistema_fotos tenha valor = 1


  $marca_dagua = 10;
  // 1 - Inserir Marca D'água na posição superior esquerda
  // 2 - Inserir Marca D'água na posição superior central
  // 3 - Inserir Marca D'água na posição superior direita
  // 4 - Inserir Marca D'água na posição m�dia esquerda
  // 5 - Inserir Marca D'água na posição m�dia central
  // 6 - Inserir Marca D'água na posição m�dia direita
  // 7 - Inserir Marca D'água na posição inferior esquerda
  // 8 - Inserir Marca D'água na posição inferior central
  // 9 - Inserir Marca D'água na posição inferior direita
  // 10 - Não inserir Marca D'água
  // ** O arquivo da marca D'água deve ser do tipo PNG
  // ** O arquivo deve ficar na mesma pasta do sistema de fotos
  // ** O arquivo deve se chamar "marca_dagua.png"

  $marca_dagua_padding = 20;


  $exibicao_no_painel = 1;
  // 1 - Exibe as miniaturas no painel utilizando a tabela atual    *** Esta opção só tem efeito, caso a variável $sistema_fotos tenha valor = 1
  // 2 - Exibe as miniaturas no painel utilizando uma tabela associada com chave estrangeira
  // 3 - Não exibe as miniaturas no painel

  // As configurações a seguir só tem efeito caso a variável $exibicao_no_painel tenha valor = 2
  $fotos_sistema_associado = "7";




  $tipo_sistema_fotos = 7;
  // Tipo 1 - sistema só com thumbs, com uma pasta "thumbs", banco de dados, 1 ou + fotos por registro
  // Tipo 2 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", sem banco de dados
  // Tipo 3 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", banco de dados, 1 foto por registro
  // Tipo 4 - sistema só com thumbs, com uma pasta "thumbs", banco de dados, 1 foto por registro
  // Tipo 5 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", banco de dados, 1 ou mais fotos por registro
  // Tipo 6 - sistema com thumbs, foto e ampliacao, com três pastas "fotos", "thumbs" e "amp", banco de dados, 1 foto por registro
  // Tipo 7 - sistema com thumbs, foto e ampliacao, com três pastas "fotos", "thumbs" e "amp", banco de dados, 1 ou mais fotos por registro


  $nome_sistema_fotos = "imagens/produtos";
  $numero_algarismos = 6;
  $numero_algarismos_codigo = 6;


  $redimensionamento_automatico = 2;
  // 0 - os arquivos seráo enviados já no tamanho correto
  // 1 - será enviado somente um arquivo, que será redimensionado automaticamente
  // 2 - a foto será redimensionada pelo usuário através do sistema

  // * para utilizar o redimensionamento automático 2 (com seleção) � necessário informar largura e altura mínimos
  $largura_minima = 367;
  $altura_minima = 367;

  $largura_maxima = 1500;//CAMPO NOVO
  $altura_maxima = 1800;// CAMPO NOVO

  // * para utilizar o redimensionamento automático 2 (com seleção) � necessário utilizar a mesmo tipo de arquivo para os três tamanhos
  $tipo_arquivo_ampliado = "jpg";
  $tipo_arquivo_grande = "jpg";
  $tipo_arquivo_pequeno = "jpg";

  $criar_borda = 0;
  // 0 - as imagens seráo exibidas no sistema de corte no formato original
  // 1 - as imagens seráo exibidas no sistema de corte com uma borda branca
  $r = "255";
  $g = "255";
  $b = "255";


  $largura_thumbs = 112;
  $altura_thumbs = 112;
  $largura_maxima_thumbs = 0;
  $altura_maxima_thumbs = 0;
  $largura_minima_thumbs = 0;
  $altura_minima_thumbs = 0;
  $tamanho_maximo_thumbs = 30000;

  $largura_foto = 367;
  $altura_foto = 367;
  $largura_maxima_foto = 0;
  $altura_maxima_foto = 0;
  $largura_minima_foto = 0;
  $altura_minima_foto = 0;
  $tamanho_maximo_foto = 500000;

  $largura_amp = 420;
  $altura_amp = 292;
  $largura_maxima_amp = 0;
  $altura_maxima_amp = 0;
  $largura_minima_amp = 0;
  $altura_minima_amp = 0;
  $tamanho_maximo_amp = 200000;













// Sistema de Documentos


  $sistema_documentos = 0;
  // 0 - não possui sistema de documentos
  // 1 - possui sistema de documentos

  $tipo_sistema_documentos = 1;
  // 1 - um documento por registro
  // 2 - um ou mais documentos por registro
  
  $redirecionamento_documentos_direto = 1;
  // 1 - Após inserir o registro, sistema redireciona para ao gerenciador de documentos
  // 2 - Após inserir o registro, sistema redireciona para ao painel
  // *** Esta variável só tem efeito, caso a variável $sistema_documentos tenha valor = 1



  
  // tipos de mimetype aceitos
  $tipos_arquivo_aceitos_mime = array();
  
  // tipos de extens�o aceitos 
  $tipos_arquivo_aceitos_extensao = array();



  
  $pasta_documentos = "mensagens";
  $tamanho_maximo_arquivo = 150000;
  $numero_algarismos_documentos = 6;
  $numero_algarismos_documentos_indice = 6;

  $nome_campo_documentos = "arquivo";







// Identifica��o da tabela

  $tabela = "tabela_produtos";
  $chave_primaria = "codigo_produto";
  $descricao_principal = "descricao_produto";




// Ordem (DESC ou ASC)
  
  $ordem_padrao = "DESC";
  $campo_ordenacao_padrao = "codigo_produto";



// Identifica��o do Sistema

  $sistema_singular = "Produto";
  $sistema_plural = "Produtos";




// Identifica��o do campo que guardar� o codigo do usuário (se houver - se não houver, deixar em branco)

  $campo_usuario = "";
  $tipo_permissao_usuario = "0";
  // 0 - os outros usuários tem acesso total ao registro
  // 1 - os outros usuários não podem ver o registro
  // 2 - os outros usuários só podem ver o registro
  // 3 - os outros usuários só podem ver e editar o registro
  // 4 - os outros usuários só podem ver e excluir o registro






// Identifica��o dos campos

//  1 - nome do campo na tabela
//  2 - nome do campo que vai pra tela
//  3 - tipo de campo
//  4 - tamanho m�x do campo
//  5 - nome do campo na tabela estrangeira (codigo)
//  6 - nome da tabela estrangeira
//  7 - nome dos campos na tabela estrangeira que aparece��o no SELECT (separados por v�rgula)
//  8 - inserir campo na descri��o? (1 - sim / 0 - não)
//  9 - inserir campo no relat�rio? (1 - sim / 0 - não)
// 10 - valida��o
// 11 - largura no painel
// 12 - c�digo do m�dulo de chave estrangeira
// 13 - permiss�o de altera��o:
//    - " " - qualquer um pode alterar
//    - "0" - qualquer um pode alterar
//    - "1" - ningu�m pode alterar
//    - "2" - só quem criou o registro pode alterar (só � v�lido quando a variável "campo_usuario" estiver preenchida)
// 14 - help do campo
// 15 - esconder campo no inserir.php? (1 - sim / 0 ou vazio - não)


// Tipos de Campo

// - varchar
// - data_date
// - data_int
// - data_date_now
// - data_int_now
// - blob
// - blob_html
// - inteiro
// - logico
// - chave_estrangeira
// - chave_associativa
// - moeda
// - hora
// - hora_now
// - senha
// - senha_criptografada




  $campos[111] = "codigo_produto";
  $campos[112] = "C�digo";
  $campos[113] = "chave_primaria";
  $campos[114] = "11";
  $campos[115] = "";
  $campos[116] = "";
  $campos[117] = "";
  $campos[118] = 1;
  $campos[119] = 1;
  $campos[1110] = "obrigatorio";
  $campos[1111] = "";
  $campos[1112] = "";
  $campos[1113] = "";
  $campos[1114] = "";
  $campos[1115] = "";

  $campos[121] = "descricao_produto";
  $campos[122] = "Descri��o";
  $campos[123] = "varchar";
  $campos[124] = "255";
  $campos[125] = "";
  $campos[126] = "";
  $campos[127] = "";
  $campos[128] = 1;
  $campos[129] = 1;
  $campos[1210] = "obrigatorio";
  $campos[1211] = "250";
  $campos[1212] = "";
  $campos[1213] = "";
  $campos[1214] = "";
  $campos[1215] = "";

  $campos[131] = "texto_produto";
  $campos[132] = "Texto";
  $campos[133] = "blob";
  $campos[134] = "";
  $campos[135] = "";
  $campos[136] = "";
  $campos[137] = "";
  $campos[138] = 1;
  $campos[139] = 1;
  $campos[1310] = "";
  $campos[1311] = "250";
  $campos[1312] = "";
  $campos[1313] = "";
  $campos[1314] = "";
  $campos[1315] = "";

  $campos[141] = "preco_produto";
  $campos[142] = "Pre�o";
  $campos[143] = "moeda";
  $campos[144] = "";
  $campos[145] = "";
  $campos[146] = "";
  $campos[147] = "";
  $campos[148] = 1;
  $campos[149] = 1;
  $campos[1410] = "";
  $campos[1411] = "250";
  $campos[1412] = "";
  $campos[1413] = "";
  $campos[1414] = "";
  $campos[1415] = "";

  $campos[151] = "codigo_categoria";
  $campos[152] = "Categoria";
  $campos[153] = "chave_estrangeira";
  $campos[154] = "0";
  $campos[155] = "codigo_categoria";
  $campos[156] = "tabela_categorias_produtos";
  $campos[157] = "descricao_categoria";
  $campos[158] = 1;
  $campos[159] = 1;
  $campos[1510] = "";
  $campos[1511] = "250";
  $campos[1512] = "";
  $campos[1513] = "";
  $campos[1514] = "";
  $campos[1515] = "";

  $campos[161] = "destaque";
  $campos[162] = "Destaque";
  $campos[163] = "logico";
  $campos[164] = "1";
  $campos[165] = "";
  $campos[166] = "";
  $campos[167] = "";
  $campos[168] = 1;
  $campos[169] = 1;
  $campos[1610] = "";
  $campos[1611] = "";
  $campos[1612] = "";
  $campos[1613] = "";
  $campos[1614] = "";
  $campos[1615] = "";

  $campos[171] = "publicar";
  $campos[172] = "Publicar";
  $campos[173] = "logico";
  $campos[174] = "1";
  $campos[175] = "";
  $campos[176] = "";
  $campos[177] = "";
  $campos[178] = 1;
  $campos[179] = 1;
  $campos[1710] = "";
  $campos[1711] = "";
  $campos[1712] = "";
  $campos[1713] = "";
  $campos[1714] = "";
  $campos[1715] = "";

  $numero_campos = 7;





  // CAMPOS ASSOCIATIVOS ####################################################



// 1 - campo c�digo que d� nome ao select
// 2 - Nome que aparece na frente do form

// 4 - indica se a tabela associada tem sistema de exclusão (0 - não)
// 5 - campo c�digo da tabela que contem os dados aparecem no form
// 6 - tabela que contem os dados aparecem no form
// 7 - nome do campo da tabela que contem os dados e vai aparecer dentro do form

// 8 - tabela_associativa
// 9 - campo_codigo da tabela atual que est� tamb�m na tabela associativa
// 91 - chave prim�ria da tabela associativa



  $campos_associativos[111] = "codigo_usuario";
  $campos_associativos[112] = "usuário que tem acesso";

  $campos_associativos[114] = "0";
  $campos_associativos[115] = "codigo_usuario";
  $campos_associativos[116] = "tabela_adm_usuarios";
  $campos_associativos[117] = "nome_usuario";

  $campos_associativos[118] = "tabela_adm_ass_usuario_grafico";
  $campos_associativos[119] = "codigo_grafico";
  $campos_associativos[1191] = "codigo_associativo";





  $campos_associativos[121] = "codigo_convenio";
  $campos_associativos[122] = "Conv�nio";

  $campos_associativos[125] = "codigo_convenio";
  $campos_associativos[126] = "tabela_serrasaude_convenios";
  $campos_associativos[127] = "nome_convenio";

  $campos_associativos[128] = "tabela_serrasaude_h_profissional_convenio";
  $campos_associativos[129] = "codigo_profissional";
  $campos_associativos[1291] = "codigo_tabela";

  $numero_campos_associativos = 0;














  // CAMPOS INTERLA�ADOS ####################################################


 

  // 1 - nome da tabela_pai
  // 2 - chave prim�ria da tabela_pai
  // 3 - campo descri��o da tabela pai
  // 4 - sistema de exclusão da tabela pai (1 - usa / 0 - não usa)

  // 5 - nome da tabela_filho
  // 6 - chave primaria da tabela filho
  // 7 - campo descri��o da tabela filho
  // 8 - sistema de exclusão da tabela filho (1 - usa / 0 - não usa)

  // 9 - nome da tabela_associativa
  // 10 - chave_primaria da tabela_associativa
  // 11 - nome do campo principal da tabela associativa (� o mesmo campo da chave prim�ria do sistema principal)
  // 12 - nome do campo que tem a chave primaria da tabela filho na tabela associativa





  $campos_interlacados[111] = "tabela_caracteristicas_tipos";
  $campos_interlacados[112] = "codigo_tipo";
  $campos_interlacados[113] = "descricao_tipo";
  $campos_interlacados[114] = "1";

  $campos_interlacados[115] = "tabela_caracteristicas_detalhes";
  $campos_interlacados[116] = "codigo_caracteristica";
  $campos_interlacados[117] = "descricao_caracteristica";
  $campos_interlacados[118] = "1";

  $campos_interlacados[119] = "tabela_ass_associados_caracteristicas";
  $campos_interlacados[1110] = "codigo_associativo";
  $campos_interlacados[1111] = "codigo_associado";
  $campos_interlacados[1112] = "codigo_caracteristica";

  $campos_interlacados[1113] = "";


  $numero_campos_interlacados = 0;











  // SISTEMAS RELACIONADOS ####################################################

  $sistema_relacionado[1] = "5";
  $sistema_relacionado[2] = "7";


  $numero_sistemas_relacionados = 0;


?>