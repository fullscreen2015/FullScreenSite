<?php
  
  header("Content-Type: text/html; charset=ISO-8859-1",true);
  
  if (!empty($_FILES)) 
  {

    include("../../include/sistema_zeros.php");
    include("../../include/sistema_conexao.php");

    include("../_include/genthumbs.php");


    $caminho = realpath("../..");



    // recebe o nome da pasta do sistema atual que foi colocado no campo "folder" do formulario
    
	$array_configuracao = explode("/",$_REQUEST['folder']);
    $qt = count($array_configuracao);
    $codigo_modulo = $array_configuracao[$qt-1];

	


    // insere o arquivo de configuração correspondente ao sistema atual


    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 


    if(!(ISSET($marca_dagua)))
    {
      $marca_dagua = 10;
    }

    if(!(ISSET($marca_dagua_padding)))
    {
      $marca_dagua_padding = 20;
    }




    $sql = "LOCK TABLES " . $tabela . " WRITE ";
    mysql_query($sql,$conexao);








    $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
    $fileTypes  = str_replace(';','|',$fileTypes);
    $typesArray = explode('|',$fileTypes);
    $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
    if (in_array(strtolower($fileParts['extension']),$typesArray)) 
    {
      $tempFile = $_FILES['Filedata']['tmp_name'];

      $tipo_arquivo_original = strtolower($fileParts['extension']);
 




      // Decidir o nome do arquivo







      // Os sistemas de tipo 1, 5 e 7 possuem mais de uma foto por registro. Por isso, percorremos todas as fotos até encontrar a última e somar 1 para ter o índice da próxima

      if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
      {








        // decidir o codigo do registro


        $codigo_registro = $_REQUEST[$chave_primaria];

        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  







        $indice_foto=1;
 
        for($i=1;$i<=1000;$i++)
        {
 
          $m = zerosaesquerda($i,$numero_algarismos);  

          $ultimo_arquivo = "../../" . $nome_sistema_fotos . "/originais/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

          if (file_exists($ultimo_arquivo))
          {  
            $indice_foto = $i+1;
          }  
        }  
        $indice_registro = $indice_foto;
        $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);

        $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_original;  


      }
        










      // Os sistemas de tipo 3, 4 e 6 possuem somente uma foto por registro.

      if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
      {




        // decidir o codigo do registro

        $sql = "SELECT " . $chave_primaria ." FROM " . $tabela . " ORDER BY " . $chave_primaria . " DESC LIMIT 1";
  
        $rs_codigo = mysql_query($sql, $conexao);

        $row = mysql_fetch_array($rs_codigo);
        $$chave_primaria = $row[$chave_primaria]+1;



        // montar o SQL

        include("gravar_dados.php");




        // Executar o SQL

        mysql_query($sql,$conexao); 




        $codigo_registro = $$chave_primaria;
        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  





        $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_original;  


        // apagando o arquivo original anterior para evitar problemas

        $original_atual = "../../" . $nome_sistema_fotos . "/originais/" . $nome_arquivo;

        if(file_exists($original_atual))
        {
          unlink($original_atual);
        }

      }














      $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/originais/" . $nome_arquivo;

      copy($_FILES['Filedata']['tmp_name'], $caminho_arquivo_original); 













      // Redimensionamento


      include('redimensionamento.php');



      $exibicao = "../../" . $nome_sistema_fotos . "/thumbs/" . $nome_arquivo;

      echo $exibicao;








    }
    else 
    {
      echo 'Tipo de arquivo inválido.';
    }


    $sql = "UNLOCK TABLES";
    mysql_query($sql,$conexao);



  }


?>