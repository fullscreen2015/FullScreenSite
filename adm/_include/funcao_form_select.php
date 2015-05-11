<?php


  function select($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao,$help)
  {

    global $conexao;
//    global $sistema_exclusao;

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

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

            <?

            if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

            ?>


        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>">
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

          </select></td>



      </tr>
    </table>

<? 

  }






























  // A fun��o "select2" foi criada para ser utilizada quando o nome da chave-estrangeira � diferente da chave-prim�ria da outra tabela 
  // ent�o foi inserido mais um campo chamado $nome_campo_codigo_primario

  function select2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$help)
  {

    global $conexao;
  //  global $sistema_exclusao;



    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }




    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;


    if($sistema_exclusao==1)
    {

   
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " AND ". trim($nome_da_tabela).".ativo=1 ";
        }

      }
       else
      {
        $sql.= " WHERE ativo=1 ";
      }
    }









    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

            <?

              if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

            ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
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

              // para o caso de se usar o nome da tabela antes do nome do campo na configura��o. Ex: tabela_adm_usuarios.codigo_usuario
              // vamos limpar o nome da tabela

              $nome_campo_codigo_limpo = $nome_campo_codigo;
              $posicao = strcspn($nome_campo_codigo_limpo,'.');
              $nome_campo_codigo_limpo = substr($nome_campo_codigo_limpo, $posicao+1);
?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo_limpo];  ?>"><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }










  
  
  




  // A fun�� "select_usuario" foi criada para mostrar somente o usuário que fez o registro
  // em um campo do tipo "usuario"

  function select_usuario($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$help)
  {

    global $conexao;
    global $linha;


    $tag_title = $descricao_campo;


    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;


    if($sistema_exclusao==1)
    {

   
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " AND ". trim($nome_da_tabela).".ativo=1 ";
        }

      }
       else
      {
        $sql.= " WHERE ativo=1 ";
      }
    }


    if(substr_count($sql, 'WHERE'))
    {
      $sql.= " AND ";
    }
    else
    {
      $sql.= " WHERE ";
    }
    
    $sql.= $nome_campo_codigo . "=" . $_SESSION['fw_codigo_usuario'];


    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

            <?
              if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }
            ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">

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
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>" selected><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }














  // A fun�� "select_usuario" foi criada para mostrar somente o usuário que fez o registro
  // em um campo do tipo "usuario"

  function select_usuario_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$help)
  {

    global $conexao;
    global $linha;


    $tag_title = $descricao_campo;


    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;


    if($sistema_exclusao==1)
    {

   
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " AND ". trim($nome_da_tabela).".ativo=1 ";
        }

      }
       else
      {
        $sql.= " WHERE ativo=1 ";
      }
    }


    if(substr_count($sql, 'WHERE'))
    {
      $sql.= " AND ";
    }
    else
    {
      $sql.= " WHERE ";
    }
    
    $sql.= $nome_campo_codigo . "=" . $linha[$nome_campo_codigo_primario];


    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

            <?
              if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }
            ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">

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
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>" selected><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }



















  function select_recursivo($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$help)
  {

    global $conexao;



    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }



    $sql = "SELECT * FROM " . $nome_tabela;

    if($sistema_exclusao==1)
    {
      if(substr_count($sql, 'WHERE'))
      {
        $sql.= " AND ativo=1 ORDER BY ".$nome_campo_descricao." ";
        $rabicho = " AND ativo=1 ";
      }
      else
      {
        $sql.= " WHERE ativo=1 ORDER BY ".$nome_campo_descricao." ";

      }
    }
    else
    {
      $rabicho = " ORDER BY ".$nome_campo_descricao." ";
    }


?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle">
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; 
          if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }


          ?>: &nbsp;</b></font></td>
        <td width="50%">

        <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>


