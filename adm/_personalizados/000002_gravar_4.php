<?php

    // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS


    $sql = " SELECT tabela_adm_sistemas.codigo_sistema, descricao_sistema ";
    $sql.= " FROM tabela_adm_sistemas";
    $sql.= " WHERE publicar=1";



    $rs_sistemas = mysql_query($sql, $conexao);
    $linhas_sistemas = mysql_num_rows($rs_sistemas);

    //echo $linhas_sistemas;

    $sql = " SELECT MAX(codigo_associativo) as codigo_associativo";
                      $sql.= " FROM tabela_adm_ass_usuario_sistema_acesso";
                     // $sql.= " ORDER BY codigo_associativo DESC LIMIT 1";
                      $rs_novo_codigo = mysql_query($sql, $conexao);
                      $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
                      $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;

          $sql = " INSERT INTO tabela_adm_ass_usuario_sistema_acesso ";
          $sql.= " (codigo_associativo,codigo_usuario,codigo_sistema,codigo_tipo) VALUES ";

          $xy = 0;
    while($linha_sistema=mysql_fetch_array($rs_sistemas))
    {

      $nome_do_campo = "sistema_" . $linha_sistema['codigo_sistema'];

      if(ISSET($_REQUEST[$nome_do_campo]))
      {
        $valores = implode(":",$_REQUEST[$nome_do_campo]);
        $array_valores = explode(":",$valores);

                      

        for ($i=0;$i<count($_REQUEST[$nome_do_campo]);$i++)
        {
          

          $sql.= "(";
          $sql.= "'" . $novo_codigo++ . "',";
          $sql.= "'" . $$chave_primaria . "',";
          $sql.= "'" . $linha_sistema['codigo_sistema'] . "',";
          $sql.= "'" . $_REQUEST[$nome_do_campo][$i] . "'";
          $sql.= ")";
        
          if($i+1!=count($_REQUEST[$nome_do_campo]))
          {

          $sql.= ",";

          }
          

        }
        
      }
//echo $xy."<br>";
if($xy+1!=$linhas_sistemas)
          {

          $sql.= ",";

          }


$xy++;
    }

    
    
      mysql_query($sql, $conexao); 






    // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS PARA OS RELAT�RIOS


    if(ISSET($_REQUEST['codigo_relatorio']))
    {
                $sql = " SELECT MAX(codigo_associativo) as codigo_associativo";
                $sql.= " FROM tabela_adm_ass_usuario_relatorio";
                // $sql.= " ORDER BY codigo_associativo DESC LIMIT 1";
                $rs_novo_codigo = mysql_query($sql, $conexao);
                $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
                $novo_codigo = $linha_novo_codigo['codigo_associativo']+1;

                $sql = " INSERT INTO tabela_adm_ass_usuario_relatorio";
                $sql.= " (codigo_associativo,codigo_usuario,codigo_relatorio) VALUES ";


      for ($i=0;$i<count($_REQUEST['codigo_relatorio']);$i++)
      {
        
        $sql.= " (";
        $sql.= "'" . $novo_codigo++ . "',";
        $sql.= "'" . $$chave_primaria . "',";
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


    if(ISSET($_REQUEST['codigo_grafico']))
    {
                $sql = " SELECT MAX(codigo_associativo) as codigo_associativo";
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
        $sql.= "'" . $$chave_primaria . "',";
        $sql.= "'" . $_REQUEST['codigo_grafico'][$i] . "'";
        $sql.= ") ";
        
        if($i+1!=count($_REQUEST['codigo_grafico']))
        {

        $sql.= ",";

        }


      } 
        mysql_query($sql, $conexao); 
    }







  // GRAVANDO NA TABELA ASSOCIATIVA AS PERMISS�ES DOS usuárioS PARA OS PAINEIS


  
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
        $sql.= "'" . $$chave_primaria . "',";
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