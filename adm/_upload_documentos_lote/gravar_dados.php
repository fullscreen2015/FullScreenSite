<?php



  $sql = "(";

  $sql.= $chave_primaria . ",";



  $variaveis1 = explode("---",$_REQUEST['valores']);

  $sql_campos = "";

  foreach($variaveis1 as $parte)
  { 
    $partes = explode("=",$parte);

    $campo = $partes[0];

    if($sql_campos!="")
    {
      $sql_campos.= ", ";
    }
    $sql_campos.= $campo;
  
  } 

  $sql.= $sql_campos;

  if($sistema_exclusao==1)
  {
    $sql.= ",ativo";
  }





  $sql.= ")";

  $sql.= " VALUES (";

  $sql.= "'" . $$chave_primaria . "',";




  $variaveis2 = explode("---",$_REQUEST['valores']);

  $sql_valores = "";

  foreach($variaveis2 as $parte2)
  { 
    $partes2 = explode("=",$parte2);

    $valor = $partes2[1];

    if($sql_valores!="")
    {
      $sql_valores.= ",";
    }
    $sql_valores.= "'" . $valor . "'";

  } 

  $sql.= $sql_valores;

  if($sistema_exclusao==1)
  {
    $sql.= ",'1'";
  }


  $sql = $sql . " )";

  $sql = "INSERT INTO " . $tabela . " " . $sql; 








?>
