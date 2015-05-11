<?







  function data_add($data_original,$dias_para_somar)
  {


    // só funciona com somas at� 30 dias !!


    $dia = substr($data_original,6,2);
    $mes = substr($data_original,4,2);
    $ano = substr($data_original,0,4);

    $domingo_mes = substr($data_original,4,2);
    $domingo_ano = substr($data_original,0,4);

    $tstamp = mktime(0,0,0,$domingo_mes,$dia,$domingo_ano);
    $dias_do_mes = date("t",$tstamp);


    if(($dia + $dias_para_somar)>$dias_do_mes)
    {
      if($mes+1>12)
      {
        $domingo_ano = $ano + 1 ;
        $domingo_mes = 1;
      }
      else
      {
        $domingo_ano = $ano;
        $domingo_mes = $mes+1;
      }

      $domingo_dia = ($dia + $dias_para_somar)-$dias_do_mes;
    }
    else
    {
      $domingo_ano = $ano;
      $domingo_mes = $mes;
      $domingo_dia = $dia + $dias_para_somar;
    }

    $data_final = zerosaesquerda($domingo_ano,4) . zerosaesquerda($domingo_mes,2) . zerosaesquerda($domingo_dia,2);

    return $data_final;



  }










  function data_diff($data_original,$dias_para_subtrair)
  {


    // só funciona com subtra��o at� 30 dias !!


    $dia = substr($data_original,6,2);
    $mes = substr($data_original,4,2);
    $ano = substr($data_original,0,4);


    if(($dia - $dias_para_subtrair)<=0)
    {
      if($mes==1)
      {
        $domingo_ano = $ano - 1 ;
        $domingo_mes = 12;
      }
      else
      {
        $domingo_ano = $ano;
        $domingo_mes = $mes-1;
      }


      $tstamp = mktime(0,0,0,$domingo_mes,$dia,$domingo_ano);
      $dias_do_mes = date("t",$tstamp);


      echo " Dia: " . $dia;
      echo " Dias: " . $dias_para_subtrair;
      echo " Mes: " . $dias_do_mes;

      $domingo_dia = ($dia - $dias_para_subtrair) + $dias_do_mes;
    }
    else
    {
      $domingo_ano = $ano;
      $domingo_mes = $mes;
      $domingo_dia = $dia - $dias_para_subtrair;
    }

    $data_final = zerosaesquerda($domingo_ano,4) . zerosaesquerda($domingo_mes,2) . zerosaesquerda($domingo_dia,2);

    return $data_final;



  }







  function fwdiasemana($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("l",$tstamp);

    switch($ddd)
    {
      case "Monday":
       $dia_port = "Segunda-Feira";
       break;
      case "Tuesday":
       $dia_port = "Ter�a-Feira";
       break;
      case "Wednesday":
       $dia_port = "Quarta-Feira";
       break;
      case "Thursday":
       $dia_port = "Quinta-Feira";
       break;
      case "Friday":
       $dia_port = "Sexta-Feira";
       break;
      case "Saturday":
       $dia_port = "S�bado";
       break;
      case "Sunday":
       $dia_port = "Domingo";
       break;
    }

    return $dia_port;
  }










  function fwdiasemanai($ddd)
  {
    $year = substr ( $ddd, 0, 4 );
    $month = substr ( $ddd, 4, 2 );
    $day = substr ( $ddd, 6, 2 );

    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("l",$tstamp);

    switch($ddd)
    {
      case "Monday":
       $dia_port = "Segunda-Feira";
       break;
      case "Tuesday":
       $dia_port = "Ter�a-Feira";
       break;
      case "Wednesday":
       $dia_port = "Quarta-Feira";
       break;
      case "Thursday":
       $dia_port = "Quinta-Feira";
       break;
      case "Friday":
       $dia_port = "Sexta-Feira";
       break;
      case "Saturday":
       $dia_port = "S�bado";
       break;
      case "Sunday":
       $dia_port = "Domingo";
       break;
    }

    return $dia_port;
  }





  function fwdata($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("d/m/Y",$tstamp);
    return $ddd;
  }


  function fwdata_red($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("j/n",$tstamp);
    return $ddd;
  }



  function fwdatai($ddd)
  {
    $year = substr ( $ddd, 0, 4 );
    $month = substr ( $ddd, 4, 2 );
    $day = substr ( $ddd, 6, 2 );

    $tstamp = mktime(0,0,0,$month,$day,$year);
    return date("d/m/Y",$tstamp);
  }


  function fwdatai2($ddd)
  {
    $year = substr ( $ddd, 0, 4 );
    $month = substr ( $ddd, 4, 2 );
    $day = substr ( $ddd, 6, 2 );

    $tstamp = mktime(0,0,0,$month,$day,$year);
    return date("d/m",$tstamp);
  }


  function fwhorai($ddd)
  {

    $tam = strlen($ddd);
    $tam = 0 - $tam;

    $horatam = 4+$tam;
    $horatam = 0 - $horatam;

    $hora = substr ( $ddd, $tam, $horatam );
    $min = substr ( $ddd, $tam+$horatam, 2 );

    echo $hora.'/'.$min;

    $tstamp = mktime($hora,$min,0,1,1,2003);

    return date("G:i",$tstamp);
  }


  function fwdiai($ddd)
  {
    $dia = substr($ddd,6,2);
    return $dia;
  }

  function fwmesi($ddd)
  {
    $dia = substr($ddd,4,2);
    return $dia;
  }

  function fwmesext($ddd)
  {
    $mes = substr($ddd,4,2);


    switch($mes) // acha o m�s em portugu�s
      {
        case "01":
          $mes_port = "JANEIRO";
          break;
        case "02":
          $mes_port = "FEVEREIRO";
          break;
        case "03":
          $mes_port = "MAR�O";
          break;
        case "04":
          $mes_port = "ABRIL";
          break;
        case "05":
          $mes_port = "MAIO";
          break;
        case "06":
          $mes_port = "JUNHO";
          break;
        case "07":
          $mes_port = "JULHO";
          break;
        case "08":
          $mes_port = "AGOSTO";
          break;
        case "09":
          $mes_port = "SETEMBRO";
          break;
        case "10":
          $mes_port = "OUTUBRO";
          break;
        case "11":
          $mes_port = "NOVEMBRO";
          break;
        case "12":
         $mes_port = "DEZEMBRO";
         break;
      }
    return $mes_port;
  }

   function fwmesext2($ddd)
  {
    $mes = substr($ddd,4,2);


    switch($mes) // acha o m�s em portugu�s
      {
        case "1":
          $mes_port = "Janeiro";
          break;
        case "2":
          $mes_port = "Fevereiro";
          break;
        case "3":
          $mes_port = "Mar�o";
          break;
        case "4":
          $mes_port = "Abril";
          break;
        case "5":
          $mes_port = "Maio";
          break;
        case "6":
          $mes_port = "Junho";
          break;
        case "7":
          $mes_port = "Julho";
          break;
        case "8":
          $mes_port = "Agosto";
          break;
        case "9":
          $mes_port = "Setembro";
          break;
        case "10":
          $mes_port = "Outubro";
          break;
        case "11":
          $mes_port = "Novembro";
          break;
        case "12":
         $mes_port = "Dezembro";
         break;
      }
    return $mes_port;
  }

  function fwanoi($ddd)
  {
    $dia = substr($ddd,0,4);
    return $dia;
  }



  function fwdia($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("Ymd",$tstamp);

    $dia = substr($ddd,6,2);
    return $dia;
  }

  function fwmes($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("Ymd",$tstamp);

    $dia = substr($ddd,4,2);
    return $dia;
  }

  function fwano($ddd)
  {
    list($year,$month,$day) = explode("-",$ddd);
    $tstamp = mktime(0,0,0,$month,$day,$year);
    $ddd = date("Ymd",$tstamp);

    $dia = substr($ddd,0,4);
    return $dia;
  }



  function fwdatahorai($ddd)
  {
    $data = fwdatai(substr($ddd,0,8));
    $hora = fwhorai(substr($ddd,8,6));
    return $data . " - " . $hora;
  }



  function data_extenso($data)
  {
    
    $data_noticia = explode("-", $data);

    $a = $data_noticia[0];
    $m = $data_noticia[1];
    $d = $data_noticia[2];

    $mes = array('01', "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" );
    $meses = array('Janeiro', "Fevereiro", "Mar�o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" );

    $m= str_replace($mes, $meses, $m);

    return $data_noticia = $d ." de ". $m. " de " . $a;
  }

