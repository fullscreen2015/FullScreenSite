<?php



      

  function return_bytes($val) 
  {
    $val = trim($val);
    
    switch (strtolower(substr($val, -1)))
    {
        case 'm': $val = (int)substr($val, 0, -1) * 1048576; break;
        case 'k': $val = (int)substr($val, 0, -1) * 1024; break;
        case 'g': $val = (int)substr($val, 0, -1) * 1073741824; break;
        case 'b':
            switch (strtolower(substr($val, -2, 1)))
            {
                case 'm': $val = (int)substr($val, 0, -2) * 1048576; break;
                case 'k': $val = (int)substr($val, 0, -2) * 1024; break;
                case 'g': $val = (int)substr($val, 0, -2) * 1073741824; break;
                default : break;
            } break;
        default: break;
    }
    return $val;
  }



  function encontrar_novo_indice($dir,$codigo,$numero_algarismos_documentos,$numero_algarismos_documentos_indice)
  {

    // esta função produra na pasta especificada (dir) o arquivo com maior indice
    // para somar 1 e retonar o próximo índice. 
    // Ela é usada nos módulos com sistema de documentos com mais de 1 arquivo por registro

    $files = array(); 
    if ($handle = opendir($dir)) 
    {
      while (false !== ($entry = readdir($handle))) 
      {
        if ($entry != "." && $entry != "..") 
        {
          if (is_dir($dir."/".$entry) === true)
          {
            // echo "DIRECTORY: ".$entry."\n";
          }
          else
          {
            if(($pos = strpos ($entry, $codigo))===0)
            {
              $files[] = $entry;
            }
          }
        }
      }
      closedir($handle);
    }

    $posicao_inicial = $numero_algarismos_documentos+1;
    
    $maior_codigo = 0;

    foreach ($files as $key => $nome_arquivo) 
    {
      $ultimo_codigo = substr($nome_arquivo, $posicao_inicial, $numero_algarismos_documentos_indice);

      if($ultimo_codigo>$maior_codigo)
      {
        $maior_codigo = $ultimo_codigo;
      }
      
    }

    $indice = (int)$maior_codigo+1;

    return $indice;
  }



  function verifica_extensao($tipos_arquivo_aceitos_mime,$tipos_arquivo_aceitos_extensao,$tipos_arquivo_proibidos_extensao,$arquivo,$mime)
  {

    $nome_arquivo_array = explode('.', $arquivo);
    $extensao = end($nome_arquivo_array);
    $extensao = strtolower($extensao);  



    $arquivo_liberado = true;

    if(count($tipos_arquivo_aceitos_extensao)>0)
    {
      if (array_search($extensao, $tipos_arquivo_aceitos_extensao) === false)
      {
        $arquivo_liberado = false;        
      }
    }
    
    if(count($tipos_arquivo_aceitos_mime)>0)
    {
      if (array_search($mime, $tipos_arquivo_aceitos_mime) === false)
      {
        echo $mime;
        $arquivo_liberado = false;        
      }
    }


    if(count($tipos_arquivo_proibidos_extensao)>0)
    {

      if (!(array_search($extensao, $tipos_arquivo_proibidos_extensao) === false))
      {
        $arquivo_liberado = false;        
      }
    }


    return $arquivo_liberado;

  }




  function ip()
  {

    // Pegando o IP
    if (getenv('HTTP_X_FORWARDED_FOR'))
    {
      $ip=getenv('HTTP_X_FORWARDED_FOR');
    }
    else
    {
      $ip=getenv('REMOTE_ADDR');
    }
    $ip_visitante = $ip;
    $ip_visitante = $ip_visitante . " ### " . gethostbyaddr ($ip_visitante);

    return $ip_visitante;
  }



 function gravar_txt($arquivo_dados,$texto)
  {

    if (file_exists($arquivo_dados))
    {
      $texto = str_replace('\"', chr(34), $texto);    
      $texto = str_replace("\n", "<br>", $texto);    
      $id = fopen($arquivo_dados,"wb");
      fwrite($id,$texto);
      fclose($id);
    }
  }

  function transforma_valor($x,$chave)
{
    $array = str_split($x);
    $valor = '';

    foreach($array as $a)
    {
         $num = $a;

         if($num == 0)
         {
            $valor.="-";
         }
         if($num == 1)
         {
            $valor.="a";
         }
         if($num == 2)
         {
            $valor.="b";
         }
         if($num == 3)
         {
            $valor.="c";
         }
         if($num == 4)
         {
            $valor.="d";
         }
         if($num == 5)
         {
            $valor.="e";
         }
         if($num == 6)
         {
            $valor.="f";
         }
         if($num == 7)
         {
            $valor.="g";
         }
         if($num == 8)
         {
            $valor.="h";
         }
         if($num == 9)
         {
            $valor.="i";
         }
         if($num == 10)
         {
            $valor.="j";
         }
         if($num == 11)
         {
            $valor.="k";
         }
         if($num == 12)
         {
            $valor.="l";
         }
         if($num == 13)
         {
            $valor.="m";
         }
         if($num == 14)
         {
            $valor.="n";
         }
         if($num == 15)
         {
            $valor.="o";
         }
         if($num == 16)
         {
            $valor.="p";
         }
         if($num == 17)
         {
            $valor.="q";
         }
         if($num == 18)
         {
            $valor.="r";
         }
         if($num == 19)
         {
            $valor.="s";
         }
         if($num == 20)
         {
            $valor.="t";
         }
         if($num == 21)
         {
            $valor.="u";
         }
         if($num == 22)
         {
            $valor.="v";
         }
         if($num == 23)
         {
            $valor.="w";
         }
         if($num == 24)
         {
            $valor.="x";
         }
         if($num == 25)
         {
            $valor.="y";
         }
         if($num == 26)
         {
            $valor.="z";
         }

    }

    return $valor;

}

