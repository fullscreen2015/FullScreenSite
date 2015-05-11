<?php


        if($tipo_sistema_fotos==1)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  

          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          // Criando Thumbs
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);



        }




        if($tipo_sistema_fotos==3)
        {
 
          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_foto = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo_foto = $codigo_registro . "." . $tipo_arquivo_grande;
          $nome_arquivo_thumbs = $codigo_registro . "." . $tipo_arquivo_pequeno;



          // Criando Thumbs
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo_thumbs,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,"","","");

          // Criando Foto
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";
          cria_arquivo2($caminho_arquivo_original,$pasta_foto,$nome_arquivo_foto,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);


        }





        if($tipo_sistema_fotos==4)
        {

          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 

          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;

          // Criando Thumbs
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);


        }






        if($tipo_sistema_fotos==5)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  
       

          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";
          $pasta_fotos = $caminho . "/" . $nome_sistema_fotos . "/fotos/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;


          // Criando Thumbs
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,"","","");
 
          // Criando Foto
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";
          cria_arquivo2($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);




        }






        if($tipo_sistema_fotos==6)
        {

          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande); 



          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;

          $pasta_amp = $caminho . "/" . $nome_sistema_fotos . "/amp/";
          $pasta_foto = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";

          $nome_arquivo = $codigo_registro . "." . $tipo_arquivo_grande;


          // Criando AMP
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";
          cria_arquivo2($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);

          // Criando Foto
          cria_arquivo2($caminho_arquivo_original,$pasta_foto,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto,"","","");

          // Criando Thumbs
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,"","","");



        }







        if($tipo_sistema_fotos==7)
        {

          $indice_foto=1;
 
          for($i=1;$i<=1000;$i++)
          {
 
            $m = zerosaesquerda($i,$numero_algarismos);  

            $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;

            if (file_exists($nome_arquivo))
            {  
              $indice_foto = $i+1;
            }  
          }  

          $indice_registro = $indice_foto;
          $indice_registro = zerosaesquerda($indice_registro,$numero_algarismos);  
       

          copy($_FILES['Filedata']['tmp_name'], $caminho."/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande); 


          //Cria thumbnail
 
          $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;

          $pasta_thumbs = $caminho . "/" . $nome_sistema_fotos . "/thumbs/";
          $pasta_fotos = $caminho . "/" . $nome_sistema_fotos . "/fotos/";
          $pasta_amp = $caminho . "/" . $nome_sistema_fotos . "/amp/";

          $nome_arquivo = $codigo_registro . "_" . $indice_registro . "." . $tipo_arquivo_grande;



          // Criando Amp
          $marca_dagua_arquivo = $caminho . "/" . $nome_sistema_fotos . "/marca_dagua.png";	
          cria_arquivo2($caminho_arquivo_original,$pasta_amp,$nome_arquivo,$largura_amp,$altura_amp,$largura_maxima_amp,$altura_maxima_amp,$marca_dagua,$marca_dagua_arquivo,$marca_dagua_padding);

          // Criando Thumbs
          cria_arquivo2($caminho_arquivo_original,$pasta_thumbs,$nome_arquivo,$largura_thumbs,$altura_thumbs,$largura_maxima_thumbs,$altura_maxima_thumbs,"","","");

          // Criando Foto
          cria_arquivo2($caminho_arquivo_original,$pasta_fotos,$nome_arquivo,$largura_foto,$altura_foto,$largura_maxima_foto,$altura_maxima_foto,"","","");



        }



?>