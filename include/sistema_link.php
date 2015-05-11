<?


  function tirar_acentos_link($dado) 
  {

    // $dado = trim( str_replace( "\'", "", $dado) );
    // $dado = str_replace( "'", "", $dado );

    $dado = str_replace( "-", "-", $dado );
    $dado = str_replace( "ç", "c", $dado );
    $dado = str_replace( "Ç", "C", $dado );

    $dado = str_replace( "á", "a", $dado );
    $dado = str_replace( "à", "a", $dado );
    $dado = str_replace( "â", "a", $dado );
    $dado = str_replace( "ã", "a", $dado );

    $dado = str_replace( "Á", "A", $dado );
    $dado = str_replace( "À", "A", $dado );
    $dado = str_replace( "Â", "A", $dado );
    $dado = str_replace( "Ã", "A", $dado );

    $dado = str_replace( "é", "e", $dado );
    $dado = str_replace( "è", "e", $dado );
    $dado = str_replace( "ê", "e", $dado );

    $dado = str_replace( "É", "E", $dado );
    $dado = str_replace( "È", "E", $dado );
    $dado = str_replace( "Ê", "E", $dado );


    $dado = str_replace( "í", "i", $dado );
    $dado = str_replace( "ì", "i", $dado );
    $dado = str_replace( "î", "i", $dado );
    $dado = str_replace( "ï", "i", $dado );

    $dado = str_replace( "Í", "I", $dado );
    $dado = str_replace( "Ì", "I", $dado );
    $dado = str_replace( "Î", "I", $dado );

    $dado = str_replace( "ó", "o", $dado );
    $dado = str_replace( "ò", "o", $dado );
    $dado = str_replace( "ô", "o", $dado );
    $dado = str_replace( "õ", "o", $dado );

    $dado = str_replace( "Ó", "O", $dado );
    $dado = str_replace( "Ò", "O", $dado );
    $dado = str_replace( "Ô", "O", $dado );
    $dado = str_replace( "Õ", "O", $dado );

    $dado = str_replace( "ú", "u", $dado );
    $dado = str_replace( "ù", "u", $dado );
    $dado = str_replace( "û", "u", $dado );

    $dado = str_replace( "Ú", "U", $dado );
    $dado = str_replace( "Ù", "U", $dado );
    $dado = str_replace( "Û", "U", $dado );

    $dado = str_replace( "ª", "a", $dado );
    $dado = str_replace( "º", "o", $dado );

    return $dado;
  }



  function limpa_string($texto)
  {

    $titulo_url = ltrim($texto);
    $titulo_url = rtrim($titulo_url);
    $titulo_url = tirar_acentos_link($titulo_url);

    $titulo_url = strtolower($titulo_url);

    $titulo_url = str_replace(chr(34), "", $titulo_url);

    $titulo_url = str_replace("°", "", $titulo_url);
    $titulo_url = str_replace("“", "", $titulo_url);
    $titulo_url = str_replace("”", "", $titulo_url);
    $titulo_url = str_replace("`", "", $titulo_url);
    $titulo_url = str_replace("´", "", $titulo_url);
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