<?

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