<?php

  function select($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao)
  {

    global $conexao;

    $sql = "SELECT " . $nome_campo_codigo ." , " . $nome_campo_descricao . " FROM " . $nome_tabela . " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>


          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>


          <select class="select" name="<? echo $nome_campo_codigo; ?>">
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
            {  



              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {
                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }


?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>"><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select>

<? 

  }


















  // A fun�� "select2" foi criada para ser utilizada quando o nome da chave-estrangeira � diferente da chave-prim�ria da outra tabela 
  // ent�o foi inserido mais um campo chamado $nome_campo_codigo_primario

  function select2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao)
  {

    global $conexao;
    global $sistema_exclusao;

    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;

    if($sistema_exclusao==1)
    {
      $sql.= " WHERE ativo=1 ";
    }

    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>


          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>


          <select class="select" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
            {  



              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {
                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }


?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>"><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select>

<? 

  }











  function select_painel($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$opcao_selecionada)
  {

    global $conexao;

    $tag_title = "no_required";


    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;

    if($sistema_exclusao==1)
    {
      if(substr_count($sql, 'WHERE'))
      {
        $sql.= " AND ativo=1 ";
      }
      else
      {
        $sql.= " WHERE ativo=1 ";
      }
    }

    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  


    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ': &nbsp;</b></font></td>';

    echo '<select class="select" alt="' . $descricao_campo . '" title="' . $tag_title . '" name="' . $nome_campo_codigo_primario . '">';
    echo '<option value="">Selecione</option>';


    while ($linha_itens = mysql_fetch_array($rs_itens))
    {  

      $selected="";
      if($opcao_selecionada==$linha_itens[$nome_campo_codigo])
      {
        $selected=" SELECTED ";
      }

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }

        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
      }


      echo '<option value="' . $linha_itens[$nome_campo_codigo] . '" ' . $selected . '>>' . $valores_para_mostrar . '</option>';

    }

    echo '</select>';

  }







  // nova vers�o da fun��o "select_painel", por�m em ajax

  // esta fun��o foi criada para ser utilizada no arquivo "painel.php / ajax_painel_filtros.php"
  // ela mostra um select com apenas uma posição, que � a posição atual do filtro.
  // quando clicado, um javascript chama um ajax com o select completo com todas as op��es da tabela estrangeira.
  // o objetivo desta fun��o � aumentar a velocidade do sistema, já que, em alguns casos, as tabelas estrangeiras
  // podem ter milhares de registros e todos eles eram exibidos todas as vezes que iamos editar um registro.
  // agora todos os registros só s�o exibidos quando queremos, realmente, alterar este campo espec�fico.

  function select_painel_filtros_ajax($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$cont,$opcao_selecionada,$quantidade_caracter)
  {

    global $conexao;

//////

 $sql_ro = "SELECT * FROM " . $nome_tabela;
 $rs_ro = mysql_query($sql_ro, $conexao);
 $rows_ro = mysql_num_rows($rs_ro);

//echo $rows_ro;
/////

    if($opcao_selecionada!="")
    {
  
      $sql_ce = "SELECT "  . $nome_campo_descricao . " FROM " . $nome_tabela;

      if(substr_count($sql_ce, 'WHERE'))
      {
        $sql_ce.= " AND ";
      }
      else
      {
        $sql_ce.= " WHERE ";
      }


      $sql_ce.=  $nome_campo_codigo . "=" . $opcao_selecionada;


      $rs_ce = mysql_query($sql_ce, $conexao);

      $rows_ce = mysql_num_rows($rs_ce);

      $linha_ce = mysql_fetch_array($rs_ce);

      
      $campos_para_mostrar = explode(",",$nome_campo_descricao);

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }
          
        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_ce["$nome_do_campo_para_mostrar"];
      }

    }
    else
    {
      $valores_para_mostrar="";
      $opcao_selecionada="0";
    }



    $id = $nome_campo_codigo_primario . "_" . $opcao_selecionada;
    $id2 = "'" . $id . "'";

    echo '<span style="float:left; margin:2px 0px 0px 18px;" class="preto_8"><b>:: Filtros - ' . $descricao_campo . ': &nbsp;</b></span>';



    echo '<span style="float:left;" id="div_' . $id . '">';

    $ultimo_codigo = $opcao_selecionada;

    // echo '<input onClick="javascript:filtros_mostrar_select(' . $cont . ',' . $id2 . ',' . $opcao_selecionada . ',' . $ultimo_codigo . ');" id="' . $id . '" class="input_painel" type="text" name="' . $id . '" value="' . $valores_para_mostrar . '">';

    ///////////////



          if($quantidade_caracter != "0" && $rows_ro>1000){

            if(isset($_REQUEST[$nome_campo_codigo_primario])){

              $value = $_REQUEST[$nome_campo_codigo_primario];
              $value2 = $_REQUEST["auto_busca_campo_".$nome_campo_codigo_primario];

            }else{

              $value= "";
              $value2= "";
            }


       
          echo '<input name="' . $nome_campo_codigo_primario . '" id="' . $nome_campo_codigo_primario . '" value="'.$value.'" class="input" type="hidden"  >';
            //onBlur="campo_none(\''.$nome_campo_codigo_primario.'\');"
          
          echo '<input onclick="campo_none(\''.$nome_campo_codigo_primario.'\');" id="auto_busca_campo_'.$nome_campo_codigo_primario.'" name="auto_busca_campo_'.$nome_campo_codigo_primario.'" value="'.str_replace("|||", " ",$value2).'" class="input" type="text"   onkeyup="enviaKey2(\'campo_'.$nome_campo_codigo_primario.'\',\''.$nome_campo_codigo_primario.'\',\''.$descricao_campo.'\',\''.$nome_tabela.'\',\''.$nome_campo_codigo.'\',\''.$nome_campo_descricao.'\',\''.$sistema_exclusao.'\',\''.$cont.'\',\''.$quantidade_caracter.'\');"   autocomplete="off" >';

         
          echo '<div id="campo_'.$nome_campo_codigo_primario.'"  style="   height:1px; position:relative; left:0px; top:0px; z-index:1000; "></div>';


                     }else{

///////////////////////////

    echo '<select ';
    echo 'onClick="javascript:filtros_mostrar_select(' . $cont . ',' . $id2 . ',' . $opcao_selecionada . ',' . $ultimo_codigo . ');" ';
    echo 'id="' . $id . '"  class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario . '">';


    if($opcao_selecionada==0)
    {
      $opcao_selecionada_value="";
    }
    else
    {
      $opcao_selecionada_value = $opcao_selecionada;
    }

    echo '<option value="' . $opcao_selecionada_value . '">' . $valores_para_mostrar . '  [clique para alterar]</option>';

    echo '</select>';
///////////////////////
      }

    /////////////////////

    echo '</span>';

  }


