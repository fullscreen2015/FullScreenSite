<?php

ob_start();
session_start(); 

if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
{

  include("../../include/sistema_conexao.php"); 
	include("../../include/sistema_zeros.php"); 
	include("../../include/sistema_protecao.php"); 
	include("../_include/usuarios_acesso.php");
	
	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
 	$codigo_modulo6 = zerosaesquerda($codigo_modulo,6);


	$permissao = 3;

	if(verifica_usuario2($codigo_modulo, $permissao))
	{

		include("../_include/funcao_prepara_campos.php");



		include("../_configuracoes/" . $codigo_modulo6 . ".php"); 


		// Arquivo Personalizado 1 - Antes do Loop de Campos
		// Arquivo Personalizado 2 - Dentro do Loop de Campos
		// Arquivo Personalizado 3 - Após o Loop de Campos e Antes do Insert INTO
		// Arquivo Personalizado 4 - Após o Insert INTO no Banco, antes do log
    // Arquivo Personalizado 5 - Após o log, antes do redirecionameto. 

		$ap1 = "../_personalizados/" . $codigo_modulo6 . "_gravar_1.php";
		$ap2 = "../_personalizados/" . $codigo_modulo6 . "_gravar_2.php";
		$ap3 = "../_personalizados/" . $codigo_modulo6 . "_gravar_3.php";
		$ap4 = "../_personalizados/" . $codigo_modulo6 . "_gravar_4.php";
    $ap5 = "../_personalizados/" . $codigo_modulo6 . "_gravar_5.php";
		
		if(file_exists($ap1))
		{
			include($ap1);
		}
	
	





    $sql = "SELECT " . $chave_primaria ." FROM " . $tabela . " ORDER BY " . $chave_primaria . " DESC LIMIT 1";
  
    $rs_codigo = mysql_query($sql, $conexao);

    $row = mysql_fetch_array($rs_codigo);
    $$chave_primaria = $row[$chave_primaria]+1;





























    // SISTEMA NORMAL - GRAVANDO ######################################################################



    $numero_campos_gravar = 0;

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";
      $cont15 = $cont_ . "15";



      $gravar_este_campo = true;

      if(ISSET($campos[$cont15]))
      {
        if($campos[$cont15]=="1")
        {
          $gravar_este_campo = false;
        }
      }

      if($gravar_este_campo)
      {

        $numero_campos_gravar++;


        switch ($campos[$cont3]) 
        {

          case "chave_primaria":
            $campos_sql[$cont1] = $$chave_primaria;
            break;

          case "usuario":
            $campos_sql[$cont1] = $_SESSION['codigo_usuario'];
            break;

          case "senha_criptografada":   
  		      $campos_sql[$cont1] = md5($_REQUEST[$campos[$cont1]]);
            break;

          case "logico":

            if(ISSET($_REQUEST[$campos[$cont1]]))
            {
              $campos_sql[$cont1] = 1;
            }
            else
            {
              $campos_sql[$cont1] = 0;
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

            $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia;
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

            $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia;
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


            $campos_sql[$cont1] = $valor_ano.$valor_mes.$valor_dia.$valor_hora.$valor_min.$valor_seg;
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

            $campos_sql[$cont1] = $valor_hora.$valor_minuto.$valor_segundo;
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

            $campos_sql[$cont1] = $valor_hora.$valor_minuto.$valor_segundo;
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


            $campos_sql[$cont1] = $valor_ano."-".$valor_mes."-".$valor_dia;


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


            $campos_sql[$cont1] = $valor_ano."-".$valor_mes."-".$valor_dia;


            break;




          default:

            $campos_sql[$cont1] = $_REQUEST[$campos[$cont1]];

        }

      }


    	if(file_exists($ap2))
    	{
    		include($ap2);
    	}
	


    }





    $sql = "(";

    $cont2 = 1;

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont15 = $cont_ . "15";


      $gravar_este_campo = true;

      if(ISSET($campos[$cont15]))
      {
        if($campos[$cont15]=="1")
        {
          $gravar_este_campo = false;
        }
      }

      if($gravar_este_campo)
      {

        $cont2++;

        $sql = $sql . $campos[$cont1];

        if($cont2<=$numero_campos_gravar)        
        {
          $sql = $sql . ", ";
        }

      }

    }



    // Se existir o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= ", ativo";
    }



    $sql.= ")";

    $sql.= " VALUES (";



    $cont2 = 1;

    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont3 = $cont_ . "3";
      $cont15 = $cont_ . "15";


      $gravar_este_campo = true;

      if(ISSET($campos[$cont15]))
      {
        if($campos[$cont15]=="1")
        {
          $gravar_este_campo = false;
        }
      }

      if($gravar_este_campo)
      {

        $cont2++;

        $sql.= "'" . prepara_campo($campos_sql[$cont1],$campos[$cont3]) . "'";

        if($cont2<=$numero_campos_gravar)        
        {
          $sql.= " , ";
        }

      }
    }


    // Se existir o sistema de exclusão por ativa��o, inserimos o valor "1" para o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= ",'1'";
    }


    $sql = $sql . " )";



	if(file_exists($ap3))
	{
		include($ap3);
	}
	





    $sql = "INSERT INTO " . $tabela . " " . $sql; 

    // echo $sql;

    mysql_query($sql, $conexao); 


    // FIM SISTEMA NORMAL - GRAVANDO ######################################################################











    // CAMPOS ASSOCIATIVOS - GRAVANDO ######################################################################


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


      if(ISSET($_REQUEST[$campos_associativos[$conta5]]))
      {
        $valores = implode(":",$_REQUEST[$campos_associativos[$conta5]]);
        $array_valores = explode(":",$valores);


          $sql_busca_ultimo = " SELECT   MAX($campos_associativos[$conta91]) as codigo_tabela_associativos FROM " . $campos_associativos[$conta8];
          $rs_novo_registro = mysql_query($sql_busca_ultimo, $conexao);
          $linha_novo_registro = mysql_fetch_array($rs_novo_registro);
          $codigo_novo_registro = $linha_novo_registro["codigo_tabela_associativos"]+1;

          echo $sql_busca_ultimo."<br>";
          echo $codigo_novo_registro."<br>";

          $sql_gravar = "INSERT INTO " . $campos_associativos[$conta8] . " (".$campos_associativos[$conta91].",".$campos_associativos[$conta9].",".$campos_associativos[$conta5].") VALUES ";

          $linha_associativo = 1;

        for ($i=0;$i<count($_REQUEST[$campos_associativos[$conta1]]);$i++)
        {

          
          $sql_gravar .= "('". $codigo_novo_registro++ . "','" . $$chave_primaria . "','" . $array_valores[$i] . "')" ; 

          if(count($_REQUEST[$campos_associativos[$conta1]])!=$linha_associativo){

            $sql_gravar .= ",";

          }


          $linha_associativo++;
        }

//exit();

        mysql_query($sql_gravar, $conexao); 

      }


        

    }


    // FIM CAMPOS ASSOCIATIVOS - GRAVANDO ######################################################################























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
            $sql.= " VALUES (". $codigo_novo_registro . "," . $$chave_primaria . "," . $valor_interlacado . ")" ; 

            mysql_query($sql, $conexao); 
          }
        }
      }





    }


    // FIM CAMPOS INTERLA�ADOS - GRAVANDO ######################################################################














    // SISTEMAS RELACIONADOS ############################################################    



    // preservando vari�veis do sistema original

    $chave_primaria_original = $chave_primaria;
    $redirecionamento_direto_original = $redirecionamento_direto;

    if(!(isset($redirecionamento_documentos_direto)))
    {
      $redirecionamento_documentos_direto_original=0;
    }
    else
    {
      $redirecionamento_documentos_direto_original=$redirecionamento_documentos_direto;      
    }


    $redirecionamento_documentos_direto_original = $redirecionamento_documentos_direto;

    // preservando vari�veis do sistema de fotos original

    $fotos_sistema_associado_original = $fotos_sistema_associado;
    $sistema_fotos_original = $sistema_fotos;
    $sistema_documentos_original = $sistema_documentos;
    $tipo_sistema_fotos_original = $tipo_sistema_fotos;
    $nome_sistema_fotos_original = $nome_sistema_fotos;
    $numero_algarismos_original = $numero_algarismos;
    $numero_algarismos_codigo_original = $numero_algarismos_codigo;
    $redimensionamento_automatico_original = $redimensionamento_automatico;
    $tipo_arquivo_ampliado_original = $tipo_arquivo_ampliado;
    $tipo_arquivo_grande_original = $tipo_arquivo_grande;
    $tipo_arquivo_pequeno_original = $tipo_arquivo_pequeno;
    $criar_borda_original = $criar_borda;
    $r_original = $r;
    $g_original = $g;
    $b_original = $b;






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

      for($cont=1;$cont<=$numero_campos_relacionados;$cont++)
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

















      /* ========= GRAVA NOVOS DADOS RELACIONADOS ====== */

      $campos_relacionados_para_sql = "";

      $sql_atributo_novo = array();


      $i = 0;
      $sql_atributo_novo[$i] = "";


      for($cont=1;$cont<=$numero_campos_relacionados;$cont++)
      {

        $cont_ = (10 + $cont);
        $cont1 = $cont_ . "1";
        $cont3 = $cont_ . "3";

        $i = 0;
        $valor_relacionado="";
        $nome_do_campo_relacionado = $campo_relacionado[$cont1] . "_novo";

        if(ISSET($_POST[$nome_do_campo_relacionado]))
        {

          foreach($_POST[$nome_do_campo_relacionado] as $valor_relacionado)
          {

            if($valor_relacionado!="")
            {


              $valor_relacionado = prepara_campo($valor_relacionado,$campos[$cont3]);

              if($i==0)
              {
                $campos_relacionados_para_sql .= "," . $campos[$cont1];
              }
  
              if(!(ISSET($sql_atributo_novo[$i])))
              {
                $sql_atributo_novo[$i] = "" ;
              }

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



      $atributo_novo="";

      $contz=0;
      $fotos_para_cortar="";




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

        if($atributo_novo!="")
        {

                    // caso exista sistema de exclusão no sistema relacionado, adiciona o valor "1" para o campo "ativo" no SQL
                      if($sistema_exclusao_relacionado==1)
                      {
                        $atributo_novo.="','1";
                      }
         
          
          $sql_relacionado.= "'" . $novo_id++. "','" . $$chave_primaria_original . "' , ";
          $sql_relacionado.=  " '".$atributo_novo . "') ";

          if(count($sql_atributo_novo)!=$linhas)
          {

          $sql_relacionado.= ", (";

          }
          



          // UPLOAD DE FOTOS NOS SISTEMAS RELACIONADOS


          $caminho = realpath("../..");

          $nome_campo_upload = 'foto_relacionado_upload_' . $y;

        

            if(ISSET($_FILES[$nome_campo_upload]))
            {

          if(is_uploaded_file($_FILES[$nome_campo_upload]['tmp_name'][$contz])) 
          {

              $tipo_arquivo_enviado = "";

              if ($_FILES[$nome_campo_upload]['type'][$contz] == "image/gif")
              {
                $tipo_arquivo_enviado = "gif";
              }

              if (($_FILES[$nome_campo_upload]['type'][$contz] == "image/jpg") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/pjpeg") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/jpeg") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/jpe") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/jfif") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/pjp") || ($_FILES[$nome_campo_upload]['type'][$contz] == "image/JPG"))
              {
                $tipo_arquivo_enviado = "jpg";
              }

              if (($_FILES[$nome_campo_upload]['type'][$contz] == "image/png")||($_FILES[$nome_campo_upload]['type'][$contz] == "image/x-png"))
              {
                $tipo_arquivo_enviado = "png";
              }

              if($tipo_arquivo_enviado!="")
              {



                if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
                {
                  $indice = $contz;
                  $nome_arquivo = zerosaesquerda($novo_id,$numero_algarismos) . "_" . zerosaesquerda($indice,$numero_algarismos_codigo) . "." . $tipo_arquivo_enviado ;  
                }

                if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
                {
                  $nome_arquivo = zerosaesquerda($novo_id,$numero_algarismos) . "." . $tipo_arquivo_enviado ;  
                }
    
                $caminho_arquivo_original = $caminho . "/" . $nome_sistema_fotos . "/originais/" . $nome_arquivo;
                $caminho_para_cortar = $nome_sistema_fotos . "/originais/" . $nome_arquivo;

             


                copy($_FILES[$nome_campo_upload ]['tmp_name'][$contz], $caminho_arquivo_original); 

                if($fotos_para_cortar!="")
                {
                  $fotos_para_cortar.= ",";
                }   

                $fotos_para_cortar.= $caminho_para_cortar;

              }
            }
          }



          $contz++;







        }



     $linhas++;
      }

     // echo $sql_relacionado."<br>";

//exit();
      if($sql_atributo_novo[0]!=""){ 
      mysql_query($sql_relacionado,$conexao)or die(mysql_error());
      }
      /* ========= FIM GRAVA NOVOS DADOS RELACIONADOS ====== */








    }






    // FIM SISTEMAS RELACIONADOS ######################################################################







  	if(file_exists($ap4))
  	{
  		include($ap4);
  	}
  	






// exit();













    // LOG  

    $acao = "Inclusão do registro com c�digo " . $$chave_primaria_original ;

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



  if(file_exists($ap5))
    {
      include($ap5);
      exit();

    }
    


    if($fotos_para_cortar!="")
    {
      $_SESSION['nome_sistema_de_origem']=basename(getcwd());
      $_SESSION['nome_chave_primaria_sistema_de_origem']=$chave_primaria_original;
      $_SESSION['valor_chave_primaria_sistema_de_origem']=$$chave_primaria_original;


      // a variável "tmo" quer dizer "tipo m�dulo de origem"
      // tmo=0 ou tso=NULL >>> o m�dulo de origem � igual ao sistema atual
      // tmo=1 >>> o m�dulo de origem � diferente do sistema atual

      header("Location: ../_recorta/index.php?sistema=" . $fotos_sistema_associado_original . "&fotos_para_cortar=" . $fotos_para_cortar . "&pasta=" . $nome_sistema_fotos . "&tmo=1");  
    }
    else
    {
      if(!(isset($redirecionamento_direto_original)))
      {
        $redirecionamento_direto_original=1;
      }

      if(($sistema_fotos_original==1)&&($redirecionamento_direto_original==1))
      {
        header("Location: editar_foto.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria_original . "=" . $$chave_primaria_original);  
        exit();
      }
      elseif(($sistema_documentos_original==1)&&($redirecionamento_documentos_direto_original==1))
      {
        header("Location: editar_documento.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria_original . "=" . $$chave_primaria_original);  
        exit();
      }
      else
      {
        
        header("Location: painel.php?codigo_modulo=" . $codigo_modulo);  
        
      }


    }


  }
  else
  {
    header("Location: " . $_SERVER['HTTP_REFERER']);  
    exit();
  }

















  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }

  ob_end_flush();

?>