function transforma_volta_valor($x, $chave)
{
    $array = str_split($x);
    $valor = '';
    $b = 1;
    foreach($array as $num)
    {
         if($num == "-")
         {
            $variavel=0;
         }
         if($num == "a")
         {
            $variavel=1;
         }
         if($num == "b")
         {
            $variavel=2;
         }
         if($num == "c")
         {
            $variavel=3;
         }
         if($num == "d")
         {
            $variavel=4;
         }
         if($num == "e")
         {
            $variavel=5;
         }
         if($num == "f")
         {
            $variavel=6;
         }
         if($num == "g")
         {
            $variavel=7;
         }
         if($num == "h")
         {
            $variavel=8;
         }
         if($num == "i")
         {
            $variavel=9;
         }
         if($num == "j")
         {
            $variavel=10;
         }
         if($num == "k")
         {
            $variavel=11;
         }
         if($num == "l")
         {
            $variavel=12;
         }
         if($num == "m")
         {
            $variavel=13;
         }
         if($num == "n")
         {
            $variavel=14;
         }
         if($num == "o")
         {
            $variavel=15;
         }
         if($num == "p")
         {
            $variavel=16;
         }
         if($num == "q")
         {
            $variavel=17;
         }
         if($num == "r")
         {
            $variavel=18;
         }
         if($num == "s")
         {
            $variavel=19;
         }
         if($num == "t")
         {
            $variavel=20;
         }
         if($num == "u")
         {
            $variavel=21;
         }
         if($num == "v")
         {
            $variavel=22;
         }
         if($num == "w")
         {
            $variavel=23;
         }
         if($num == "x")
         {
            $variavel=24;
         }
         if($num == "y")
         {
            $variavel=25;
         }
         if($num == "z")
         {
            $variavel=26;
         }

         $valor.=$variavel;

    }

    return $valor;

}

function criptografar($codigo, $chave)
{
      $v =  $codigo * $chave ;

      return transforma_valor($v, $chave);
}

function descriptografar($paramentro, $chave)
{
	  $paramentro = anti_injection($paramentro);

	  $v = transforma_volta_valor($paramentro, $chave);

      $valor = $v/$chave;
      $s = intval($valor);
      $r=$valor-$s;

      if($r == 0)
      {
         return $valor;
      }
      else
      {
         return 0;
      }
}

function anti_injection($sql)
{

  $sql = preg_replace("/( from | alter table | select | insert | delete | update | where | drop table | show tables |\*|--|\\\\)/i","",$sql);


  //limpa espaços vazio
  $sql = trim($sql);

  //tira tags html e php
  $sql = strip_tags($sql);

  //Adiciona barras invertidas a uma string
  $sql = addslashes($sql);

  return $sql;
}


?>