<?php

  ob_start();
  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {
  
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_data.php"); 
    include("../../include/sistema_protecao.php"); 
    include("../_include/topo.php"); 
    include("../_include/funcao_selecao.php"); 
    include("../_include/funcao_confirma.php"); 
    include("../_include/funcao_importa_sfr.php"); 
	
  	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
	
    
    include("../_include/filtra_usuario.php");
  
	

    if(ISSET($_REQUEST['nome_campo_busca']))
    {
      $nome_campo_busca = anti_injection($_REQUEST['nome_campo_busca']);
    }
    else
    {
      $nome_campo_busca = "";
    }


    if((ISSET($_REQUEST['nome_campo_ordem']))&&($_REQUEST['nome_campo_ordem']!=""))
    {
      $nome_campo_ordem = anti_injection($_REQUEST['nome_campo_ordem']);
    }
    else
    {
      $nome_campo_ordem = $campo_ordenacao_padrao;
    }



    if(ISSET($_REQUEST['tipo_ordem']))
    {
      $tipo_ordem = anti_injection($_REQUEST['tipo_ordem']);
    }
    else
    { 
      $tipo_ordem = $ordem_padrao;
    }


    if(ISSET($_REQUEST['expressao_busca']))
    {
		$expressao_busca = anti_injection($_REQUEST['expressao_busca']);
		$expressao_busca = str_replace("|||"," ",$expressao_busca);

    }
    else
    {
      $expressao_busca = "";
    }


  
  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  } 
  
  ob_end_flush();




   // BUSCA

?>

<script language="javascript">

   
/*
      function enviaKey(d)
      {              
        
      $("#"+d).load('ajax_painel_filtros_auto_edit.php','codigo_modulo=<?php echo $codigo_modulo;?>&descricao='+  $('input#descricao_'+d).val()+'&campo_preencher='+  $('input#campo_preencher_'+d).val()+'&campos_mostrar='+  $('input#campos_mostrar_'+d).val()+'&auto_busca='+  $('input#auto_busca_'+d).val()+'&sql_filtro='+  $('input#sql_filtro_'+d).val()); 
      
      }
       */



      function enviaKey2(campo_busca,nome_campo_codigo_primario,descricao_campo,nome_tabela,nome_campo_codigo,nome_campo_descricao,sistema_exclusao,cont,quantidade_caracter)
      {              
          
       

           $('#campo_'+nome_campo_codigo_primario).load('ajax_painel_filtros_auto_edit.php','codigo_modulo=<?php echo $codigo_modulo;?>&campo_busca='+ $('input#auto_busca_'+campo_busca).val()+'&nome_campo_codigo_primario='+nome_campo_codigo_primario+'&descricao_campo='+descricao_campo+'&nome_tabela='+nome_tabela+'&nome_campo_codigo='+nome_campo_codigo+'&nome_campo_descricao='+nome_campo_descricao+'&sistema_exclusao='+sistema_exclusao+'&cont='+cont+'&quantidade_caracter='+quantidade_caracter); 
        
       

      }

   

      function liga_enviaKey2(campo_busca,nome_campo_codigo_primario,descricao_campo,nome_tabela,nome_campo_codigo,nome_campo_descricao,sistema_exclusao,cont,quantidade_caracter){

        tout = setTimeout(function(){ enviaKey2(campo_busca,nome_campo_codigo_primario,descricao_campo,nome_tabela,nome_campo_codigo,nome_campo_descricao,sistema_exclusao,cont,quantidade_caracter); }, 1000);

      }



       function campo(id,way,who)
      {

      
        document.getElementById("auto_busca_campo_"+way).value = who;
        document.getElementById(way).value = id;
        
        document.getElementById('busca_'+way).style.display = "none";
       
     
      }


        function campo_none(way)
      {
        document.getElementById("auto_busca_campo_"+way).value = "";
        document.getElementById('busca_'+way).style.display = "none";

      }

    


  </script>