<?php


    $rs_itens = mysql_query($sql, $conexao);


    $x = 0;
    while($itens= mysql_fetch_array($rs_itens))
    {

          $sql = "SELECT * FROM ".$nome_tabela." WHERE ".$nome_campo_codigo." = '".$itens[$nome_campo_codigo]."' ".$rabicho."";
          $rs_todos_dados_pai = mysql_query($sql,$conexao)or die(mysql_error());
          $dados_pai = mysql_fetch_array($rs_todos_dados_pai);

            $codigo_item_pai = $dados_pai[$nome_campo_codigo];

            $lista_todos_dados = '';

          while( $codigo_item_pai > 0)
          {

                $sql = "SELECT * FROM ".$nome_tabela." WHERE ".$nome_campo_codigo." = '".$codigo_item_pai."' ".$rabicho."";
                $rs_todos_dados = mysql_query($sql,$conexao)or die(mysql_error());
                $dados = mysql_fetch_array($rs_todos_dados);

                 $codigo_item_pai = $dados[$nome_campo_codigo.'_pai'];

                 $nome_dado = $dados[$nome_campo_descricao];

                 if($lista_todos_dados == '')
                 {
                   $lista_todos_dados = $nome_dado;
                 }
                 else
                 {
                     $lista_todos_dados = $nome_dado.' - '.$lista_todos_dados;
                 }


                 $codigo_item = $dados_pai[$nome_campo_codigo];

           }


           $valores[$x] = '<option value="'.$codigo_item.'">'.$lista_todos_dados.'</option>';

           $x++;

         }

         while($x>0)
        {
            $x--;
            echo $valores[$x];

        }

         ?>

          </select></td>


      </tr>
    </table>

<?php


  }




  function select_duplo($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$help)
  {

    global $conexao;
    global $sistema_exclusao;

    $sql = "SELECT DISTINCT " . $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


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

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

          <?

            if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

          ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>">
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

          </select></td>



      </tr>
    </table>

<? 

  }














  function select_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao,$help)
  {

    global $conexao;
    global $linha;

    $sql = " SELECT DISTINCT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }


    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;
    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>
	
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

              <?
                if($help!="")
    {
      echo "se<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }
              ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>">
            <option value="">Selecione</option>

<?         
            while ($linha_itens = mysql_fetch_array($rs_itens))
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



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {
                if($linha_itens['ativo']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }


?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>" <? if ($linha_itens[$nome_campo_codigo]==$linha[$nome_campo_codigo]) { echo " selected "; } ?>><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }









  // Fun��o para quando a chave primaria de uma tabela não tem o mesmo nome da chave estrangeira

  function select_edit2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao)
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
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " " . trim($nome_da_tabela).".ativo, ";
        }

      }
       else
      {
        $sql.= " ativo, ";
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








      $sql.= " OR (" . $nome_campo_codigo . "=" . $linha[$nome_campo_codigo_primario] . ")";
    }

    $sql.= " GROUP BY " . $nome_campo_descricao;
    $sql.= " ORDER BY " . $nome_campo_descricao;


    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>
	
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>
          
        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>

