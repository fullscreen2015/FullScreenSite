<?

  function zerosaesquerda($string, $tam)
  {
    $zerosacolocar = $tam - strlen($string);

    $zeros="";
    for ($i=1;$i<=$zerosacolocar;$i++)
    {
      $zeros = "0$zeros";
    }
    $string = "$zeros$string";

    return $string;
  }

?>