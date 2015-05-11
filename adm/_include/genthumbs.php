<?php

function mascara($dst_img,$marca_dagua_posicao,$marca_dagua_arquivo,$marca_dagua_padding)
{

  $insertfile_id = imageCreateFromPNG($marca_dagua_arquivo); 

  $insertfile_width=imageSX($insertfile_id); 
  $insertfile_height=imageSY($insertfile_id);

  $sourcefile_width=imageSX($dst_img); 
  $sourcefile_height=imageSY($dst_img); 

  // superior esquerda
  if($marca_dagua_posicao == 1) 
  { 
    $dest_x = $marca_dagua_padding; 
    $dest_y = $marca_dagua_padding; 
  } 

  // superior central
  if($marca_dagua_posicao == 2) 
  { 
    $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
    $dest_y = $marca_dagua_padding; 
  } 

  // superior direita
  if($marca_dagua_posicao == 3) 
  { 
    $dest_x = $sourcefile_width - $insertfile_width - $marca_dagua_padding; 
    $dest_y = $marca_dagua_padding; 
  } 

  // m�dia esquerda
  if($marca_dagua_posicao == 4) 
  { 
    $dest_x = $marca_dagua_padding; 
    $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
  } 
  
  // m�dia central
  if($marca_dagua_posicao == 5) 
  { 
    $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
    $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
  } 

  // m�dia direita
  if($marca_dagua_posicao == 6) 
  { 
    $dest_x = $sourcefile_width - $insertfile_width - $marca_dagua_padding; 
    $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
  } 

  // inferior esquerda
  if($marca_dagua_posicao == 7) 
  { 
    $dest_x = $marca_dagua_padding; 
    $dest_y = $sourcefile_height - $insertfile_height - $marca_dagua_padding; 
  } 

  // inferior central
  if($marca_dagua_posicao == 8) 
  { 
    $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
    $dest_y = $sourcefile_height - $insertfile_height - $marca_dagua_padding; 
  } 

  // inferior direita
  if($marca_dagua_posicao == 9) 
  { 
    $dest_x = $sourcefile_width - $insertfile_width - $marca_dagua_padding; 
    $dest_y = $sourcefile_height - $insertfile_height - $marca_dagua_padding; 
  } 

  imagecopy($dst_img, $insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height); 
}








