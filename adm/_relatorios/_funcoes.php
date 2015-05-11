<?php


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

    //print_r($array);

    foreach($array as $a)
    {
         $num = $a;

         if($num == 0)
         {
            $valor.="_";
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

    // print_r($array);
    foreach($array as $num)
    {
         if($num == "_")
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

      echo $paramentro;

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