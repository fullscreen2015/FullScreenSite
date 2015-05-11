<?

  include("../../include/sistema_zeros.php"); 
  include("configuracoes.php"); 

  $codigo_registro = $codigo;
  $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos);  

  if($tipo_sistema_fotos==1)
  {

    $pasta00 = "../../imagens/" . $nome_sistema_fotos;
    $pasta0 = "../../imagens/" . $nome_sistema_fotos . "/" . $codigo_registro ;
    $pasta1 = "../../imagens/" . $nome_sistema_fotos . "/" . $codigo_registro . "/fotos";
    $pasta2 = "../../imagens/" . $nome_sistema_fotos . "/" . $codigo_registro . "/thumbs";


    if(!(file_exists($pasta00)))
    {
      mkdir ($pasta00, 0777);
    }

    if(!(file_exists($pasta0)))
    {
      mkdir ($pasta0, 0777);
    }

    if(!(file_exists($pasta1)))
    {
      mkdir ($pasta1, 0777);
    }

    if(!(file_exists($pasta2)))
    {
      mkdir ($pasta2, 0777);
    }
  }








  if($tipo_sistema_fotos==3)
  {

    $pasta00 = "../../imagens/" . $nome_sistema_fotos;
    $pasta1 = "../../imagens/" . $nome_sistema_fotos . "/fotos";
    $pasta2 = "../../imagens/" . $nome_sistema_fotos . "/thumbs";


    if(!(file_exists($pasta00)))
    {
      mkdir ($pasta00, 0777);
    }

    if(!(file_exists($pasta1)))
    {
      mkdir ($pasta1, 0777);
    }

    if(!(file_exists($pasta2)))
    {
      mkdir ($pasta2, 0777);
    }
  }


  if($tipo_sistema_fotos==4)
  {

//    $pasta00 = "../../imagens/" . $nome_sistema_fotos;
//    $pasta2 = "../../imagens/" . $nome_sistema_fotos . "/thumbs";


//    if(!(file_exists($pasta00)))
  //  {
//      mkdir ($pasta00, 0777);
  //  }

//    if(!(file_exists($pasta2)))
  //  {
//      mkdir ($pasta2, 0777);
  //  }
  }






      header("Location: painel.php");  
?>