//AQUI APARECE O SELECT "CLICK PARA ALTERAR" /////


//FUN��O FILTROS ASSOCIATIVOS



  function select_painel_filtros_ajax_associativos($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$cont,$opcao_selecionada)
  {


   /* echo $nome_campo_descricao."1<br>";

    echo $descricao_campo."2<br>";
    echo $nome_tabela."3<br>";
    echo $nome_campo_codigo."4<br>";
   echo $nome_campo_descricao."5<br>";
   echo $nome_campo_codigo_primario."6<br>";
    echo $sistema_exclusao."7<br>";
    echo $cont."8<br>";
    echo $opcao_selecionada."9<br>";*/

    global $conexao;

  
    if($opcao_selecionada!="")
    {
  
      $sql_ce = "SELECT "  . $nome_campo_descricao . " FROM " . $nome_tabela;

      if(substr_count($sql_ce, 'WHERE'))
      {
        $sql_ce.= " AND ";
      }
      else
      {
        $sql_ce.= " WHERE ";
      }


      $sql_ce.=  $nome_campo_codigo . "=" . $opcao_selecionada;



      $rs_ce = mysql_query($sql_ce, $conexao);
      $linha_ce = mysql_fetch_array($rs_ce);



      $campos_para_mostrar = explode(",",$nome_campo_descricao);

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }
          
        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_ce["$nome_do_campo_para_mostrar"];
      }

    }
    else
    {
      $valores_para_mostrar="";
      $opcao_selecionada="0";
    }


    $id = $nome_campo_codigo_primario . "_" . $opcao_selecionada;
    $id2 = "'" . $id . "'";

    echo '<span style="float:left; margin:2px 0px 0px 18px;" class="preto_8"><b>* Filtros - ' . $descricao_campo . ': &nbsp;</b></span>';


    echo '<span style="float:left;" id="div_' . $id . '">';

    $ultimo_codigo = $opcao_selecionada;

    
    echo '<select ';
    echo 'onClick="javascript:filtros_mostrar_select_ass(' . $cont . ',' . $id2 . ',' . $opcao_selecionada . ',' . $ultimo_codigo . ');" ';
    echo 'id="' . $id . '"  class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario . '">';


    if($opcao_selecionada==0)
    {
      $opcao_selecionada_value="";
    }
    else
    {
      $opcao_selecionada_value = $opcao_selecionada;
    }

    echo '<option value="' . $opcao_selecionada_value . '">' . $valores_para_mostrar . '  [clique para alterar]</option>';

    echo '</select>';


    echo '</span>';

  }






