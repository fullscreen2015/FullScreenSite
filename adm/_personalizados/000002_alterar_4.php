<?php



    // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS AOS SISTEMAS


    $sql_delete = "DELETE FROM tabela_adm_ass_usuario_sistema_acesso WHERE codigo_usuario=" . $_REQUEST['codigo_usuario'];
    mysql_query($sql_delete, $conexao); 



    $sql = " SELECT tabela_adm_sistemas.codigo_sistema, descricao_sistema ";
    $sql.= " FROM tabela_adm_sistemas";
    $sql.= " WHERE publicar=1";

    $rs_sistemas = mysql_query($sql, $conexao);
    $rows_sistemas = mysql_num_rows($rs_sistemas);

          $sql = " SELECT MAX(codigo_associativo) as codigo_associativo ";
          $sql.= " FROM tabela_adm_ass_usuario_sistema_acesso";
          //$sql.= " ORDER BY codigo_associativo DESC LIMIT 1";

          $rs_novo_codigo = mysql_query($sql, $conexao);
          $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
          $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;



          $sql = " INSERT INTO tabela_adm_ass_usuario_sistema_acesso ";
          $sql.= " (codigo_associativo,codigo_usuario,codigo_sistema,codigo_tipo) VALUES ";

          $sql_value = "";

          $xy = 0;

    while($linha_sistema=mysql_fetch_array($rs_sistemas))
    {

      $nome_do_campo = "sistema_" . $linha_sistema['codigo_sistema'];



      if(ISSET($_REQUEST[$nome_do_campo]))
      {
        $valores = implode(":",$_REQUEST[$nome_do_campo]);
        $array_valores = explode(":",$valores);

         if($sql_value!="")
            {
              $sql_value .=" , ";
            }

        for ($i=0;$i<count($_REQUEST[$nome_do_campo]);$i++)
        {
          
          $sql_value.= " (";
          $sql_value.= "'" . $novo_codigo++ . "',";
          $sql_value.= "'" . $_REQUEST['codigo_usuario'] . "',";
          $sql_value.= "'" . $linha_sistema['codigo_sistema'] . "',";
          $sql_value.= "'" . $_REQUEST[$nome_do_campo][$i] . "'";
          $sql_value.= ")";


              if($i+1!=count($_REQUEST[$nome_do_campo]))
              {

              $sql_value.= ",";

              }

        }

/*if($xy+1!=$rows_sistemas)
            {

            $sql.= ",b".$xy."-".$rows_sistemas;

            }*/

      }

            


$xy++;

    }
$sql .= $sql_value;

       
      mysql_query($sql, $conexao);
      $sql_value ="";

//exit();

    // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS PARA OS RELAT�RIOS


    $sql_delete = "DELETE FROM tabela_adm_ass_usuario_relatorio WHERE codigo_usuario=" . $_REQUEST['codigo_usuario'];
    mysql_query($sql_delete, $conexao); 


    if(ISSET($_REQUEST['codigo_relatorio']))
    {   

        $sql = " SELECT MAX(codigo_associativo) as codigo_associativo ";
        $sql.= " FROM tabela_adm_ass_usuario_relatorio";
        //$sql.= " ORDER BY codigo_associativo DESC LIMIT 1";

        $rs_novo_codigo = mysql_query($sql, $conexao);
        $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
        $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;


        $sql = " INSERT INTO tabela_adm_ass_usuario_relatorio";
        $sql.= " (codigo_associativo,codigo_usuario,codigo_relatorio) VALUES ";

      for ($i=0;$i<count($_REQUEST['codigo_relatorio']);$i++)
      {
        
        $sql.= " (";
        $sql.= "'" . $novo_codigo++ . "',";
        $sql.= "'" . $_REQUEST['codigo_usuario'] . "',";
        $sql.= "'" . $_REQUEST['codigo_relatorio'][$i] . "'";
        $sql.= ")";
        
         if($i+1!=count($_REQUEST['codigo_relatorio']))
        {

        $sql.= ",";

        }


      }

     
      mysql_query($sql, $conexao);

    }







    // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS PARA OS GR�FICOS


    $sql_delete = "DELETE FROM tabela_adm_ass_usuario_grafico WHERE codigo_usuario=" . $_REQUEST['codigo_usuario'];
    mysql_query($sql_delete, $conexao); 


    if(ISSET($_REQUEST['codigo_grafico']))
    {   

        $sql = " SELECT MAX(codigo_associativo) as codigo_associativo ";
        $sql.= " FROM tabela_adm_ass_usuario_grafico";
        //$sql.= " ORDER BY codigo_associativo DESC LIMIT 1";

        $rs_novo_codigo = mysql_query($sql, $conexao);
        $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
        $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;


        $sql = " INSERT INTO tabela_adm_ass_usuario_grafico";
        $sql.= " (codigo_associativo,codigo_usuario,codigo_grafico) VALUES ";

      for ($i=0;$i<count($_REQUEST['codigo_grafico']);$i++)
      {
        
        $sql.= " (";
        $sql.= "'" . $novo_codigo++ . "',";
        $sql.= "'" . $_REQUEST['codigo_usuario'] . "',";
        $sql.= "'" . $_REQUEST['codigo_grafico'][$i] . "'";
        $sql.= ")";

        
        if($i+1!=count($_REQUEST['codigo_grafico']))
        {

        $sql.= ",";

        }


       


      }

      mysql_query($sql, $conexao); 

    }





  // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS PARA OS GR�FICOS


    $sql_delete = "DELETE FROM tabela_adm_ass_usuario_painel WHERE codigo_usuario=" . $_REQUEST['codigo_usuario'];
    mysql_query($sql_delete, $conexao); 


    if(ISSET($_REQUEST['codigo_painel']))
    {   

        $sql = " SELECT MAX(codigo_associativo) as codigo_associativo";
        $sql.= " FROM tabela_adm_ass_usuario_painel";
        //$sql.= " ORDER BY codigo_associativo DESC LIMIT 1";

        $rs_novo_codigo = mysql_query($sql, $conexao);
        $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
        $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;

        $sql = " INSERT INTO tabela_adm_ass_usuario_painel";
        $sql.= " (codigo_associativo,codigo_usuario,codigo_painel) VALUES ";

      for ($i=0;$i<count($_REQUEST['codigo_painel']);$i++)
      {
        
        
        $sql.= "(";
        $sql.= "'" . $novo_codigo++ . "',";
        $sql.= "'" . $_REQUEST['codigo_usuario'] . "',";
        $sql.= "'" . $_REQUEST['codigo_painel'][$i] . "'";
        $sql.= ")";

        if($i+1!=count($_REQUEST['codigo_painel']))
        {

        $sql.= ",";

        }


      }   
      
      mysql_query($sql, $conexao);
    }





?>