function recorta_arquivo($arquivo_original,$pasta_final,$nome_final,$largura_final,$altura_final,$x_selecao,$y_selecao,$largura_selecao,$altura_selecao)
{

 // seems gif not supported by GD now


    $ext = substr($arquivo_original, -3);


    if(strtolower($ext) == "gif") 
    { 
      if (!$src_img = imagecreatefromgif($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
    else if(strtolower($ext) == "jpg") 
    {
      if (!$src_img = imagecreatefromjpeg($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
      else if(strtolower($ext) == "png") 
    {
      if (!$src_img = imagecreatefrompng($arquivo_original))
      {
        echo "Error opening Image file!";exit;
      }
    }
    else 
    {
      echo "Error file type not supported!";exit;
    }



  $dst_img = imagecreatetruecolor($largura_final, $altura_final);

  imagecopyresampled($dst_img,$src_img,0,0,$x_selecao,$y_selecao,$largura_final,$altura_final,$largura_selecao,$altura_selecao);

  $novaimagem = $pasta_final . "/" . $nome_final;

  imagejpeg($dst_img,$novaimagem,100);

  ImageDestroy($dst_img);
}








function recorta_arquivo2($arquivo_original,$pasta_final,$nome_final,$largura_final,$altura_final,$x_selecao,$y_selecao,$largura_selecao,$altura_selecao,$marca_dagua_posicao,$marca_dagua_arquivo,$marca_dagua_padding)
{

 // seems gif not supported by GD now


    $ext = substr($arquivo_original, -3);


    if(strtolower($ext) == "gif") 
    { 
      if (!$src_img = imagecreatefromgif($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
    else if(strtolower($ext) == "jpg") 
    {
      if (!$src_img = imagecreatefromjpeg($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
      else if(strtolower($ext) == "png") 
    {
      if (!$src_img = imagecreatefrompng($arquivo_original))
      {
        echo "Error opening Image file!";exit;
      }
    }
    else 
    {
      echo "Error file type not supported!";exit;
    }



  $dst_img = imagecreatetruecolor($largura_final, $altura_final);

  imagecopyresampled($dst_img,$src_img,0,0,$x_selecao,$y_selecao,$largura_final,$altura_final,$largura_selecao,$altura_selecao);


  if(($marca_dagua_posicao!=10)&&($marca_dagua_posicao!=""))
  {
    if(($marca_dagua_arquivo!="")&&(file_exists($marca_dagua_arquivo)))
    {
      mascara($dst_img,$marca_dagua_posicao,$marca_dagua_arquivo,$marca_dagua_padding);
    }
  }





  $novaimagem = $pasta_final . "/" . $nome_final;

  imagejpeg($dst_img,$novaimagem,100);

  ImageDestroy($dst_img);
}









function cria_borda($arquivo_original,$pasta_final,$nome_final,$largura_final,$altura_final,$largura_original,$altura_original,$r,$g,$b)
{


 // seems gif not supported by GD now


    $ext = substr($arquivo_original, -3);


    if(strtolower($ext) == "gif") 
    { 
      if (!$imagem_original = imagecreatefromgif($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
    else if(strtolower($ext) == "jpg") 
    {
      if (!$imagem_original = imagecreatefromjpeg($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
      else if(strtolower($ext) == "png") 
    {
      if (!$imagem_original = imagecreatefrompng($arquivo_original)) 
      {
        echo "Error opening Image file!";exit;
      }
    }
    else 
    {
      echo "Error file type not supported!";exit;
    }







  $imagem_com_borda = imagecreatetruecolor($largura_final, $altura_final); 
  $branco = imagecolorallocate($imagem_com_borda, $r, $g, $b);
  imagefill($imagem_com_borda, 0, 0, $branco);




  $paddingx = ($largura_final - $largura_original)/2;
  $paddingy = ($altura_final - $altura_original)/2;


  imagecopy($imagem_com_borda, $imagem_original, $paddingx, $paddingy, 0, 0, $largura_original, $altura_original); 





  $novaimagem = $pasta_final . "/" . $nome_final;



  if(strtolower($ext) == "gif") 
  { 
    imagegif($imagem_com_borda,$novaimagem);
  }

  if(strtolower($ext) == "jpg") 
  {
    imagejpeg($imagem_com_borda,$novaimagem,100);
  }

  if(strtolower($ext) == "png") 
  {
    imagepng($imagem_com_borda,$novaimagem);
  }






  ImageDestroy($imagem_original);
  ImageDestroy($imagem_com_borda);
}






function cria_arquivo($arquivo_original,$pasta_final,$nome_final,$largura_final,$altura_final,$largura_maxima_final,$altura_maxima_final)
{ 

    // campos:

    // $arquivo_original - arquivo original
    // $pasta_final - pasta onde vai ser colocado
    // $nome_final - novo nome do arquivo
    // $largura_final - largura do thumbs (0 para indiferente)
    // $altura_final - altura do thumbs (0 para indiferente)
    // $largura_maxima_final- largura m�xima do thumbs (0 para indiferente)
    // $altura_maxima_final - altura m�xima do thumbs (0 para indiferente)
   


    // seems gif not supported by GD now
    $ext = substr($arquivo_original, -3);
    if(strtolower($ext) == "gif") { 
      if (!$src_img = imagecreatefromgif($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    } else if(strtolower($ext) == "jpg") {
      if (!$src_img = imagecreatefromjpeg($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    }
    else 
    {
      echo "Error file type not supported: " . $arquivo_original;
      exit;
    }




    $hw = getimagesize($arquivo_original);

    $largura_original = $hw["0"];
    $altura_original = $hw["1"];





    // descobrir se a foto original � em p� ou deitada

    if($largura_original>$altura_original)
    {
       $foto_original = "horizontal";
       $proporcao_original = $largura_original / $altura_original;
    }
    else
    {
       $foto_original = "vertical";
       $proporcao_original = $altura_original / $largura_original;
    }







    // testa para saber se a largura final e altura final devem ser exatas

    if(($largura_final!=0)&&($altura_final!=0))
    {





      // descobrir se a foto final � em p� ou deitada

      if($largura_final>=$altura_final)
      {
         $foto_final = "horizontal";
         $proporcao_final = $largura_final / $altura_final;
      }
      else
      {
         $foto_final = "vertical";
         $proporcao_final = $altura_final / $largura_final;
      }



      // Se as duas fotos tem a mesma orienta��o (ambas s�o verticais ou horizontais)

      if($foto_final == $foto_original)
      {


        // teste para saber se a propor��o final � maior que a propor��o original, ou seja, se a original � mais fina que a final
        if($proporcao_original < $proporcao_final)
        {

          // Se a foto final � mais grossa que a original e as duas fotos s�o horizontais, o sistema cortar� as laterais
          if(($foto_final=="horizontal")&&($foto_original=="horizontal"))
          {
            $proporcao_reducao = $largura_original / $largura_final;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_final * $proporcao_reducao;

            $borda_horizontal_original = 0;
            $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;
          }
          // Se a foto final � mais grossa que a original e as duas fotos s�o verticais, o sistema cortar� em cima e embaixo
          else
          {
            $proporcao_reducao = $altura_original / $altura_final;

            $altura_proporcional_original = $altura_original;
            $largura_proporcional_original = $largura_final * $proporcao_reducao;

            $borda_vertical_original = 0;
            $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
          }

        }
        else
        {
          // Se a foto final � mais fina que a original e as duas fotos s�o verticais, o sistema cortar� em cima e embaixo
          if(($foto_final=="vertical")&&($foto_original=="vertical"))
          {
            $proporcao_reducao = $largura_original / $largura_final;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_final * $proporcao_reducao;

            $borda_horizontal_original = 0;
            $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;
          }
          // Se a foto final � mais fina que a original e as duas fotos s�o horizontais, o sistema cortar� as laterais
          else
          {
            $proporcao_reducao = $altura_original / $altura_final;

            $altura_proporcional_original = $altura_original;
            $largura_proporcional_original = $largura_final * $proporcao_reducao;

            $borda_vertical_original = 0;
            $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
          }
        }

      }
      else
      {
        if(($foto_final=="horizontal")&&($foto_original=="vertical"))
        {

          $proporcao_reducao = $largura_original / $largura_final;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_final * $proporcao_reducao;

          $borda_horizontal_original = 0;
          $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;

        }
        else
        {
          $proporcao_reducao = $altura_original / $altura_final;

          $altura_proporcional_original = $altura_original;
          $largura_proporcional_original = $largura_final * $proporcao_reducao;

          $borda_vertical_original = 0;
          $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
        }

      }
    }
    else
    {


      if($largura_final!=0)
      {
        // altura � indiferente
        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        $largura_proporcional_original = $largura_original;
        $altura_proporcional_original = $altura_original;

        $proporcao_reducao = $largura_original / $largura_final;
        $altura_final = $altura_original / $proporcao_reducao;

      }

      if($altura_final!=0)
      {
        // largura � indiferente
        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        $largura_proporcional_original = $largura_original;
        $altura_proporcional_original = $altura_original;

        $proporcao_reducao = $altura_original / $altura_final;
        $largura_final = $largura_original / $proporcao_reducao;

      }

    }










 
    if(($largura_maxima_final!=0)&&($altura_maxima_final!=0))
    {


      if(($largura_maxima_final<$largura_original)&&($altura_maxima_final<$altura_original))
      {

        // descobrir se a foto final � em p� ou deitada

        if($largura_maxima_final>$altura_maxima_final)
        {
           $foto_final = "horizontal";
           $proporcao_final = $largura_maxima_final / $altura_maxima_final;
        }
        else
        {
           $foto_final = "vertical";
           $proporcao_final = $altura_maxima_final / $largura_maxima_final;
        }



        if($proporcao_final>$proporcao_original)
        {
          $borda_horizontal_original=0;
          $borda_vertical_original=0;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $altura_final = $altura_maxima_final;
          $proporcao_reducao = $altura_original / $altura_final;
          $largura_final = $largura_original / $proporcao_reducao;

        }
        else
        {
          $borda_horizontal_original=0;
          $borda_vertical_original=0;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_maxima_final;
          $proporcao_reducao = $largura_original / $largura_final;
          $altura_final = $altura_original / $proporcao_reducao;
        }
      }



// #####################################################################################################


      else
      {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_original;
            $largura_final = $largura_original;
      }


// ######################################################################################################









    }
    else
    {


      if($largura_maxima_final!=0)
      {


        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        if($largura_maxima_final<$largura_original)
        {

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_maxima_final;
          $proporcao_reducao = $largura_original / $largura_final;
          $altura_final = $altura_original / $proporcao_reducao;

        }
        else
        {

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_original;
          $altura_final = $altura_original;

        }


      }
      else
      {

        if($altura_maxima_final!=0)
        {

          if($altura_maxima_final<$altura_original)
          {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_maxima_final;
            $proporcao_reducao = $altura_original / $altura_final;
            $largura_final = $largura_original / $proporcao_reducao;

          }
          else
          {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_original;
            $largura_final = $largura_original;

          }

        }
      }

    }









    $dst_img = imagecreatetruecolor($largura_final, $altura_final);

    imagecopyresampled($dst_img,$src_img,0,0,$borda_horizontal_original,$borda_vertical_original,$largura_final,$altura_final,$largura_proporcional_original,$altura_proporcional_original);



    $novaimagem = $pasta_final . "/" . $nome_final;


    imagejpeg($dst_img,$novaimagem,100);
    ImageDestroy($dst_img);
    


}

















function cria_arquivo2($arquivo_original,$pasta_final,$nome_final,$largura_final,$altura_final,$largura_maxima_final,$altura_maxima_final,$marca_dagua_posicao,$marca_dagua_arquivo,$marca_dagua_padding)
{ 

    // campos:

    // $arquivo_original - arquivo original
    // $pasta_final - pasta onde vai ser colocado
    // $nome_final - novo nome do arquivo
    // $largura_final - largura do thumbs (0 para indiferente)
    // $altura_final - altura do thumbs (0 para indiferente)
    // $largura_maxima_final- largura m�xima do thumbs (0 para indiferente)
    // $altura_maxima_final - altura m�xima do thumbs (0 para indiferente)
   


    // seems gif not supported by GD now
    $ext = substr($arquivo_original, -3);
    if(strtolower($ext) == "gif") { 
      if (!$src_img = imagecreatefromgif($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    } else if(strtolower($ext) == "jpg") {
      if (!$src_img = imagecreatefromjpeg($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    }
    else 
    {
      echo "Error file type not supported: " . $arquivo_original;
      exit;
    }




    $hw = getimagesize($arquivo_original);

    $largura_original = $hw["0"];
    $altura_original = $hw["1"];





    // descobrir se a foto original � em p� ou deitada

    if($largura_original>$altura_original)
    {
       $foto_original = "horizontal";
       $proporcao_original = $largura_original / $altura_original;
    }
    else
    {
       $foto_original = "vertical";
       $proporcao_original = $altura_original / $largura_original;
    }







    // testa para saber se a largura final e altura final devem ser exatas

    if(($largura_final!=0)&&($altura_final!=0))
    {





      // descobrir se a foto final � em p� ou deitada

      if($largura_final>=$altura_final)
      {
         $foto_final = "horizontal";
         $proporcao_final = $largura_final / $altura_final;
      }
      else
      {
         $foto_final = "vertical";
         $proporcao_final = $altura_final / $largura_final;
      }



      // Se as duas fotos tem a mesma orienta��o (ambas s�o verticais ou horizontais)

      if($foto_final == $foto_original)
      {


        // teste para saber se a propor��o final � maior que a propor��o original, ou seja, se a original � mais fina que a final
        if($proporcao_original < $proporcao_final)
        {

          // Se a foto final � mais grossa que a original e as duas fotos s�o horizontais, o sistema cortar� as laterais
          if(($foto_final=="horizontal")&&($foto_original=="horizontal"))
          {
            $proporcao_reducao = $largura_original / $largura_final;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_final * $proporcao_reducao;

            $borda_horizontal_original = 0;
            $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;
          }
          // Se a foto final � mais grossa que a original e as duas fotos s�o verticais, o sistema cortar� em cima e embaixo
          else
          {
            $proporcao_reducao = $altura_original / $altura_final;

            $altura_proporcional_original = $altura_original;
            $largura_proporcional_original = $largura_final * $proporcao_reducao;

            $borda_vertical_original = 0;
            $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
          }

        }
        else
        {
          // Se a foto final � mais fina que a original e as duas fotos s�o verticais, o sistema cortar� em cima e embaixo
          if(($foto_final=="vertical")&&($foto_original=="vertical"))
          {
            $proporcao_reducao = $largura_original / $largura_final;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_final * $proporcao_reducao;

            $borda_horizontal_original = 0;
            $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;
          }
          // Se a foto final � mais fina que a original e as duas fotos s�o horizontais, o sistema cortar� as laterais
          else
          {
            $proporcao_reducao = $altura_original / $altura_final;

            $altura_proporcional_original = $altura_original;
            $largura_proporcional_original = $largura_final * $proporcao_reducao;

            $borda_vertical_original = 0;
            $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
          }
        }

      }
      else
      {
        if(($foto_final=="horizontal")&&($foto_original=="vertical"))
        {

          $proporcao_reducao = $largura_original / $largura_final;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_final * $proporcao_reducao;

          $borda_horizontal_original = 0;
          $borda_vertical_original = ($altura_original - $altura_proporcional_original)/2;

        }
        else
        {
          $proporcao_reducao = $altura_original / $altura_final;

          $altura_proporcional_original = $altura_original;
          $largura_proporcional_original = $largura_final * $proporcao_reducao;

          $borda_vertical_original = 0;
          $borda_horizontal_original = ($largura_original - $largura_proporcional_original)/2;
        }

      }
    }
    else
    {


      if($largura_final!=0)
      {
        // altura � indiferente
        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        $largura_proporcional_original = $largura_original;
        $altura_proporcional_original = $altura_original;

        $proporcao_reducao = $largura_original / $largura_final;
        $altura_final = $altura_original / $proporcao_reducao;

      }

      if($altura_final!=0)
      {
        // largura � indiferente
        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        $largura_proporcional_original = $largura_original;
        $altura_proporcional_original = $altura_original;

        $proporcao_reducao = $altura_original / $altura_final;
        $largura_final = $largura_original / $proporcao_reducao;

      }

    }










 
    if(($largura_maxima_final!=0)&&($altura_maxima_final!=0))
    {


      if(($largura_maxima_final<$largura_original)&&($altura_maxima_final<$altura_original))
      {

        // descobrir se a foto final � em p� ou deitada

        if($largura_maxima_final>$altura_maxima_final)
        {
           $foto_final = "horizontal";
           $proporcao_final = $largura_maxima_final / $altura_maxima_final;
        }
        else
        {
           $foto_final = "vertical";
           $proporcao_final = $altura_maxima_final / $largura_maxima_final;
        }



        if($proporcao_final>$proporcao_original)
        {
          $borda_horizontal_original=0;
          $borda_vertical_original=0;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $altura_final = $altura_maxima_final;
          $proporcao_reducao = $altura_original / $altura_final;
          $largura_final = $largura_original / $proporcao_reducao;

        }
        else
        {
          $borda_horizontal_original=0;
          $borda_vertical_original=0;

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_maxima_final;
          $proporcao_reducao = $largura_original / $largura_final;
          $altura_final = $altura_original / $proporcao_reducao;
        }
      }



// #####################################################################################################


      else
      {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_original;
            $largura_final = $largura_original;
      }


// ######################################################################################################









    }
    else
    {


      if($largura_maxima_final!=0)
      {


        $borda_horizontal_original=0;
        $borda_vertical_original=0;

        if($largura_maxima_final<$largura_original)
        {

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_maxima_final;
          $proporcao_reducao = $largura_original / $largura_final;
          $altura_final = $altura_original / $proporcao_reducao;

        }
        else
        {

          $largura_proporcional_original = $largura_original;
          $altura_proporcional_original = $altura_original;

          $largura_final = $largura_original;
          $altura_final = $altura_original;

        }


      }
      else
      {

        if($altura_maxima_final!=0)
        {

          if($altura_maxima_final<$altura_original)
          {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_maxima_final;
            $proporcao_reducao = $altura_original / $altura_final;
            $largura_final = $largura_original / $proporcao_reducao;

          }
          else
          {

            $borda_horizontal_original=0;
            $borda_vertical_original=0;

            $largura_proporcional_original = $largura_original;
            $altura_proporcional_original = $altura_original;

            $altura_final = $altura_original;
            $largura_final = $largura_original;

          }

        }
      }

    }









    $dst_img = imagecreatetruecolor($largura_final, $altura_final);

    imagecopyresampled($dst_img,$src_img,0,0,$borda_horizontal_original,$borda_vertical_original,$largura_final,$altura_final,$largura_proporcional_original,$altura_proporcional_original);


    if(($marca_dagua_posicao!=10)&&($marca_dagua_posicao!=""))
    {
      if(($marca_dagua_arquivo!="")&&(file_exists($marca_dagua_arquivo)))
      {
        mascara($dst_img,$marca_dagua_posicao,$marca_dagua_arquivo,$marca_dagua_padding);
      }
    }

    $novaimagem = $pasta_final . "/" . $nome_final;


    imagejpeg($dst_img,$novaimagem,100);
    ImageDestroy($dst_img);
    


}










function cria_thumbs($arquivo_original,$pasta_thumbs,$nome_thumbs,$largura_thumbs,$altura_thumbs,$borda,$tipo)
{ 

    // campos:

    // $arquivo_original - arquivo original
    // $pasta_thumbs - pasta onde vai ser colocado
    // $nome_thumbs - novo nome do arquivo
    // $largura_thumbs - largura do thumbs
    // $altura_thumbs - altura do thumbs
    // $borda - borda da foto original antes de fazer o thumbs
    // $tipo - 1 para for�ar tamanho final; 2 - for�ar largura ou altura que não est� com valor "0"
   

    // seems gif not supported by GD now
    $ext = substr($arquivo_original, -3);
    if(strtolower($ext) == "gif") { 
      if (!$src_img = imagecreatefromgif($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    } else if(strtolower($ext) == "jpg") {
      if (!$src_img = imagecreatefromjpeg($arquivo_original)) {
        echo "Error opening Image file!";exit;
      }
    } else {
      echo "Error file type not supported!";exit;
    }

    $hw = getimagesize($arquivo_original);





    if($tipo==1)
    {

      // truecolor supported only in GD 2.0 or later
 
      $dst_img = imagecreatetruecolor($largura_thumbs, $altura_thumbs);

      if(!$dst_img) 
      {
        $dst_img = imageCreate($largura_thumbs, $altura_thumbs);
      }


      $largura_original = $hw["0"];
      $altura_original = $hw["1"];

      if($largura_original>$altura_original)
      {
        $tamanho_menor = $altura_original;
        $tamanho_maior = $largura_original;
      }
      else
      {
        $tamanho_menor = $largura_original;
        $tamanho_maior = $altura_original;
      }


      $borda_maior = (($tamanho_maior - $tamanho_menor)/2) + $borda;
      $borda_menor = $borda;

      $tamanho_menor_final = $tamanho_menor - ($borda_menor*2);
      $tamanho_maior_final = $tamanho_maior - ($borda_maior*2);
    

      if($largura_original>$altura_original)
      {

//      inicio x imagem original
//      inicio y imagem original
//      inicio x do corte
//      inicio y do corte
//      largura do thumbs
//      altura do thumbs
//      largura do corte
//      altura do corte

        imagecopyresampled($dst_img,$src_img,0,0,$borda_maior,$borda_menor,$largura_thumbs,$altura_thumbs,$tamanho_maior_final,$tamanho_menor_final);

      }
      else
      {
        imagecopyresampled($dst_img,$src_img,0,0,$borda_menor,$borda_maior,$largura_thumbs,$altura_thumbs,$tamanho_menor_final,$tamanho_maior_final);
      }
    }









    if($tipo==2)
    {


      $largura_original = $hw["0"];
      $altura_original = $hw["1"];


      if($largura_thumbs==0)
      {
        $altura_final = $altura_thumbs;

        $largura_final = $altura_final*$altura_original/$largura_original;
      }

      if($altura_thumbs==0)
      {
        $largura_final = $largura_thumbs;

        $altura_final = $largura_final*$altura_original/$largura_original;

      }


      // truecolor supported only in GD 2.0 or later

      $dst_img = imagecreatetruecolor($largura_final, $altura_final);



      imagecopyresampled($dst_img,$src_img,0,0,0,0,$largura_final,$altura_final,$largura_original,$altura_original);

    }






 
    $novaimagem = $pasta_thumbs . "/" . $nome_thumbs;


    // envia a imagem
    //header("Content-type: image/jpg");
    imagejpeg($src_img,$arquivo_original,55);
    ImageDestroy($src_img);


    //header("Content-type: image/jpeg");
    imagejpeg($dst_img,$novaimagem,80);
    ImageDestroy($dst_img);
    


}










function redimensiona($imagefile,$largura,$altura)
{ 

    $thumbheigth = $altura; // Altura da miniatura
    $thumbwidth = $largura; // Largura da miniatura



    // seems gif not supported by GD now
    $ext = substr($imagefile, -3);
    if(strtolower($ext) == "gif") { 
      if (!$src_img = imagecreatefromgif($imagefile)) {
        echo "Error opening Image file!";exit;
      }
    } else if(strtolower($ext) == "jpg") {
      if (!$src_img = imagecreatefromjpeg($imagefile)) {
        echo "Error opening Image file!";exit;
      }
    } else {
      echo "Error file type not supported!";exit;
    }


    $hw = getimagesize($imagefile);



    if (($hw["0"] > $thumbwidth) || ($hw["1"] > $thumbheigth))
    {


      if ($hw["0"] > $thumbwidth) {
         $escalaL = $hw["0"] / $thumbwidth;
      }
      if ($hw["1"] > $thumbheigth) {
         $escalaA = $hw["1"] / $thumbheigth;
      }
      if ($escalaL > $escalaA) {
         $escala = $escalaL;
      }
      else {
         $escala = $escalaA;
      }
      $new_w = $hw["0"]/$escala;
      $new_h = $hw["1"]/$escala;

      // truecolor supported only in GD 2.0 or later
      $dst_img = @imagecreatetruecolor($new_w, $new_h);
      if(!$dst_img) {
        $dst_img = imageCreate($new_w, $new_h);
      }

      imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

    
      $novaimagem = Str_replace(".jpg","",$imagefile).".jpg";

      //header("Content-type: image/jpeg");
      imagejpeg($dst_img,$novaimagem);
      ImageDestroy($dst_img);

    }

}










//$sourcefile = Filename of the picture into that $insertfile will be inserted. 
//$insertfile = Filename of the picture that is to be inserted into $sourcefile. 
//$targetfile = Filename of the modified picture. 
//$transition = Intensity of the transition (in percent) 
//$pos          = Position where $insertfile will be inserted in $sourcefile 
//                0 = middle 
//                1 = top left 
//                2 = top right 
//                3 = bottom right 
//                4 = bottom left 
//                5 = top middle 
//                6 = middle right 
//                7 = bottom middle 
//                8 = middle left 
// 
// 

function insere_mascara($sourcefile,$insertfile, $targetfile, $pos=1,$transition=100) 
{ 
   
//Get the resource id�s of the pictures 
   $insertfile_id = imageCreateFromPNG($insertfile); 
   $sourcefile_id = imageCreateFromJPEG($sourcefile); 

//Get the sizes of both pix    
   $sourcefile_width=imageSX($sourcefile_id); 
   $sourcefile_height=imageSY($sourcefile_id); 
   $insertfile_width=imageSX($insertfile_id); 
   $insertfile_height=imageSY($insertfile_id); 

//middle 
   if( $pos == 0 ) 
   { 
       $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
       $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
   } 

//top left 
   if( $pos == 1 ) 
   { 
       $dest_x = 0; 
       $dest_y = 0; 
   } 

//top right 
   if( $pos == 2 ) 
   { 
       $dest_x = $sourcefile_width - $insertfile_width; 
       $dest_y = 0; 
   } 

//bottom right 
   if( $pos == 3 ) 
   { 
       $dest_x = $sourcefile_width - $insertfile_width; 
       $dest_y = $sourcefile_height - $insertfile_height; 
   } 

//bottom left    
   if( $pos == 4 ) 
   { 
       $dest_x = 0; 
       $dest_y = $sourcefile_height - $insertfile_height; 
   } 

//top middle 
   if( $pos == 5 ) 
   { 
       $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
       $dest_y = 0; 
   } 

//middle right 
   if( $pos == 6 ) 
   { 
       $dest_x = $sourcefile_width - $insertfile_width; 
       $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
   } 
       
//bottom middle    
   if( $pos == 7 ) 
   { 
       $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
       $dest_y = $sourcefile_height - $insertfile_height; 
   } 

//middle left 
   if( $pos == 8 ) 
   { 
       $dest_x = 0; 
       $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
   } 
   
//The main thing : merge the two pix    
   imageCopyMerge($sourcefile_id, $insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height,$transition); 

//Create a jpeg out of the modified picture 
   imagejpeg ($sourcefile_id,"$targetfile"); 
   
} 











function resizejpg($imagefile)
{ 

    $thumbheigth = 100; // Altura da miniatura
    $thumbwidth = 100; // Largura da miniatura

    // check path to prevent illegal access to other files
    if(substr($imagefile, 0, 1) != '.' || strstr($imagefile, "..")) {
        echo "Illegal access!";exit;
    }
    // seems gif not supported by GD now
    $ext = substr($imagefile, -3);
    if(strtolower($ext) == "gif") { 
      if (!$src_img = imagecreatefromgif($imagefile)) {
        echo "Error opening Image file!";exit;
      }
    } else if(strtolower($ext) == "jpg") {
      if (!$src_img = imagecreatefromjpeg($imagefile)) {
        echo "Error opening Image file!";exit;
      }
    } else {
      echo "Error file type not supported!";exit;
    }

    $hw = getimagesize($imagefile);


    if ($hw["0"] > $thumbwidth) {
       $escalaL = $hw["0"] / $thumbwidth;
    }
    if ($hw["1"] > $thumbheigth) {
       $escalaA = $hw["1"] / $thumbheigth;
    }
    if ($escalaL > $escalaA) {
       $escala = $escalaL;
    }
    else {
       $escala = $escalaA;
    }
    $new_w = $hw["0"]/$escala;
    $new_h = $hw["1"]/$escala;

    // truecolor supported only in GD 2.0 or later
    $dst_img = @imagecreatetruecolor($new_w, $new_h);
    if(!$dst_img) {
      $dst_img = imageCreate($new_w, $new_h);
    }

    imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

    $novaimagem = Str_replace(".jpg","",$imagefile)."p.jpg";

    //header("Content-type: image/jpeg");
    imagejpeg($dst_img,$novaimagem);
    ImageDestroy($dst_img);
    
    $textcolor = imagecolorallocate($src_img, 255, 255, 255);
    $textcolor2 = imagecolorallocate($src_img, 255, 255, 0);
    $textcolor3 = imagecolorallocate($src_img, 0, 0, 0);
    // escreve www.friweb.com.br/torabora
//    imagestring($src_img, 5, ($hw["0"] -238), ($hw["1"]-15), "www.friweb.com.br/torabora", $textcolor3);
//    imagestring($src_img, 5, ($hw["0"] -240), ($hw["1"]-18), "www.friweb.com.br/", $textcolor);
//    imagestring($src_img, 5, ($hw["0"] -78), ($hw["1"]-18), "torabora", $textcolor2);

    // envia a imagem
    //header("Content-type: image/jpg");
    imagejpeg($src_img,$imagefile);
    ImageDestroy($src_img);

}




?>