<?         
            while ($linha_itens = mysql_fetch_array($rs_itens))
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



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {

                if($linha_itens['ativo']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }



              // para o caso de se usar o nome da tabela antes do nome do campo na configura��o. Ex: tabela_adm_usuarios.codigo_usuario
              // vamos limpar o nome da tabela

              $nome_campo_codigo_limpo = $nome_campo_codigo;
              if(strstr($nome_campo_codigo,"."))
              {
                $posicao = strcspn($nome_campo_codigo_limpo,'.');
                $nome_campo_codigo_limpo = substr($nome_campo_codigo_limpo, $posicao+1);
              }
?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo_limpo];  ?>" <? if ($linha_itens[$nome_campo_codigo_limpo]==$linha[$nome_campo_codigo_primario]) { echo " selected "; } ?>><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }













  // Vers�o n� 3 da select_edit()
  // esta vers�o foi criada para ser chamada pelo arquivo "ajax_editar_dados_mostrar_select.php"
  // ela tem um par�metro adicional chamado "valor_atual", que não existia na vers�o anterior, pois o valor vinha direto do array original ($linha)
  // como agora ela vem de um arquivo ajax, este valor não pode mais ser retirado do array original do arquivo "editar_dados.php"

  function select_edit3($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$valor_atual,$modulo,$ultimo_codigo)
  {


    global $conexao;
	
	
    // selecionar o �ltimo c�digo registrado desta tabela
    // assim, podemos deixar selecionado o �ltimo registo feito 
    // no caso da atualiza��o via colorbox
	
    $valor_atual = "$valor_atual";
	
    $nome_tabela2 = explode(",",$nome_tabela);
    $nome_tabela2 = $nome_tabela2[0];
    $sql_novo = "SELECT MAX("  . $nome_campo_codigo . ") as ultimo_codigo FROM " . $nome_tabela2;
    if($sistema_exclusao==1)
    {
      $sql_novo.= " WHERE ativo=1 ";
    }

    $rs_ultimo_codigo = mysql_query($sql_novo, $conexao);
	  
    $linha_ultimo_codigo = mysql_fetch_array($rs_ultimo_codigo);

    if((int)$linha_ultimo_codigo['ultimo_codigo']>(int)$ultimo_codigo)
    {
      $valor_atual = $linha_ultimo_codigo['ultimo_codigo'];
    }

	
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

    echo '<select class="select" alt="' . $descricao_campo . '" title="' . $tag_title . '"';
    echo ' name="' . $nome_campo_codigo_primario;
    echo '"';
    echo ' id="select_' . $nome_campo_codigo_primario . '">
	';
	
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



      // para o caso de se usar o nome da tabela antes do nome do campo na configura��o. Ex: tabela_adm_usuarios.codigo_usuario
      // vamos limpar o nome da tabela

      $nome_campo_codigo_limpo = $nome_campo_codigo;
      if(strstr($nome_campo_codigo,"."))
      {
        $posicao = strcspn($nome_campo_codigo_limpo,'.');
        $nome_campo_codigo_limpo = substr($nome_campo_codigo_limpo, $posicao+1);
      }


      $selected = ""; 
	  
	  if($linha_itens[$nome_campo_codigo_limpo]==$valor_atual) 
	  {
	    $selected = " selected "; 
	  } 
      echo '<option value="' . $linha_itens[$nome_campo_codigo_limpo] . '" ' . $selected . '>' . $valores_para_mostrar . '</option>
	  ';

    }  

    echo '</select>
	';

  }

  
  
  
  
  
  
  






  // esta fun��o foi criada para ser utilizada no arquivo "editar_dados.php"
  // ela mostra um select com apenas uma posição, que � a posição atual da chave estrangeira.
  // quando clicado, um javascript chama um ajax com o select completo com todas as op��es da tabela estrangeira.
  // o objetivo desta fun��o � aumentar a velocidade do sistema, já que, em alguns casos, as tabelas estrangeiras
  // podem ter milhares de registros e todos eles eram exibidos todas as vezes que iamos editar um registro.
  // agora todos os registros só s�o exibidos quando queremos, realmente, alterar este campo espec�fico.


  function select_edit_ajax($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$cont,$modulo,$help)
  {

    global $conexao;
    global $linha;


		  
    // pegando valor m�ximo atual da tabela, para depois saber se realmente
	// foi inserido um novo registro e assim
    // já mostrar o select selecionado na posição nova
	  
    $nome_tabela2 = explode(",",$nome_tabela);
    $nome_tabela2 = $nome_tabela2[0];
    $sql_novo = "SELECT MAX("  . $nome_campo_codigo . ") as ultimo_codigo FROM " . $nome_tabela2;
    if($sistema_exclusao==1)
    {
      $sql_novo.= " WHERE ativo=1 ";
    }
    
    $rs_ultimo_codigo = mysql_query($sql_novo, $conexao);
	  
    $linha_ultimo_codigo = mysql_fetch_array($rs_ultimo_codigo);
    $ultimo_codigo = $linha_ultimo_codigo['ultimo_codigo'];


	
  
  
  
    $sql_ce = "SELECT "  . $nome_campo_descricao . " FROM " . $nome_tabela;

    if(substr_count($sql_ce, 'WHERE'))
    {
      $sql_ce.= " AND ";
    }
    else
    {
      $sql_ce.= " WHERE ";
    }


    $sql_ce.=  $nome_campo_codigo . "=" . $linha[$nome_campo_codigo_primario];



    $rs_ce = mysql_query($sql_ce, $conexao);
    $linha_ce = mysql_fetch_array($rs_ce);



    $campos_para_mostrar = explode(",",$nome_campo_descricao);

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
      $valores_para_mostrar.= $linha_ce["$nome_do_campo_para_mostrar"];
    }


    $id = $nome_campo_codigo_primario . "_" . $linha[$nome_campo_codigo_primario];
    $id2 = "'" . $id . "'";



    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>' . $descricao_campo . ': &nbsp;</b></font>';
      if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

	echo '</td>';
    echo '<td width="50%">';

    echo '<span style="float:left;" id="div_' . $id . '">';

    echo '<select ';
    echo 'onClick="javascript:mostrar_select(' . $cont . ',' . $id2 . ',' . $linha[$nome_campo_codigo_primario] . ',' . $ultimo_codigo . ');" ';
    echo 'id="' . $id . '"  class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario . '">';

    echo '<option value="' . $linha[$nome_campo_codigo_primario] . '">' . $valores_para_mostrar . '  [clique para editar]</option>';
    echo '</select>';

    echo '</span>';


    if($modulo!="")
	{
      // verifica se o usuário atual tem permiss�o para inserá�o no m�dulo desejado
      if(verifica_usuario2($modulo, 3))
      {

        // link para abrir o m�dulo da chave estrangeira para inserá�o sem sair da p�gina
        echo "<span style='float:left; margin-left:20px;'>";
  	    echo ' <a href="../_modulos/inserir.php?codigo_modulo=' . $modulo . '" rel="' . $cont . ',' . $id . ',' . $linha[$nome_campo_codigo_primario] . ',' . $ultimo_codigo . '" class="iframe callbacks caminho">+ Adicionar ' . $descricao_campo . '</a>';
	    echo "</span>";
      }
	}


	echo '</td>';
    echo '</tr></table>';



  }










  function select_recursivo_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$help)
  {


    // nesta fun��o, não pode ser permitido ao usuário selecionar um registro que seja ele mesmo, ou filho do registro atual


    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }




    global $conexao;
    global $linha;

    $sql = "SELECT * FROM " . $nome_tabela;

    if($sistema_exclusao==1)
    {
      if(substr_count($sql, 'WHERE'))
      {
        $sql.= " AND ativo=1 ORDER BY ".$nome_campo_descricao." ";
        $rabicho = " AND ativo=1 ";
      }
      else
      {
        $sql.= " WHERE ativo=1 ORDER BY ".$nome_campo_descricao." ";

      }
    }
    else
    {
      $rabicho = " ORDER BY ".$nome_campo_descricao." ";
    }