$dia_ingles = date("l"); //v� o dia da semana em ingl�s

switch($dia_ingles) //acha o dia da semana em portugu�s
{
  case "Monday":
   $dia_port = "Segunda-Feira";
   break;
  case "Tuesday":
   $dia_port = "Ter�a-Feira";
   break;
  case "Wednesday":
   $dia_port = "Quarta-Feira";
   break;
  case "Thursday":
   $dia_port = "Quinta-Feira";
   break;
  case "Friday":
   $dia_port = "Sexta-Feira";
   break;
  case "Saturday":
   $dia_port = "S�bado";
   break;
  case "Sunday":
   $dia_port = "Domingo";
   break;
}

$mes_ingles = date("n"); // v� o m�s em Ingl�s

switch($mes_ingles) // acha o m�s em portugu�s
{
  case "1":
    $mes_port = "Janeiro";
    break;
  case "2":
    $mes_port = "Fevereiro";
    break;
  case "3":
    $mes_port = "Mar�o";
    break;
  case "4":
    $mes_port = "Abril";
    break;
  case "5":
    $mes_port = "Maio";
    break;
  case "6":
    $mes_port = "Junho";
    break;
  case "7":
    $mes_port = "Julho";
    break;
  case "8":
    $mes_port = "Agosto";
    break;
  case "9":
    $mes_port = "Setembro";
    break;
  case "10":
    $mes_port = "Outubro";
    break;
  case "11":
    $mes_port = "Novembro";
    break;
  case "12":
   $mes_port = "Dezembro";
   break;
}

  $data_completa = $dia_port.", ".date("d")." de ".$mes_port." de ".date("Y");

  $data_cidade = "".date("d")." de ".$mes_port." de ".date("Y");



?>
