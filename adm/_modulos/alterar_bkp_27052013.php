<?php

  session_start(); 
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_protecao.php"); 
    include("../../include/sistema_zeros.php"); 
  
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
    include("../_configuracoes/" . $codigo_modulo6 . ".php"); 


    $mostrar_editar=true;
    // verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
    if((isset($campo_usuario))&&($campo_usuario!=""))
    {
      if((isset($tipo_permissao_usuario))&&(($tipo_permissao_usuario==1)||($tipo_permissao_usuario==2)||($tipo_permissao_usuario==4)))
      {
        $sql_verificacao = " SELECT " . $campo_usuario;
        $sql_verificacao.= " FROM " . $tabela;
        $sql_verificacao.= " WHERE " . $chave_primaria . "=" . anti_injection($_REQUEST[$chave_primaria]);
        $rs_verificacao = mysql_query($sql_verificacao);

        $linha_verificacao = mysql_fetch_array($rs_verificacao);

        if($linha_verificacao[$campo_usuario]!=$_SESSION['fw_codigo_usuario'])
        {
          // caso este registro não tenha sido feito pelo usuário logado, o link "excluir" não deve ser exibido.
          $mostrar_editar=false;
        }
      }
    }




  include("../_include/usuarios_acesso.php");

  $permissao = 5;

  if((verifica_usuario2($codigo_modulo, $permissao))&&($mostrar_editar==true))
  {
  
    include("../_include/funcao_prepara_campos.php");

    // Arquivo Personalizado 1 - Antes do Loop de Campos
    // Arquivo Personalizado 2 - Dentro do Loop de Campos
    // Arquivo Personalizado 3 - Após o Loop de Campos e Antes do Update
    // Arquivo Personalizado 4 - Após o Update no Banco
  
    $ap1 = "../_personalizados/" . $codigo_modulo6 . "_alterar_1.php";
    $ap2 = "../_personalizados/" . $codigo_modulo6 . "_alterar_2.php";
    $ap3 = "../_personalizados/" . $codigo_modulo6 . "_alterar_3.php";
    $ap4 = "../_personalizados/" . $codigo_modulo6 . "_alterar_4.php";
    
    if(file_exists($ap1))
    {
      include($ap1);
    }
    
    
    



    // ALTERANDO VALORES DO SISTEMA PRINCIPAL

    $sql="";

    $j=0;
    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont13 = $cont_ . "13";

      if(($campos[$cont3]!="chave_primaria")&&($campos[$cont3]!="usuario"))
      {
        
        switch ($campos[$cont3]) 
        {

          case "logico":

            if(ISSET($_REQUEST[$campos[$cont1]]))
            {
              $valor_campo = 1;
            }
            else
            {
              $valor_campo = 0;
            }

            break;
      
          case "senha_criptografada":           

            if($_REQUEST[$campos[$cont1]]!="")
            {
              $valor_campo = md5($_REQUEST[$campos[$cont1]]);
            }
            else
            {
              $valor_campo = ""; 
            }

            break;
  



          case "data_int":

            $campo_ano = $campos[$cont1] . "_ano";
            $valor_ano = $_REQUEST[$campo_ano];
            $valor_ano = zerosaesquerda($valor_ano,4);  

            $campo_mes = $campos[$cont1] . "_mes";
            $valor_mes = $_REQUEST[$campo_mes];
            $valor_mes = zerosaesquerda($valor_mes,2);  

            $campo_dia = $campos[$cont1] . "_dia";
            $valor_dia = $_REQUEST[$campo_dia];
            $valor_dia = zerosaesquerda($valor_dia,2);  

            $valor_campo = $valor_ano.$valor_mes.$valor_dia;

            break;


          case "data_int_now":

            $campo_ano = $campos[$cont1] . "_ano";
            $valor_ano = $_REQUEST[$campo_ano];
            $valor_ano = zerosaesquerda($valor_ano,4);  

            $campo_mes = $campos[$cont1] . "_mes";
            $valor_mes = $_REQUEST[$campo_mes];
            $valor_mes = zerosaesquerda($valor_mes,2);  

            $campo_dia = $campos[$cont1] . "_dia";
            $valor_dia = $_REQUEST[$campo_dia];
            $valor_dia = zerosaesquerda($valor_dia,2);  

            $valor_campo = $valor_ano.$valor_mes.$valor_dia;
            break;


          case "hora":

            $campo_hora = $campos[$cont1] . "_hora";
            $valor_hora = $_REQUEST[$campo_hora];
            $valor_hora = zerosaesquerda($valor_hora,2);  

            $campo_minuto = $campos[$cont1] . "_minuto";
            $valor_minuto = $_REQUEST[$campo_minuto];
            $valor_minuto = zerosaesquerda($valor_minuto,2);  

            $campo_segundo = $campos[$cont1] . "_segundo";
            $valor_segundo = $_REQUEST[$campo_segundo];
            $valor_segundo = zerosaesquerda($valor_segundo,2);  

            $valor_campo = $valor_hora.$valor_minuto.$valor_segundo;

            break;


          case "hora_now":

            $campo_hora = $campos[$cont1] . "_hora";
            $valor_hora = $_REQUEST[$campo_hora];
            $valor_hora = zerosaesquerda($valor_hora,2);  

            $campo_minuto = $campos[$cont1] . "_minuto";
            $valor_minuto = $_REQUEST[$campo_minuto];
            $valor_minuto = zerosaesquerda($valor_minuto,2);  

            $campo_segundo = $campos[$cont1] . "_segundo";
            $valor_segundo = $_REQUEST[$campo_segundo];
            $valor_segundo = zerosaesquerda($valor_segundo,2);  

            $valor_campo = $valor_hora.$valor_minuto.$valor_segundo;

            break;


          case "data_date":

            $campo_ano = $campos[$cont1] . "_ano";
            $valor_ano = $_REQUEST[$campo_ano];
            $valor_ano = zerosaesquerda($valor_ano,4);  

            $campo_mes = $campos[$cont1] . "_mes";
            $valor_mes = $_REQUEST[$campo_mes];
            $valor_mes = zerosaesquerda($valor_mes,2);  

            $campo_dia = $campos[$cont1] . "_dia";
            $valor_dia = $_REQUEST[$campo_dia];
            $valor_dia = zerosaesquerda($valor_dia,2);  

            $valor_campo = $valor_ano."-".$valor_mes."-".$valor_dia;

            break;


          case "data_hora":

            $campo_ano = $campos[$cont1] . "_ano";
            $valor_ano = $_REQUEST[$campo_ano];
            $valor_ano = zerosaesquerda($valor_ano,4);  

            $campo_mes = $campos[$cont1] . "_mes";
            $valor_mes = $_REQUEST[$campo_mes];
            $valor_mes = zerosaesquerda($valor_mes,2);  

            $campo_dia = $campos[$cont1] . "_dia";
            $valor_dia = $_REQUEST[$campo_dia];
            $valor_dia = zerosaesquerda($valor_dia,2);  

      
            $campo_hora = $campos[$cont1] . "_hora";
            $valor_hora = $_REQUEST[$campo_hora];
            $valor_hora = zerosaesquerda($valor_hora,2);  

            $campo_min = $campos[$cont1] . "_min";
            $valor_min = $_REQUEST[$campo_min];
            $valor_min = zerosaesquerda($valor_min,2);  

            $campo_seg = $campos[$cont1] . "_seg";
            $valor_seg = $_REQUEST[$campo_seg];
            $valor_seg = zerosaesquerda($valor_seg,2);  


            $valor_campo = $valor_ano.$valor_mes.$valor_dia.$valor_hora.$valor_min.$valor_seg;

            break;






          case "data_date_now":

            $campo_ano = $campos[$cont1] . "_ano";
            $valor_ano = $_REQUEST[$campo_ano];
            $valor_ano = zerosaesquerda($valor_ano,4);  

            $campo_mes = $campos[$cont1] . "_mes";
            $valor_mes = $_REQUEST[$campo_mes];
            $valor_mes = zerosaesquerda($valor_mes,2);  

            $campo_dia = $campos[$cont1] . "_dia";
            $valor_dia = $_REQUEST[$campo_dia];
            $valor_dia = zerosaesquerda($valor_dia,2);  

            $valor_campo = $valor_ano."-".$valor_mes."-".$valor_dia;

            break;


          default:

            $valor_campo = $_REQUEST[$campos[$cont1]];

        }

        // esta variável altera_este_campo foi criada para
        // guardar o valor true ou false que permite
        // ou não que este campo seja inserido no SQL de altera��o
        
        $altera_este_campo=true;

        
        if(isset($campos[$cont13]))
        {
          $permissao_do_campo = $campos[$cont13];
        }
        else
        {
          $permissao_do_campo = "";
        }


        // aqui iremos testar o item 13 do campo em quest�o
        // caso o valor seja 1, ningu�m pode alterar este valor.
        if($permissao_do_campo==1)
        {
          $altera_este_campo=false;
        }       

        // caso o valor seja 2, � necessário verificar se o registro foi criado pelo usuário que est� logado 
        if($permissao_do_campo==2)
        {

          if((isset($campo_usuario))&&($campo_usuario!=""))
          {
            $sql_verificacao = " SELECT " . $campo_usuario;
            $sql_verificacao.= " FROM " . $tabela;
            $sql_verificacao.= " WHERE " . $chave_primaria . "=" . anti_injection($_REQUEST[$chave_primaria]);
            $rs_verificacao = mysql_query($sql_verificacao);

            $linha_verificacao = mysql_fetch_array($rs_verificacao);

            if($linha_verificacao[$campo_usuario]!=$_SESSION['fw_codigo_usuario'])
            {
              // caso este registro não tenha sido feito pelo usuário logado, o campo nao podeserá ser alterado.
              $altera_este_campo=false;
            }

          }

        }



        if($campos[$cont3]=="senha_criptografada")
        {
          if($valor_campo=="")
          {
            $altera_este_campo=false;
          }

        }

        

        

        if($altera_este_campo==true)
        {
          $j++;
          if($j>1)        
          {
            $sql = $sql . " , ";
          }

          $sql = $sql . $campos[$cont1] . "=" . "'" . prepara_campo($valor_campo,$campos[$cont3]) . "'";

        }

      }


      if(file_exists($ap2))
      {
        include($ap2);
      }

    }


    if(file_exists($ap3))
    {
      include($ap3);
    }



    $sql = "UPDATE " . $tabela . " SET " . $sql . " WHERE " . $chave_primaria . "=" . $_REQUEST[$chave_primaria]; 

    mysql_query($sql, $conexao); 
    




    // ALTERANDO VALORES DOS CAMPOS ASSOCIATIVOS

    for($conta=1;$conta<=$numero_campos_associativos;$conta++)
    {
      $conta_ = (10 + $conta);
      $conta1 = $conta_ . "1";
      $conta2 = $conta_ . "2";
      $conta3 = $conta_ . "3";
      $conta4 = $conta_ . "4";
      $conta5 = $conta_ . "5";
      $conta6 = $conta_ . "6";
      $conta7 = $conta_ . "7";
      $conta8 = $conta_ . "8";
      $conta9 = $conta_ . "9";
      $conta91 = $conta_ . "91";



      $sql_delete = "DELETE FROM " . $campos_associativos[$conta8] . " WHERE " . $campos_associativos[$conta9] . "=" . $_REQUEST[$campos_associativos[$conta9]];
      mysql_query($sql_delete, $conexao);




      if(ISSET($_REQUEST[$campos_associativos[$conta5]]))
      {
        $valores = implode(":",$_REQUEST[$campos_associativos[$conta5]]);
        $array_valores = explode(":",$valores);


          $sql_busca_ultimo = " SELECT   MAX($campos_associativos[$conta91]) as codigo_tabela_associativos FROM " . $campos_associativos[$conta8];
          $rs_novo_registro = mysql_query($sql_busca_ultimo, $conexao);
          $linha_novo_registro = mysql_fetch_array($rs_novo_registro);
          $codigo_novo_registro = $linha_novo_registro["codigo_tabela_associativos"]+1;


          //$nome_do_campo = $campos_associativos[$conta5] . "[" . $i . "]";

          //$sql_gravar = "INSERT INTO " . $campos_associativos[$conta8] . " (".$campos_associativos[$conta91].",".$campos_associativos[$conta9].",".$campos_associativos[$conta5].") VALUES (". $codigo_novo_registro . "," . $_REQUEST[$campos_associativos[$conta9]] . ", " . $array_valores[$i] . ")" ; 
          $sql_gravar = "INSERT INTO " . $campos_associativos[$conta8] . " (".$campos_associativos[$conta91].",".$campos_associativos[$conta9].",".$campos_associativos[$conta5].") VALUES ";

          $linha_associativo = 1;




        for ($i=0;$i<count($_REQUEST[$campos_associativos[$conta1]]);$i++)
        {

         
////////////////////////////

             $sql_gravar .= "('". $codigo_novo_registro++ . "','" . $_REQUEST[$campos_associativos[$conta9]] . "','" . $array_valores[$i] . "')" ; 

          if(count($_REQUEST[$campos_associativos[$conta1]])!=$linha_associativo){

            $sql_gravar .= ",";

          }


          $linha_associativo++;

         
        }

       

        mysql_query($sql_gravar, $conexao); 
    

      }



    }























    // CAMPOS INTERLA�ADOS - GRAVANDO ######################################################################


    for($x=1;$x<=$numero_campos_interlacados;$x++)
    {
      $inter_ = (10 + $x);
      $inter1 = $inter_ . "1";
      $inter2 = $inter_ . "2";
      $inter3 = $inter_ . "3";
      $inter4 = $inter_ . "4";
      $inter5 = $inter_ . "5";
      $inter6 = $inter_ . "6";
      $inter7 = $inter_ . "7";
      $inter8 = $inter_ . "8";
      $inter9 = $inter_ . "9";
      $inter10 = $inter_ . "10";
      $inter11 = $inter_ . "11";
      $inter12 = $inter_ . "12";


      $sql = "DELETE FROM " . $campos_interlacados[$inter9] . " WHERE " . $campos_interlacados[$inter11] . "=" . $_REQUEST[$chave_primaria];

      mysql_query($sql, $conexao); 


      if(ISSET($_POST[$campos_interlacados[$inter6]]))
      {
        foreach($_POST[$campos_interlacados[$inter6]] as $valor_interlacado)
        {
          if($valor_interlacado!="")
          {
            $sql_busca_ultimo = "SELECT " . $campos_interlacados[$inter10] . " FROM " . $campos_interlacados[$inter9] . " ORDER BY " . $campos_interlacados[$inter10] . " DESC LIMIT 1";

            $rs_novo_registro = mysql_query($sql_busca_ultimo, $conexao);
            $linha_novo_registro = mysql_fetch_array($rs_novo_registro);
            $codigo_novo_registro = $linha_novo_registro[$campos_interlacados[$inter10]]+1;

            $sql = " INSERT INTO " . $campos_interlacados[$inter9];
            $sql.= " (".$campos_interlacados[$inter10].",".$campos_interlacados[$inter11].",".$campos_interlacados[$inter12].")";
            $sql.= " VALUES (". $codigo_novo_registro . "," . $_REQUEST[$chave_primaria] . "," . $valor_interlacado . ")" ; 

            mysql_query($sql, $conexao); 
          }
        }
      }





    }

    // FIM CAMPOS INTERLA�ADOS - GRAVANDO ######################################################################

















  // SISTEMAS RELACIONADOS ##################################################




  
  // �rea de atualiza��o
  // Arquivo Personalizado Relacionado 1 - Antes do Loop de Campos
  // Arquivo Personalizado Relacionado 2 - Dentro do Loop de Campos, antes do UPDATE
  // Arquivo Personalizado Relacionado 3 - Dentro do Loop de Campos, Dentro do Loop de Atributos, antes do Update
  // Arquivo Personalizado Relacionado 4 - Dentro do Loop de Campos, ap�s o do UPDATE
  // Arquivo Personalizado Relacionado 5 - Depois do Loop de Campos

  // �rea de grava��o
  // Arquivo Personalizado Relacionado 6 - Dentro de Loop de Montagem do SQL
  // Arquivo Personalizado Relacionado 7 - Dentro de Loop de Campos e Antes do Insert no Banco
  // Arquivo Personalizado Relacionado 8 - Dentro do Foreach e antes do Insert no Banco
  // Arquivo Personalizado Relacionado 9 - Dentro do Foreach e Após o Insert no Banco

  $apr1 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_1.php";
  $apr2 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_2.php";
  $apr3 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_3.php";
  $apr4 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_4.php";
  $apr5 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_5.php";
  $apr6 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_6.php";
  $apr7 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_7.php";
  $apr8 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_8.php";
  $apr9 = "../_personalizados/" . $codigo_modulo6 . "_alterar_relacionado_9.php";

            

  
  // preservando vari�veis do sistema original

  $chave_primaria_original = $chave_primaria;




  $num_sistemas_relacionados_deste = $numero_sistemas_relacionados;

  for($z=1;$z<=$num_sistemas_relacionados_deste;$z++)
  {
    $sistema_relacionado_deste[$z] = $sistema_relacionado[$z];
  }



  // Importando configurações do sistema relacionado

  for($y=1;$y<=$num_sistemas_relacionados_deste;$y++)
  {



    

  include("../_configuracoes/" . zerosaesquerda($sistema_relacionado_deste[$y],6) . ".php");
    

    $tabela_relacionado = $tabela;
    $chave_primaria_relacionado = $chave_primaria;
    $descricao_principal_relacionado = $descricao_principal;
    $sistema_exclusao_relacionado = $sistema_exclusao;

    $numero_campos_relacionados = $numero_campos;

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";
      $cont7 = $cont_ . "7";
      $cont8 = $cont_ . "8";
      $cont9 = $cont_ . "9";

      $campo_relacionado[$cont1] = $campos[$cont1];
      $campo_relacionado[$cont2] = $campos[$cont2];
      $campo_relacionado[$cont3] = $campos[$cont3];
      $campo_relacionado[$cont4] = $campos[$cont4];
      $campo_relacionado[$cont5] = $campos[$cont5];
      $campo_relacionado[$cont6] = $campos[$cont6];
      $campo_relacionado[$cont7] = $campos[$cont7];
      $campo_relacionado[$cont8] = $campos[$cont8];
      $campo_relacionado[$cont9] = $campos[$cont9];
    }



  if(file_exists($apr1))
  {
    include($apr1);
  }



    /* =================== ATUALIZA DADOS RELACIONADOS ================================================== */
    
    $sql_update = " UPDATE " . $tabela_relacionado . " SET "; ////UPDATE RELACIONADOS SQL UNICA
  
    


 $sql_case = "";
    
    for($x=1;$x<=$numero_campos_relacionados;$x++)
    {
      $x_ = (10 + $x);
      $x1 = $x_ . "1";
      $x2 = $x_ . "2";
      $x3 = $x_ . "3";
      $x4 = $x_ . "4";
      $x5 = $x_ . "5";
      $x6 = $x_ . "6";
      $x7 = $x_ . "7";
      $x8 = $x_ . "8";

 $linha_update = 1;


      if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
      {

  
        $campo_relacionado_atual = $campo_relacionado[$x1];

        $sql_atributo = array();
        $sql_codigo = array();

        $nome_form_campo_relacionado_atual = $campo_relacionado_atual."_rel";


        if(isset($_POST[$nome_form_campo_relacionado_atual]))
        {
          
         
$linha_update++;


          $i = 0;


          $count_linha = count($_POST[$nome_form_campo_relacionado_atual]);//aqui tem o o numero de camposa ser inererido."<br><br>";

          

          foreach($_POST[$nome_form_campo_relacionado_atual] as $valor)
          {


            // Campos do tipo DATA seráo problem�ticos pois s�o separados por dia, m�s e ano
            // Temos que resolver isso mais pra frente

         
            $valor_campo = $valor;

            $valor_campo = prepara_campo($valor_campo,$campo_relacionado[$x3]);

            $sql_atributo[$i] = $valor_campo;
            $i++;

          }

        }





        if(isset($_POST[$chave_primaria_relacionado]))
        {
          $i = 0;
          foreach($_POST[$chave_primaria_relacionado] as $codigo_ass)
          {
            $sql_codigo[$i] = $codigo_ass;
            $i++;
          }
        }


        if(file_exists($apr2))
        {
          include($apr2);
        }


        $i = 0;
        
       /////UPDATE NOVO///////////////////////////////////////////////////////////////////////////////////////////////////////

       $arrayCampos[] = $campo_relacionado_atual;

     

       if($sql_case!=""){

          $sql_case .=" , ";

       }



        $sql_case .= $campo_relacionado_atual ." = CASE ".$chave_primaria_relacionado;
      
        
        foreach($sql_atributo as $atributo)
        {


              if(file_exists($apr3))
              {
                include($apr3);
              }


           if($sql_codigo[$i] !=""){
          $codigos_array[$i] = $sql_codigo[$i];

            $atributos_valores[] = $atributo;

         $sql_case .=" WHEN  '".$sql_codigo[$i]."'  THEN  '".$atributo."'  ";

      

          $i++;

          }

        }
        

          $sql_case .=" END ";

       
/////UPDATE VELHO//////////////////////////////////////////////////////////////////////////////////////////////////////
       /* foreach($sql_atributo as $atributo)
        {
          $sql = " UPDATE " . $tabela_relacionado;
          $sql.= " SET " . $campo_relacionado_atual . " = '" . $atributo . "'";
          $sql.= " WHERE " . $chave_primaria_relacionado . "='" . $sql_codigo[$i] . "'";

          $i++;


                mysql_query($sql,$conexao)or die(mysql_error());
        }*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        if(file_exists($apr4))
        {
          include($apr4);
        }


        
      }
  
 
        
    }

    
     
   
    if(array_sum($atributos_valores) >0){
    $sql_update.=$sql_case;
    $sql_update .= " WHERE ".$chave_primaria_relacionado." IN ("; //IMPORTANTE CONDI��O * SE HOUVER ERRO O UPDATE APAGA TODOS OS CAMPOS SETADOS*

    

      for($c=0; $c<count($codigos_array); $c++){

        $sql_update .= "".$codigos_array[$c]. "";
        if($c+1 !=count($codigos_array)){
          $sql_update .= ",";
          
        }

      }
      

    $sql_update .= ") ";
    

   

    mysql_query($sql_update, $conexao)or die(mysql_error());
    $sql_case ="";

    //SQL UPDATE UNICA RELACIONADOS
    }
    $atributos_valores = array();
    



    if(file_exists($apr5))
    {
      include($apr5);
    }
  

    /* ================================ FIM ATUALIZA DADOS RELACIONADOS ============================================ */





    /* ========= GRAVA NOVOS DADOS RELACIONADOS ====== */

    $campos_relacionados_para_sql = "";

    $sql_atributo_novo = array();


    $i = 0;
    $sql_atributo_novo[$i] = "";


    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";

      $i = 0;
      $valor_relacionado="";
      $nome_do_campo_relacionado = $campos[$cont1] . "_novo";

      if(ISSET($_POST[$nome_do_campo_relacionado]))
      {

        foreach($_POST[$nome_do_campo_relacionado] as $valor_relacionado)
        {

           if(file_exists($apr6))
        {
          include($apr6);
        }
      
          if($valor_relacionado!="")
          {

            switch ($campos[$cont3]) 
            {

              case "logico":

                if($valor_relacionado)
                {
                  $valor_relacionado = 1;
                }
                else
                {
                  $valor_relacionado = 0;
                }

                break;

  
              default:

                $valor_relacionado = $valor_relacionado;
            }

            $valor_relacionado = prepara_campo($valor_relacionado,$campos[$cont3]);


            $campos_relacionados_para_sql .= "," . $campos[$cont1];
  
            if($sql_atributo_novo[$i]!="")
            {
              $sql_atributo_novo[$i].= "','" ;
            }
            $sql_atributo_novo[$i].= $valor_relacionado;

            $i++;
          }
        }
      }
    }





    // caso exista sistema de exclusão no sistema relacionado, adiciona o campo "ativo" no SQL


    if($sistema_exclusao_relacionado==1)
    {

      if($campos_relacionados_para_sql!="")
      {
        $campos_relacionados_para_sql.=",";
      }
      $campos_relacionados_para_sql.="ativo";
    }


    if(file_exists($apr7))
    {
      include($apr7);
    }

  




    $atributo_novo="";

   
  

// PEGA NOVO C�DIGO
                  $sql = "SELECT MAX($chave_primaria_relacionado) as codigo_tabela_relacionado FROM " . $tabela_relacionado;
                  $rs_novo_codigo = mysql_query($sql,$conexao)or die (mysql_error());
                  $linha_novo_codigo = mysql_fetch_array($rs_novo_codigo);
                  $novo_id = $linha_novo_codigo["codigo_tabela_relacionado"]+1;

            
                  if($sql_atributo_novo[0]!=""){   
                  $sql_relacionado = " INSERT INTO " . $tabela_relacionado . "(" . $chave_primaria_relacionado . "," .$chave_primaria_original.$campos_relacionados_para_sql.")";
                  $sql_relacionado .= " VALUES (";
                  }

                  $linhas = 1;

    foreach($sql_atributo_novo as $atributo_novo)
    {
      
      if(file_exists($apr8))
      {
        include($apr8);
      }


      if($atributo_novo!="")
      {

                      // caso exista sistema de exclusão no sistema relacionado, adiciona o valor "1" para o campo "ativo" no SQL
                      if($sistema_exclusao_relacionado==1)
                      {
                        $atributo_novo.="','1";
                      }
         

          
          $sql_relacionado.= "'" . $novo_id++. "','" . $_REQUEST[$chave_primaria_original] . "' , ";

          $sql_relacionado.=  " '".$atributo_novo . "') ";

          if(count($sql_atributo_novo)!=$linhas)
          {

          $sql_relacionado.= ", (";

          }
        

      }
    }



      if($sql_atributo_novo[0]!=""){ 
      mysql_query($sql_relacionado,$conexao)or die(mysql_error());
      }


    if(file_exists($apr9))
    {
      include($apr9);
    }

  }



  /* ========= FIM GRAVA NOVOS DADOS RELACIONADOS ====== */




  // FIM SISTEMAS RELACIONADOS ##################################################







  //exit();






  if(file_exists($ap4))
  {
    include($ap4);
  }




  // LOG  

  $acao = "Altera��o do registro com c�digo " . $_REQUEST[$chave_primaria_original] ;


  // Descobrindo qual � o sistema atual

  $sql = "SELECT * FROM tabela_adm_sistemas WHERE codigo_sistema='" . $codigo_modulo . "'";
  $rs_sistema = mysql_query($sql,$conexao) or die("Erro na consulta do sistema!");
  $linha_sistema = mysql_fetch_array($rs_sistema);

  // Descobrindo qual � o nome do usuário

  $sql = "SELECT * FROM tabela_adm_usuarios WHERE email_usuario='" . $_SESSION['login_result'] . "'";
  $rs_usuario = mysql_query($sql, $conexao);
  $linha_usuario = mysql_fetch_array($rs_usuario) or die("Erro na consulta do usuário!");

  // Gravando LOG no banco de dados

  $sql = " INSERT INTO tabela_adm_log ";
  $sql.= " (usuario_log, acao_log, sistema_log, data_log) ";
  $sql.= " VALUES ('" . $linha_usuario['nome_usuario'] . " (login: " . $_SESSION['login_result'] . ")" . "' ,'" . $acao . "','" . $linha_sistema['descricao_sistema'] . "','" . date('d/m/Y - H:i:s') . "')";

  mysql_query($sql,$conexao);


    
    if(isset($_POST['adicionar']))
    {
      if((trim($_POST['adicionar']))=="+")//LOCATION já COM ANCORA PARA OS SISTEMAS RELACIONADOS
      {
        header("Location: editar_dados.php?codigo_modulo=" . $codigo_modulo . "&".$chave_primaria_original."=" . $_REQUEST[$chave_primaria_original] . "&pagina=" . $_REQUEST['pagina']."#".$_POST["ancora"]);  //RECEBE A ANCORA
      }
      else
      {
        header("Location: " . urldecode($_REQUEST['url']));  

      }
    }
    else
    {
      header("Location: painel.php?pagina=" . $_REQUEST['pagina']);  
      header("Location: " . urldecode($_REQUEST['url']));  

    }


  }
  else
  {
    header("Location: " . $_SERVER['HTTP_REFERER']);  
  }









  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }




?>