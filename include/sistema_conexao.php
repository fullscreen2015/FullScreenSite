<?

  // $conexao = mysql_connect("localhost", "root","");
  // $banco = mysql_select_db("full_screen", $conexao);

    //$conexao = mysql_connect("186.202.152.139", "fullscreen3","Mudar123");
  //  $banco = mysql_select_db("fullscreen3", $conexao);

?>



<?php

  if ( $_SERVER['SERVER_NAME'] == "servidor" ):

    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "full_screen";

  else:

    $server = "186.202.152.139";
    $user = "fullscreen3";
    $password = "Mudar123";
    $dbname = "fullscreen3";

  endif;

  $conexao = mysql_connect($server, $user, $password);
  $banco = mysql_select_db($dbname, $conexao);


?>