<?php
 echo '<div style="float:left; margin:10px 0px 0px 18px; padding:0px; width:600px;">';//CERCA BUSCA NORMAL

  echo '<div style="float:left; margin:10px 0px 0px 18px; padding:0px; ">';

  echo '<font class="caminho"><b>:: Busca: </b></font>';
  echo '&nbsp;&nbsp;';
  echo '<input class=input type=text name=expressao_busca value="' . $expressao_busca . '">';
  echo '&nbsp;&nbsp;';
  echo '<select class="select" name="nome_campo_busca">';
  echo '<option value="">Selecione</option>';   //ORIGINBAL


//AQUI PRA BAIXO NOVO

 /* echo '<font class="caminho"><b>:: Busca: </b></font>';
  echo '&nbsp;&nbsp;';
  echo '<input id="expressao_busca" class=input type=text name=expressao_busca value="' . $expressao_busca . '" onkeyup="enviaKey();" autocomplete="off" >';
  echo '<div id="teste2"  style="border:1px solid red;float:left; width:362px; height:1px; position:absolute; left:108px; top:140px; z-index:0; display:block;"></div>';
 
  echo '&nbsp;&nbsp;';
  echo '<select class="select" id="nome_campo_busca" name="nome_campo_busca">';
  echo '<option value="">Selecione</option>';*/

//AQUI PARA CIMA NOVO

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
  
    if(($campos[$cont5]=="")||($campos[$cont5]=="unico")||($campos[$cont5]=="obrigatorio"))
    {  
      $selected = "";
      if($campos[$cont1]==$nome_campo_busca)
      {
        $selected = " selected ";
      }

      echo '<option value="' . $campos[$cont1] . '" ' . $selected . '>Por ' . $campos[$cont2] . '</option>';
      echo '
      ';
    }  
  }

  echo '</select>';

  echo ' <input class=submit type="submit" value="ok">';

  echo '</div>';

  // FIM DA BUSCA







  // FILTROS


  //COMEÇA FILTROS ASSOCIATIVOS

  echo '<div style="float:left; clear:both; margin:0px 0px 20px 0px; padding:0px;">';

  for($cont=1;$cont<=$numero_campos_associativos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont4 = $cont_ . "4";
    $cont5 = $cont_ . "5";
    $cont6 = $cont_ . "6";
    $cont7 = $cont_ . "7";
    $cont8 = $cont_ . "8";
    $cont9 = $cont_ . "9";
    $cont91 = $cont_ . "91";

    if (($campos_associativos[$cont5]!="")&&($campos_associativos[$cont6]!="")&&($campos_associativos[$cont7]!=""))
    {  


      $sistema_exclusao = 0;
      if($campos_associativos[$cont4]=="0")      
      {
        $sistema_exclusao = 1;
      }

      $opcao_selecionada = "";


      if(isset($_REQUEST[$campos_associativos[$cont1]]))
      {
        $opcao_selecionada = $_REQUEST[$campos_associativos[$cont1]];
      }


 


    $campo_ass_tabela = $campos_associativos[$cont6];
    $campo_ass_desc = $campos_associativos[$cont7];



      echo '<div style="float:left; clear:both; height:20px; margin:40px 0px 0px 0px;">';
      // function select_painel_filtros_ajax_associativos($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,   $sistema_exclusao,$cont,$opcao_selecionada)
      select_painel_filtros_ajax_associativos($campos_associativos[$cont2],$campo_ass_tabela,$campos_associativos[$cont5],$campo_ass_desc,$campos_associativos[$cont1],$sistema_exclusao,$cont,$opcao_selecionada,$campos_associativos[$cont8]);
      echo '<span style="float:left; margin:-3px 0px 0px 6px; *margin-top:0px;"><input class=submit type="submit" value="ok"></span>';

      echo '</div>';
    }
  }

  echo '</div>';

  //TERMINA FILTROS ASSOCIATIVOS


  echo '<div style="float:left; clear:both; margin:0px 0px 20px 0px; padding:0px; ">';

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont4 = $cont_ . "4";
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
    $cont6 = $cont_ . "6";
    $cont7 = $cont_ . "7";
    $cont10 = $cont_ . "10";

    $cont16 = $cont_ . "16"; // CAMPO QUE PEGA A QUANTIDADE DE CARACETERES A SER EXIBIDO  O RESULTADO

    if (($campos[$cont5]!="")&&($campos[$cont6]!="")&&($campos[$cont7]!=""))
    {  


      $sistema_exclusao = 0;
      if($campos[$cont4]=="0")      
      {
        $sistema_exclusao = 1;
      }

      $opcao_selecionada = "";

      if(isset($campos[$cont16]) && $campos[$cont16] !=""){
      $quantidade_caracter = $campos[$cont16];
      }else{
        $quantidade_caracter = 1;
      }


      if(isset($_REQUEST[$campos[$cont1]]))
      {
        $opcao_selecionada = $_REQUEST[$campos[$cont1]];
      }

      echo '<div style="float:left; clear:both; height:20px; margin:20px 0px 0px 0px; ">';

      select_painel_filtros_ajax($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$cont,$opcao_selecionada,$quantidade_caracter);
      echo '<span style="float:left; margin:-3px 0px 0px 6px; *margin-top:0px;"><input class=submit type="submit" value="ok"></span>';

      echo '</div>';

    }
  }

  echo '</div>';

  echo '<br />';

   // FIM DOS FILTROS






  // ORDENAÇÃO

  echo '
  ';

  echo '<div style="float:left; clear:both; margin:0px 0px 20px 18px; padding:0px; ">';

  echo '<font class="caminho"><b>:: Ordenar ' . $sistema_plural . ' por: </b></font>';
  echo '&nbsp;';

  echo '<select class="select" name="nome_campo_ordem">';
  echo '<option value="">Selecione</option>';

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
  
    if ($campos[$cont5]=="")
    {  
		  $selected = "";
		  if($campos[$cont1]==$nome_campo_ordem)
      {
 		    $selected = "selected";
		  }

      echo '<option value="' . $campos[$cont1] . '" ' . $selected . '>' . $campos[$cont2] . '</option>';

    }  
  }


  echo '</select>';

  echo '&nbsp;&nbsp;';
  echo '<font class="caminho"><b>Na ordem: </b></font>';
  echo '&nbsp;';

  echo '<select class="select" name="tipo_ordem">';
  echo '<option value="">Selecione</option>';


  $selected = " ";

  if($tipo_ordem=="asc") 
  {
    $selected = " selected ";
	}  

	echo '<option value="asc" ' . $selected . '>Crescente</option>';


  $selected = " ";

  if($tipo_ordem=="desc") 
	{
    $selected = " selected ";
	}  

	echo '<option value="desc" ' . $selected . '>Decrescente</option>';
	  

  echo '</select>';

  echo '<input type="submit" class=submit value="ok">';

  echo '</div>';



 echo '</div>';//TERMINA CERCA BUSCA NORMAL