//FIM FUN��O FILTROS ASSOCIATIVOS



  // Fun��o para quando a chave primaria de uma tabela não tem o mesmo nome da chave estrangeira

  function select_painel_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$codigo_registro,$largura,$valor_atual)
  {

    global $conexao;
    global $linha;


    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }


    $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        
        // a variavel conta_ativos foi criada para diferenciar o campo ativo quando
        // for o casa de existir mais de uma tabela no sql com o campo ativo
        // � necessário sempre colocar a tabela que vai servir como base para
        // definir qual ativo será utilizado na hora de mostrar a informa��o de Registro Exclu�do
        $conta_ativos = 0;

        foreach($tabelas AS $nome_da_tabela)
        {
          $conta_ativos++;
          $sql.= " " . trim($nome_da_tabela) . ".ativo AS ativo_" . $conta_ativos . ", ";
        }

      }
       else
      {
        $sql.= " ativo as ativo_1, ";
      }
    }







    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome

    if($sistema_exclusao==1)
    {

      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
        $sql.= " ( ";

        $sql2="";
        foreach($tabelas AS $nome_da_tabela)
        {
          if($sql2!="")
          {
            $sql2.= " AND ";
          }
          $sql2.= trim($nome_da_tabela) . ".ativo=1 ";
        }
        $sql.= $sql2 ;
        $sql.= " )" ;

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
      }

      $sql.= " OR (" . $nome_campo_codigo . "=" . $valor_atual . ")";

      
      if(substr_count($nome_tabela, 'WHERE'))
      {
        $sql.=" ) ";
      }

    }





    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;




    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

    $onchange = "javascript:atualizar(this.value,'".$codigo_registro."','" . $nome_campo_codigo_primario . "');";


  ?>
          &nbsp;&nbsp;
	
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>


          <select onchange="<? echo $onchange; ?>" class="select" style="width:<?php echo $largura; ?>px" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>

