<?


  function tirar_acentos_link($dado) 
  {

    // $dado = trim( str_replace( "\'", "", $dado) );
    // $dado = str_replace( "'", "", $dado );

    $dado = str_replace( "-", "-", $dado );
    $dado = str_replace( "�", "c", $dado );
    $dado = str_replace( "�", "C", $dado );

    $dado = str_replace( "�", "a", $dado );
    $dado = str_replace( "�", "a", $dado );
    $dado = str_replace( "�", "a", $dado );
    $dado = str_replace( "�", "a", $dado );

    $dado = str_replace( "�", "A", $dado );
    $dado = str_replace( "�", "A", $dado );
    $dado = str_replace( "�", "A", $dado );
    $dado = str_replace( "�", "A", $dado );

    $dado = str_replace( "�", "e", $dado );
    $dado = str_replace( "�", "e", $dado );
    $dado = str_replace( "�", "e", $dado );

    $dado = str_replace( "�", "E", $dado );
    $dado = str_replace( "�", "E", $dado );
    $dado = str_replace( "�", "E", $dado );


    $dado = str_replace( "�", "i", $dado );
    $dado = str_replace( "�", "i", $dado );
    $dado = str_replace( "�", "i", $dado );
    $dado = str_replace( "�", "i", $dado );

    $dado = str_replace( "�", "I", $dado );
    $dado = str_replace( "�", "I", $dado );
    $dado = str_replace( "�", "I", $dado );

    $dado = str_replace( "�", "o", $dado );
    $dado = str_replace( "�", "o", $dado );
    $dado = str_replace( "�", "o", $dado );
    $dado = str_replace( "�", "o", $dado );

    $dado = str_replace( "�", "O", $dado );
    $dado = str_replace( "�", "O", $dado );
    $dado = str_replace( "�", "O", $dado );
    $dado = str_replace( "�", "O", $dado );

    $dado = str_replace( "�", "u", $dado );
    $dado = str_replace( "�", "u", $dado );
    $dado = str_replace( "�", "u", $dado );

    $dado = str_replace( "�", "U", $dado );
    $dado = str_replace( "�", "U", $dado );
    $dado = str_replace( "�", "U", $dado );

    $dado = str_replace( "�", "a", $dado );
    $dado = str_replace( "�", "o", $dado );

    return $dado;
  }



  function limpa_string($texto)
  {

    $titulo_url = ltrim($texto);
    $titulo_url = rtrim($titulo_url);
    $titulo_url = tirar_acentos_link($titulo_url);

    $titulo_url = strtolower($titulo_url);

    $titulo_url = str_replace(chr(34), "", $titulo_url);

    $titulo_url = str_replace("�", "", $titulo_url);
    $titulo_url = str_replace("�", "", $titulo_url);
    $titulo_url = str_replace("�", "", $titulo_url);
    $titulo_url = str_replace("`", "", $titulo_url);
    $titulo_url = str_replace("�", "", $titulo_url);
    $titulo_url = str_replace("%", "-por-cento", $titulo_url);
    $titulo_url = str_replace("?", "", $titulo_url);
    $titulo_url = str_replace("!", "", $titulo_url);
    $titulo_url = str_replace("R$", "", $titulo_url);
    $titulo_url = str_replace("r$", "", $titulo_url);
    $titulo_url = str_replace("$", "", $titulo_url);
    $titulo_url = str_replace(",", "-", $titulo_url);
    $titulo_url = str_replace("/", "-", $titulo_url);
    $titulo_url = str_replace(".", "", $titulo_url);
    $titulo_url = str_replace(" | ", "-", $titulo_url);
    $titulo_url = str_replace(" - ", "-", $titulo_url);
    $titulo_url = str_replace("   ", "-", $titulo_url);
    $titulo_url = str_replace("  ", "-", $titulo_url);
    $titulo_url = str_replace(" ", "-", $titulo_url);
    $titulo_url = str_replace("+", "-", $titulo_url);
    $titulo_url = str_replace("|", "-", $titulo_url);
    $titulo_url = str_replace(": ", "-", $titulo_url);
    $titulo_url = str_replace(":", "-", $titulo_url);
    $titulo_url = str_replace('"', '', $titulo_url); 
    $titulo_url = str_replace('"', '', $titulo_url); 
    $titulo_url = str_replace("--", "-", $titulo_url);



    $titulo_url = preg_replace("(\"|\')", "", $titulo_url);

    return $titulo_url;

  }



  function linkht($titulo,$codigo,$texto)
  {
    $titulo_url = limpa_string($texto);

    $link_ht = $titulo . $codigo . "," . $titulo_url . ".html";

    return ($link_ht);

  }


?>