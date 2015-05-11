<?

  include("../_sistema/configuracoes.php");



// Sistema de Fotos

  $sistema_fotos = 0;
  $nome_sistema_fotos = "newsletter";
  $tipo_sistema_fotos = 4;
  $numero_algarismos = 6;
  $numero_algarismos_codigo = 6;
  $redimensionamento_automatico = 0;


  $tipo_arquivo_ampliado = "jpg";
  $tipo_arquivo_grande = "jpg";
  $tipo_arquivo_pequeno = "jpg";

  // Tipo 1 - sistema só com thumbs, com uma pasta "thumbs", banco de dados, 1 ou + fotos por registro
  // Tipo 2 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", sem banco de dados
  // Tipo 3 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", banco de dados, 1 foto por registro
  // Tipo 4 - sistema só com thumbs, com uma pasta "thumbs", banco de dados, 1 foto por registro
  // Tipo 5 - sistema com thumbs e foto, com duas pastas "fotos" e "thumbs", banco de dados, 1 ou mais fotos por registro
  // Tipo 6 - sistema com thumbs, foto e ampliacao, com três pastas "fotos", "thumbs" e "amp", banco de dados, 1 foto por registro
  // Tipo 7 - sistema com thumbs, foto e ampliacao, com três pastas "fotos", "thumbs" e "amp", banco de dados, 1 ou mais fotos por registro


  $largura_thumbs = 0;
  $altura_thumbs = 0;
  $largura_maxima_thumbs = 0;
  $altura_maxima_thumbs = 0;
  $largura_minima_thumbs = 0;
  $altura_minima_thumbs = 0;
  $tamanho_maximo_thumbs = 30000;

  $largura_foto = 510;
  $altura_foto = 0;
  $largura_maxima_foto = 0;
  $altura_maxima_foto = 0;
  $largura_minima_foto = 0;
  $altura_minima_foto = 0;
  $tamanho_maximo_foto = 300000;

  $largura_amp = 0;
  $altura_amp = 0;
  $largura_maxima_amp = 0;
  $altura_maxima_amp = 0;
  $largura_minima_amp = 0;
  $altura_minima_amp = 0;
  $tamanho_maximo_amp = 200000;













// Sistema de Documentos


  $sistema_documentos = 0;
  $pasta_documentos = "cmt";
  $nome_campo_documentos = "nome_arquivo";
  $tamanho_maximo_arquivo = 150000;
  $numero_algarismos_documentos = 4;









// Identifica��o da tabela

  $tabela = "tabela_sistema_contatos";
  $chave_primaria = "codigo_contato";
  $descricao_principal = "nome_contato";




// Ordem (DESC ou ASC)
  
  $ordem_padrao = "DESC";
  $campo_ordenacao_padrao = "codigo_contato";



// Identifica��o do Sistema

  $sistema_singular = "Contato";
  $sistema_plural = "Contatos";


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



  $campos[111] = "codigo_contato";
  $campos[112] = "C�digo";
  $campos[113] = "chave_primaria";
  $campos[114] = 4;
  $campos[115] = "";
  $campos[116] = "";
  $campos[117] = "";
  $campos[118] = 1;
  $campos[119] = 1;

  $campos[121] = "nome_contato";
  $campos[122] = "Nome";
  $campos[123] = "varchar";
  $campos[124] = "255";
  $campos[125] = "";
  $campos[126] = "";
  $campos[127] = "";
  $campos[128] = 1;
  $campos[129] = 1;

  $campos[131] = "email_contato";
  $campos[132] = "E-mail";
  $campos[133] = "varchar";
  $campos[134] = "255";
  $campos[135] = "";
  $campos[136] = "";
  $campos[137] = "";
  $campos[138] = 1;
  $campos[139] = 1;

  $campos[141] = "publicar";
  $campos[142] = "Publicar";
  $campos[143] = "logico";
  $campos[144] = "";
  $campos[145] = "";
  $campos[146] = "";
  $campos[147] = "";
  $campos[148] = 1;
  $campos[149] = 1;

  $numero_campos = 4;










// 1 - campo c�digo que d� nome ao select
// 2 - Nome que aparece na frente do form

// 5 - campo c�digo da tabela que contem os dados aparecem no form
// 6 - tabela que contem os dados aparecem no form
// 7 - nome do campo da tabela que contem os dados e vai aparecer dentro do form

// 8 - tabela_associativa
// 9 - campo_codigo da tabela atual que est� tamb�m na tabela associativa
// 91 - chave prim�ria da tabela associativa



  $campos_associativos[111] = "codigo_especialidade";
  $campos_associativos[112] = "Especialidade";

  $campos_associativos[115] = "codigo_especialidade";
  $campos_associativos[116] = "tabela_serrasaude_h_especialidades";
  $campos_associativos[117] = "nome_especialidade";

  $campos_associativos[118] = "tabela_serrasaude_h_profissional_especialidade";
  $campos_associativos[119] = "codigo_profissional";
  $campos_associativos[1191] = "codigo_tabela";





  $campos_associativos[121] = "codigo_convenio";
  $campos_associativos[122] = "Conv�nio";

  $campos_associativos[125] = "codigo_convenio";
  $campos_associativos[126] = "tabela_serrasaude_convenios";
  $campos_associativos[127] = "nome_convenio";

  $campos_associativos[128] = "tabela_serrasaude_h_profissional_convenio";
  $campos_associativos[129] = "codigo_profissional";
  $campos_associativos[1291] = "codigo_tabela";

  $numero_campos_associativos = 0;



?>