<?         
            while ($linha_itens = mysql_fetch_array($rs_itens))
            {  

              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {

                // no caso do nome do campo para mostrar for algo como nome_da_tabela.nome_do_campo
                if(strpos($nome_do_campo_para_mostrar, "."))
                {
                  $ncmp = explode(".",$nome_do_campo_para_mostrar);
                  $ncmp = $ncmp[1];
                  $nome_do_campo_para_mostrar = $ncmp;
                }

                
                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {

                if($linha_itens['ativo_1']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }


              echo '<option value="' . $linha_itens[$nome_campo_codigo] . '"';

              if($linha_itens[$nome_campo_codigo]==$valor_atual) 
              {
                echo " selected "; 
              }
              echo '>' . $valores_para_mostrar . '</option>';

            }  

          echo '</select>';

  }













  // Fun��o para quando a chave primaria de uma tabela não tem o mesmo nome da chave estrangeira

  function select_painel_filtros_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$codigo_registro,$valor_atual)
  {

    global $conexao;
    global $linha;



    $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        
        // a variavel conta_ativos foi criada para diferenciar o campo ativo quando
        // for o casa de existir mais de uma tabela no sql com o campo ativo
        // � necessário sempre colocar a tabela que vai servir como base para
        // definir qual ativo será utilizado na hora de mostrar a informa��o de Registro Exclu�do
        $conta_ativos = 0;

        foreach($tabelas AS $nome_da_tabela)
        {
          $conta_ativos++;
          $sql.= " " . trim($nome_da_tabela) . ".ativo AS ativo_" . $conta_ativos . ", ";
        }

      }
       else
      {
        $sql.= " ativo as ativo_1, ";
      }
    }







    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;




    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome

    if($sistema_exclusao==1)
    {

      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
        $sql.= " ( ";

        $sql2="";
        foreach($tabelas AS $nome_da_tabela)
        {
          if($sql2!="")
          {
            $sql2.= " AND ";
          }
          $sql2.= trim($nome_da_tabela) . ".ativo=1 ";
        }
        $sql.= $sql2 ;
        $sql.= " )" ;

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
      }

      $sql.= " OR (" . $nome_campo_codigo . "=" . $valor_atual . ")";

      
      if(substr_count($nome_tabela, 'WHERE'))
      {
        $sql.=" ) ";
      }

    }




    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;




    $rs_itens = mysql_query($sql, $conexao);

    $rows_itens = mysql_num_rows($rs_itens);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);


         
          //}else{
  
    echo '<select class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario . '" id="' . $nome_campo_codigo_primario . '">';
    echo '<option value="">Selecione</option>';


         
            while ($linha_itens = mysql_fetch_array($rs_itens))
            {  

              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {

                // no caso do nome do campo para mostrar for algo como nome_da_tabela.nome_do_campo
                if(strpos($nome_do_campo_para_mostrar, "."))
                {
                  $ncmp = explode(".",$nome_do_campo_para_mostrar);
                  $ncmp = $ncmp[1];
                  $nome_do_campo_para_mostrar = $ncmp;
                }

                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {

                if($linha_itens['ativo_1']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }


              echo '<option value="' . $linha_itens[$nome_campo_codigo] . '"';

              if($linha_itens[$nome_campo_codigo]==$valor_atual) 
              {
                echo " selected "; 
              }
              echo '>' . $valores_para_mostrar . '</option>';

            }  

          echo '</select>';


          echo '<script language=javascript>';

          echo 'ExpandSelect("' . $nome_campo_codigo_primario . '");
          ';

          echo '</script>';


        //}//MAIOR OU MENOR 



  }




// Fun��o associativa ASSOCIATIVA

  function select_painel_filtros_edit_ass($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$codigo_registro,$valor_atual)
  {

    global $conexao;
    global $linha;



    $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        
        // a variavel conta_ativos foi criada para diferenciar o campo ativo quando
        // for o casa de existir mais de uma tabela no sql com o campo ativo
        // � necessário sempre colocar a tabela que vai servir como base para
        // definir qual ativo será utilizado na hora de mostrar a informa��o de Registro Exclu�do
        $conta_ativos = 0;

        foreach($tabelas AS $nome_da_tabela)
        {
          $conta_ativos++;
          $sql.= " " . trim($nome_da_tabela) . ".ativo AS ativo_" . $conta_ativos . ", ";
        }

      }
       else
      {
        $sql.= " ativo as ativo_1, ";
      }
    }







    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome

    if($sistema_exclusao==1)
    {

      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
        $sql.= " ( ";

        $sql2="";
        foreach($tabelas AS $nome_da_tabela)
        {
          if($sql2!="")
          {
            $sql2.= " AND ";
          }
          $sql2.= trim($nome_da_tabela) . ".ativo=1 ";
        }
        $sql.= $sql2 ;
        $sql.= " )" ;

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
      }

      $sql.= " OR (" . $nome_campo_codigo . "=" . $valor_atual . ")";

      
      if(substr_count($nome_tabela, 'WHERE'))
      {
        $sql.=" ) ";
      }

    }





    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;


    //echo $sql;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

    



  
    echo '<select class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario. '" id="' . $nome_campo_codigo_primario. '">';
    echo '<option value="">Selecione</option>';


         
            while ($linha_itens = mysql_fetch_array($rs_itens))
            {  

              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {

                // no caso do nome do campo para mostrar for algo como nome_da_tabela.nome_do_campo
                if(strpos($nome_do_campo_para_mostrar, "."))
                {
                  $ncmp = explode(".",$nome_do_campo_para_mostrar);
                  $ncmp = $ncmp[1];
                  $nome_do_campo_para_mostrar = $ncmp;
                }

                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {

                if($linha_itens['ativo_1']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }


              echo '<option value="' . $linha_itens[$nome_campo_codigo] . '"';

              if($linha_itens[$nome_campo_codigo]==$valor_atual) 
              {
                echo " selected "; 
              }
              echo '>' . $valores_para_mostrar . '</option>';

            }  

          echo '</select>';


          echo '<script language=javascript>';

          echo 'ExpandSelect("' . $nome_campo_codigo_primario . '");
          ';

          echo '</script>';



  }



?>