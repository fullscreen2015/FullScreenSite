<?

function tirar_acentos($dado) 
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



?>