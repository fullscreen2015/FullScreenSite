<?
  function prepara_campo($valor,$tipo)
  {

    $valor_final = $valor;

    if(($tipo!="blob_html")&&($tipo!="editor_html")&&($tipo!="html"))
    {
      $valor_final = strip_tags($valor_final);
      $valor_final = stripslashes($valor_final);
    }

    switch ($tipo) 
    {

      case "editor_html":

        $valor_final = $valor_final;
        break;


      case "blob":

        $valor_final = htmlspecialchars($valor_final, ENT_QUOTES);
        $valor_final = str_replace("\n", "<br>", $valor_final);
        $valor_final = str_replace("  ","&nbsp;&nbsp;", $valor_final);

        break;


      case "blob_html":

        $valor_final = str_replace("\n", "<br>", $valor_final);
        $valor_final = str_replace("  ","&nbsp;&nbsp;", $valor_final);

        break;


      case "html":

        $valor_final = $valor_final;
        break;


      case "moeda":

        $valor_final = str_replace(".", "", $valor_final);
        $valor_final = str_replace(",", ".", $valor_final);

        break;


      case "real":

        $valor_final = str_replace(",", ".", $valor_final);

        break;


      case "senha_md5":

        $valor_final = md5($valor_final);

        break;




      default:

        $valor_final = htmlspecialchars($valor_final, ENT_QUOTES);


    }

    if(($tipo!="blob_html")&&($tipo!="editor_html")&&($tipo!="html"))
    {
      $valor_final = addslashes($valor_final);
    }

    $valor_final = str_replace("'", "&lsquo;", $valor_final);

    return($valor_final);

  }

?>