?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle">
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>

          <?

            if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

          ?>


        </td>
        <td width="50%">
        <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>">
            <option value="">Selecione</option>




<?php


    $rs_itens = mysql_query($sql, $conexao);

    $i = 0;
    $barra_todas_categorias[$i] = 'nada';
    $valor[$i] = 'nada';
    while($itens= mysql_fetch_array($rs_itens))
    {
         if($itens[$nome_campo_codigo] != $linha[$nome_campo_codigo])
         {
          $codigo_categoria = $itens[$nome_campo_codigo];

           $barra_todas_categorias[$i] = '';
           $valor[$i] = $codigo_categoria;

         while($codigo_categoria != 0)
        {
        	if($codigo_categoria != $linha[$nome_campo_codigo])
            {
                $sql = "SELECT * FROM ".$nome_tabela." WHERE ".$nome_campo_codigo." = '".$codigo_categoria."' ".$rabicho."";
                $rs_categoria = mysql_query($sql,$conexao)or die(mysql_error());
                $categoria = mysql_fetch_array($rs_categoria);

                $link_categoria = $categoria[$nome_campo_descricao];

                $codigo_categoria = $categoria[$nome_campo_codigo."_pai"];

                if($barra_todas_categorias[$i] == '')
                {
                   $barra_todas_categorias[$i] = $link_categoria;
                }
                else
                {
                    $barra_todas_categorias[$i] = $link_categoria . ' - ' . $barra_todas_categorias[$i];
                }
            }
            else
            {
            	$barra_todas_categorias[$i] = 'nada';
		        break;
            }


        }
        }
        else
        {
                 $barra_todas_categorias[$i] = '';
        		 $valor[$i] = $itens[$nome_campo_codigo];

                 $codigo_categoria = $itens[$nome_campo_codigo];
                  while($codigo_categoria != 0)
                   {

                      $sql = "SELECT * FROM ".$nome_tabela." WHERE ".$nome_campo_codigo." = '".$codigo_categoria."' ".$rabicho."";
                      $rs_categoria = mysql_query($sql,$conexao)or die(mysql_error());
                      $categoria = mysql_fetch_array($rs_categoria);

                      $link_categoria = $categoria[$nome_campo_descricao];

                      $codigo_categoria = $categoria[$nome_campo_codigo."_pai"];

                      if($barra_todas_categorias[$i] == '')
                      {
                         $barra_todas_categorias[$i] = $link_categoria;
                      }
                      else
                      {
                          $barra_todas_categorias[$i] = $link_categoria.' - '.$barra_todas_categorias[$i];
                      }

                  }
        }

        $i++;


    }
           $i--;
       while($i>=0)
        {
        	if($barra_todas_categorias[$i] != 'nada')
            {
                    if($valor[$i] != 'nada')
                    {

                        if($valor[$i] != $linha[$nome_campo_codigo]) // não mostra a opção do pr�prio registro, ou seja, não deixa selecionar ele mesmo
                        {

                          if($valor[$i] == $linha[$nome_campo_codigo_primario])
                          {
                               echo '<option value="'.$valor[$i].'" selected >'.$barra_todas_categorias[$i].'</option>';
                          }
                          else
                          {
                              echo '<option value="'.$valor[$i].'" >'.$barra_todas_categorias[$i].'</option>';
                          }
                        }

                    }
            }
            $i--;
        }

    ?>

    </select>  </td>


      </tr>
    </table>