/*echo '<div style="float:left; margin:10px 0px 0px 18px; width:600px;  ">';

echo '<div style="float:left; ">';


//AQUI PRA BAIXO NOVA BUSCA //position:absolute; left:1008px; top:140px; z-index:0;

  echo '<font class="caminho"><b>:: Busca Chave Extrageira: </b></font>';
  echo '&nbsp;&nbsp;';
  echo '<input id="expressao_busca" class=input type=text name=expressao_busca value="' . $expressao_busca . '" onkeyup="enviaKey();" autocomplete="off" >';
  
  echo '&nbsp;&nbsp;';
  echo '<select class="select" id="nome_campo_busca" name="nome_campo_busca">';
  echo '<option value="">Selecione</option>';

//AQUI PARA CIMA

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
  
    if(($campos[$cont5]=="")||($campos[$cont5]=="unico")||($campos[$cont5]=="obrigatorio"))
    {  
      $selected = "";
      if($campos[$cont1]==$nome_campo_busca)
      {
        $selected = " selected ";
      }

      echo '<option value="' . $campos[$cont1] . '" ' . $selected . '>Por ' . $campos[$cont2] . '</option>';
      echo '
      ';
    }  
  }

  echo '</select>';

  echo ' <input class=submit type="submit" value="ok">';


  echo '</div>';//ACIMA FIM NOVA BUSCA
echo '<div id="teste2"  style="float:left;border:1px solid red;  width:362px; height:1px; position:absolute; left:825px; top:130px; z-index:0; "></div>';*/
echo '</div>';

?>