<?php


  }




















  // Fun��o para quando a chave primaria de uma tabela não tem o mesmo nome da chave estrangeira

  function select_edit_interlacado($descricao_campo_filho,$nome_tabela_filho,$chave_primaria_tabela_filho,$nome_campo_descricao,$nome_tabela_associativa,$nome_campo_codigo_primario,$sistema_exclusao,$help)
  {

    global $conexao;
    global $linha;


    $sql = " SELECT DISTINCT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }


    $sql.= $chave_primaria_tabela_filho . " , " . $nome_campo_descricao . " FROM " . $nome_tabela_filho;
    $sql.= " ORDER BY " . $nome_campo_descricao;


    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>
	
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo_filho; ?>: &nbsp;</b></font>

              <?

                if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

              ?>

        </td>
        <td width="50%">

          <select class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $chave_primaria_tabela_filho; ?>[]">
            <option value="">Selecione</option>

<?         
            while ($linha_itens = mysql_fetch_array($rs_itens))
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



              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {
                if($linha_itens['ativo']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }


              $sql = " SELECT * FROM ";
              $sql.= $nome_tabela_associativa;
              $sql.= " WHERE ";
              $sql.= $nome_campo_codigo_primario . "=" . $linha[$nome_campo_codigo_primario];
              $sql.= " AND ";
              $sql.= $chave_primaria_tabela_filho . "=" . $linha_itens[$chave_primaria_tabela_filho];

              $rs_selected = mysql_query($sql,$conexao);

              $selected = ""; 
              if (mysql_num_rows($rs_selected)>0) 
              {
                $selected = " selected "; 
              }


?>
 
              <option value="<? echo $linha_itens[$chave_primaria_tabela_filho];  ?>" <? echo $selected; ?> ><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }
















  function select_multi($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$help)
  {

    global $conexao;
    global $sistema_exclusao;


    $sql = " SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;

    if($sistema_exclusao==1)
    {

      if(substr_count($sql, 'WHERE'))
      {
        $sql.=" AND ";
      }
      else
      {
        $sql.=" WHERE ";
      }

      $sql.=" ativo=1";
    }

    $sql.= " ORDER BY " . $nome_campo_descricao;
              echo $sql;
    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8">
            <b><? echo $descricao_campo; ?>: &nbsp;</b>
              <?

                if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

              ?>


            <br>
            (Utilize a tecla Ctrl&nbsp;<br>para selecionar mais&nbsp;<br>de uma opção)&nbsp;
          </font></td>
        <td width="50%">

          <select multiple class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>[]" size=10>
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

          </select></td>


      </tr>
    </table>

<? 

  }







  function select_multi2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao,$help)
  {

    global $conexao;

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
        foreach($tabelas AS $nome_da_tabela)
        {
          $apelido = trim($nome_da_tabela) . "_ativo";
          $sql.= " " . trim($nome_da_tabela).".ativo as " . $apelido . ", ";
        }

      }
       else
      {
        $apelido = "ativo";
        $sql.= $apelido . ", ";
      }
    }

    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    if($sistema_exclusao==1)
    {

      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
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


    }


    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;


    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle">
        <td width="50%" align="right">
          <font class="preto_8">
            <b><? echo $descricao_campo; ?>: &nbsp;</b>
              <?

                if($help!="")
    {
      echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

              ?>


            <br>
            (Utilize a tecla Ctrl&nbsp;<br>para selecionar mais&nbsp;<br>de uma opção)&nbsp;
          </font></td>
        <td width="50%">

          <select multiple class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>[]" size=10>
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

          </select></td>


      </tr>
    </table>

<?

  }






  function select_multi_edit($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_tabela_associativa,$nome_campo_associado,$help)
  {

    global $conexao;
    global $linha;
    global $sistema_exclusao;


    $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }

    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql,$conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8">
            <b><? echo $descricao_campo; ?>: &nbsp;</b>
              <?

                if($help!="")
                {
                   echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
                }

              ?>

            <br>
            (Utilize a tecla Ctrl&nbsp;<br>para selecionar mais&nbsp;<br>de uma opção)&nbsp;
          </font></td>
        <td width="50%">

          <select multiple class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>[]" size=10>
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
            {  
              $sql2 = "SELECT " . $nome_campo_codigo . " FROM " . $nome_tabela_associativa . " WHERE " . $nome_campo_codigo. " = " . $linha_itens[$nome_campo_codigo] . " AND " . $nome_campo_associado . " = " . $linha[$nome_campo_associado];
              $rs_item_associado = mysql_query($sql2 , $conexao);
              $linha_item_associado = mysql_fetch_array($rs_item_associado);


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


              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

              if($sistema_exclusao==1)
              {
                if($linha_itens['ativo']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }

?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>"     <? if ($linha_itens[$nome_campo_codigo]==$linha_item_associado[$nome_campo_codigo]) { echo " selected "; } ?>><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<? 

  }



















  function select_multi_edit2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_tabela_associativa,$nome_campo_associado,$sistema_exclusao,$help)
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
        foreach($tabelas AS $nome_da_tabela)
        {
          $apelido = trim($nome_da_tabela) . "_ativo";
          $sql.= " " . trim($nome_da_tabela).".ativo as " . $apelido . ", ";
        }

      }
       else
      {
        $apelido = "ativo";
        $sql.= $apelido . ", ";
      }
    }

    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome
    if($sistema_exclusao==1)
    {

      $codigo_item_selecionado = "";
      $sql3 = "SELECT " . $nome_campo_codigo . " FROM " . $nome_tabela_associativa . " WHERE " . $nome_campo_associado . " = " . $linha[$nome_campo_associado];
      $rs_item_selecionado = mysql_query($sql3 , $conexao);
      if(mysql_num_rows($rs_item_selecionado)>0)
      { 
        $linha_item_selecionado = mysql_fetch_array($rs_item_selecionado);
        $codigo_item_selecionado = $linha_item_selecionado[$nome_campo_codigo];
      }


      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND (( " ;
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

        if($codigo_item_selecionado!="")
        {
          $sql.= " OR (" . $nome_campo_codigo . "=" . $codigo_item_selecionado . ")";
        }

        $sql.= ")";

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
        if($codigo_item_selecionado!="")
        {
          $sql.= " OR (" . $nome_campo_codigo . "=" . $codigo_item_selecionado . ")";
        }
      }


    }


    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;


    $rs_itens = mysql_query($sql,$conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);


  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle">
        <td width="50%" align="right">
          <font class="preto_8">
            <b><? echo $descricao_campo; ?>: &nbsp;</b>
               <?

                if($help!="")
                {
                echo "<img src='../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
                }

              ?>
            <br>
            (Utilize a tecla Ctrl&nbsp;<br>para selecionar mais&nbsp;<br>de uma opção)&nbsp;
          </font></td>
        <td width="50%">

          <select multiple class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo_codigo; ?>[]" size=10>
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
            {
              $sql2 = "SELECT " . $nome_campo_codigo . " FROM " . $nome_tabela_associativa . " WHERE " . $nome_campo_codigo. " = " . $linha_itens[$nome_campo_codigo] . " AND " . $nome_campo_associado . " = " . $linha[$nome_campo_associado];
              $rs_item_associado = mysql_query($sql2 , $conexao);
              $linha_item_associado = mysql_fetch_array($rs_item_associado);



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


              //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"
              if($sistema_exclusao==1)
              {

                if($linha_itens[$apelido]==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
                }
              }

?>

              <option value="<? echo $linha_itens[$nome_campo_codigo];  ?>"     <? if ($linha_itens[$nome_campo_codigo]==$linha_item_associado[$nome_campo_codigo]) { echo " selected "; } ?>><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select></td>



      </tr>
    </table>

<?

  }







  function select_3($descricao_campo,$nome_campo)
  {  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="80%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="20%">
          <select class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo; ?>">
            <option value="0">-</option>
            <option value="1">Sim</option>
            <option value="2" selected>Não</option>
          </select></td>
      </tr>
    </table>

<? 

  }






  function select_3_edit($descricao_campo,$nome_campo)
  {  

    global $linha;  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="80%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="20%">
          <select class="select" alt="<? echo $descricao_campo; ?>" name="<? echo $nome_campo; ?>">
            <option value="0"  <? if ($linha[$nome_campo]==0) { echo " selected "; } ?>>-</option>
            <option value="1"  <? if ($linha[$nome_campo]==1) { echo " selected "; } ?>>Sim</option>
            <option value="2"  <? if ($linha[$nome_campo]==2) { echo " selected "; } ?>>Não</option>
          </select></td>
      </tr>
    </table>

<? 

  }












?>