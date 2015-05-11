<?php

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



  include("../../include/sistema_conexao.php"); 
  include("../../include/sistema_protecao.php"); 
  include("../../include/sistema_zeros.php"); 
  include("../_include/funcao_confirma.php"); 
	
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);

  include("../_configuracoes/" . $codigo_modulo6 . ".php"); 



  include("../_include/usuarios_acesso.php");

  $permissao = 1;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {


    $sql_modulo = " SELECT texto_sistema ";
    $sql_modulo.= " FROM tabela_adm_sistemas ";
    $sql_modulo.= " WHERE codigo_sistema=" . $codigo_modulo;


    $rs_modulo = mysql_query($sql_modulo,$conexao);
    $linha_modulo = mysql_fetch_array($rs_modulo);




      // verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
      if((isset($campo_usuario))&&($campo_usuario!=""))
      {

        if((isset($tipo_permissao_usuario))&&($tipo_permissao_usuario==1))
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
            echo "Permiss�o Negada";
            exit();
          }
        }
      }

      



    include("../../include/sistema_data.php"); 


    include("../_include/topo.php"); 
    include("../_include/funcao_form.php"); 
    include("../_include/funcao_form_relacionado.php"); 
    include("../_include/funcao_importa_sfr.php"); 



		// Arquivo Personalizado 1 - Antes do Loop de Campos
		// Arquivo Personalizado 2 - Dentro do Loop de Campos (antes de mostrar o campo)
		// Arquivo Personalizado 3 - Dentro do Loop de Campos (ap�s mostrar o campo)
		// Arquivo Personalizado 4 - Após o Loop de Campos

	
		$ap1 = "../_personalizados/" . $codigo_modulo6 . "_editar_1.php";
		$ap2 = "../_personalizados/" . $codigo_modulo6 . "_editar_2.php";
		$ap3 = "../_personalizados/" . $codigo_modulo6 . "_editar_3.php";
		$ap4 = "../_personalizados/" . $codigo_modulo6 . "_editar_4.php";   
    $ap7 = "../_personalizados/" . $codigo_modulo6 . "_editar_gerenciar_documento.php";


	
	
	
?>


<script language="javascript">

  function alterar_senha_mostrar_input(ct,descricao_campo,nome_campo,tam)
  {
    var nome_id = "#"+nome_campo;
    var aleatorio4 = Math.floor(Math.random()*100000);
    var cm = '<? echo $codigo_modulo; ?>';
    $(nome_id).html('carregando dados ...');  
    $(nome_id).load('ajax_editar_dados_nova_senha.php?cm=' + cm + '&cont=' + ct + '&a=' + aleatorio4);
  }

  function mostrar_select(ct,id,v,uc)
  {
    var nome_id = "#div_" + id;
    var aleatorio3 = Math.floor(Math.random()*100000);
    var cm = '<? echo $codigo_modulo; ?>';
    $(nome_id).html('carregando dados ...');	
    $(nome_id).load('ajax_editar_dados_mostrar_select.php?cm=' + cm + '&cont=' + ct + '&valor_atual=' + v + '&ultimo_codigo=' + uc + '&a=' + aleatorio3);
  }

  function mostrar_select_relacionado(ct,id,v,uc,cmr)
  {
	  var nome_id = "#div_" + id;
    var aleatorio3 = Math.floor(Math.random()*100000);

    $(nome_id).html('carregando dados ...');	
    $(nome_id).load('ajax_editar_dados_mostrar_select_relacionado.php?cmr=' + cmr + '&cont=' + ct + '&valor_atual=' + v + '&ultimo_codigo=' + uc + '&a=' + aleatorio3);
  }

  function mostrar_select_relacionado_inserir(ct,id,cmr)
  {
	  var nome_id = "#div_" + id;
    var aleatorio3 = Math.floor(Math.random()*100000);

    $(nome_id).html('carregando dados ...');	
    $(nome_id).load('ajax_inserir_dados_mostrar_select.php?cmr=' + cmr + '&cont=' + ct + '&a=' + aleatorio3);
  } 
 
  
  function relacionado_atualiza_data(id,indice)
  {
    var id_dia = "#" + id + "_dia_" + indice;	
    var id_mes = "#" + id + "_mes_" + indice;		
    var id_ano = "#" + id + "_ano_" + indice;	

	  var ano = $(id_ano).find('option').filter(':selected').val(); 
	  var mes = $(id_mes).find('option').filter(':selected').val(); 
	  var dia = $(id_dia).find('option').filter(':selected').val(); 

	  var data = ano + mes + dia;

    var idn = id + "_" + indice;
    var objHidden = document.getElementById(idn);
    objHidden.value = data; 
  }
  
  
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="../_colorbox/css/colorbox.css" />
<script src="../_colorbox/js/jquery.colorbox.js"></script>

<script>
			$(document).ready(function(){
			
			
			
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});

				$(".callbacks").colorbox({
					onClosed:function(){ 
					  var aaa = $(this).attr('rel');
                      var myArray = aaa.split(',');
					  mostrar_select(myArray[0],myArray[1],myArray[2],myArray[3]);


					}
				});
				
			});
</script>


		

<?


    $url = "painel.php";   
    if(ISSET($_SERVER['HTTP_REFERER']))
    {
      $url = urlencode($_SERVER['HTTP_REFERER']);   
    }


    $pagina = 1;
    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = anti_injection($_REQUEST['pagina']);
    }



    $sql = "SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . anti_injection($_REQUEST[$chave_primaria]);
    $rs_dados = mysql_query($sql, $conexao);
    $linha = mysql_fetch_array($rs_dados);


    barra("Menu Principal","../index.php",$sistema_plural,"painel.php?codigo_modulo=" . $codigo_modulo,"Editar " . $sistema_singular,"","","");  


    	
    if(file_exists($ap1))
    {
      include($ap1);
    }
		


    if($linha_modulo['texto_sistema']!="")
    {
      
      echo "<div style='float:right; text-align:right; clear:both; margin:20px 20px 20px 0px;'>";
      echo "<font class=caminho>";
      echo $linha_modulo['texto_sistema'];  
      echo "</font>";
      echo "</div>";      
      
    }
    
    echo "<div style='clear:both;'>";



    echo '<form action="alterar.php"  name="frmCadastro" id="frmCadastro" method="post" onsubmit="return validar(';
    echo "'frmCadastro');";
    echo '">';


    echo '<input type="hidden" name="pagina" value="' . $pagina . '">';
    echo '<input type="hidden" name="' . $chave_primaria . '" value="' . anti_injection($_REQUEST[$chave_primaria]) . '">';
    echo '<input type="hidden" name="url" value="' . $url . '">';
    echo '<input type="hidden" name="codigo_modulo" value="' . $codigo_modulo . '">';


    echo '<table cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr>';
    echo '<td width="730" bgcolor="#dddddd" align="center">';





    // CAMPOS NORMAIS #######################################################


    for($cont=1;$cont<=$numero_campos;$cont++)
    {
	
      if(file_exists($ap2))
      {
        include($ap2);
      }

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
      $cont10 = $cont_ . "10";
      $cont11 = $cont_ . "11";
      $cont12 = $cont_ . "12";	  
      $cont13 = $cont_ . "13";    
      $cont14 = $cont_ . "14";    
      $cont15 = $cont_ . "15";    
	  
      $help14 = "";
      if(ISSET($campos[$cont14]))
      {
        $help14 = $campos[$cont14];
      }

       if($campos[$cont3]=="nao_editavel")
      {
        echo "<br>";
        edit_nao_editavel($campos[$cont2],$campos[$cont1],$campos[$cont4],$tabela,$campos[$cont10],$help14);  
      }


      if($campos[$cont3]=="varchar")
      {
        echo "<br>";
        edit3($campos[$cont2],$campos[$cont1],$campos[$cont4],$tabela,$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="senha")
      {
        echo "<br>";
        edit_senha($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
      }
	  
      if($campos[$cont3]=="senha_criptografada")
      {
        echo "<br>";
        edit_senha_md5($cont,$campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
      }

      if($campos[$cont3]=="inteiro")
      {
        echo "<br>";
        edit_inteiro($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="moeda")
      {
        echo "<br>";
        edit_moeda($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="real")
      {
        echo "<br>";
        edit_real($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="logico")
      {
        echo "<br>";
        check2($campos[$cont2],$campos[$cont1],$help14);  
      }
	  
      if($campos[$cont3]=="opcao")
      {
        echo "<br>";
        radio($campos[$cont2],$campos[$cont1],$help14);  
      }

      if(($campos[$cont3]=="blob")||($campos[$cont3]=="blob_html"))
      {


        if(ISSET($campos[$cont15]))
        {
          if($campos[$cont15]!='')
          {
            $sql_editar_15 = " SELECT " . $campos[$cont15] . " FROM " . $tabela . " WHERE " . $chave_primaria . "=" . $_REQUEST[$chave_primaria];
            
            $rs_editar_15 = mysql_query($sql_editar_15,$conexao);
            $linha_editar_15 = mysql_fetch_array($rs_editar_15);

            if($linha_editar_15[$campos[$cont15]] == $_SESSION['fw_codigo_usuario'])
            {
              echo "<br><br>";
              textarea_edit2($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);      
            }
          }  
          else
          {
            echo "<br><br>";
            textarea_edit2($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);      
          }
        }
        else
        {
          echo "<br><br>";        
          textarea_edit2($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);      
        }          
      }

      if($campos[$cont3]=="editor_html")
      {
        echo "<br><br>";
        editor_edit($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
      }

      if(($campos[$cont3]=="data_int")||($campos[$cont3]=="data_int_now"))
      {
        echo "<br>";
        data_int_edit2($campos[$cont2],$campos[$cont1],$campos[$cont10],$help14);  
      }
      
      if(($campos[$cont3]=="data_date")||($campos[$cont3]=="data_date_now"))
      {
        echo "<br>";
        data_date_edit($campos[$cont2],$campos[$cont1],$help14);  
      }
      
      if($campos[$cont3]=="data_now_fixo")
      {
        echo "<br>";
        data_now_edit($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="hora")      
      {
        echo "<br>";
        hora_edit($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="hora_now")      
      {
        echo "<br>";
        hora_edit($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="hora_now_fixo")      
      {
        echo "<br>";
        hora_fixo_edit($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="data_hora")      
      {
        data_hora_editar($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="chave_estrangeira")      
      {
        echo "<br><br>";

        $sistema_exclusao = 0;
        if($campos[$cont4]=="0")      
        {
          $sistema_exclusao = 1;
        }

        $modulo = "";
        if(isset($campos[$cont12]))
        {
		      $modulo = $campos[$cont12];
        }

        select_edit_ajax($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$cont,$modulo,$help14);  
      }

      if($campos[$cont3]=="usuario")      
      {
        echo "<br><br>";

        $sistema_exclusao = 0;
        if($campos[$cont4]=="0")      
        {
          $sistema_exclusao = 1;
        }

        select_usuario_edit($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$help14);
      }


      if($campos[$cont3]=="chave_estrangeira_recursiva")
      {

        $sistema_exclusao = 0;
        if($campos[$cont4]=="0")
        {
          $sistema_exclusao = 1;
        }

        echo "<br><br>";
        select_recursivo_edit($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$help14);
      }

  	  if(file_exists($ap3))
      {
        include($ap3);
      }

	
    }

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



      $conta14 = $conta_ . "14";//campo help

      $help14 = "";
      if(ISSET($campos_associativos[$conta14]))
      {
        $help14 = $campos_associativos[$conta14];
      }

      $sistema_exclusao = 0;
      if($campos_associativos[$conta4]=="0")
      {
        $sistema_exclusao = 1;
      }


      echo "<br><br>";
      select_multi_edit2($campos_associativos[$conta2],$campos_associativos[$conta6],$campos_associativos[$conta5],$campos_associativos[$conta7],$campos_associativos[$conta8],$campos_associativos[$conta9],$sistema_exclusao,$help14);
    }





  

    // FIM CAMPOS NORMAIS #######################################################





















    // CAMPOS INTERLA�ADOS ##################################################



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




      // configura��o
      $tabela_pai = $campos_interlacados[$inter1];
      $tabela_pai_chave_primaria = $campos_interlacados[$inter2];
      $tabela_pai_campo_descricao = $campos_interlacados[$inter3];
      $tabela_pai_exclusao = $campos_interlacados[$inter4];

      $tabela_filho = $campos_interlacados[$inter5];
      $tabela_filho_chave_primaria = $campos_interlacados[$inter6];
      $tabela_filho_campo_descricao = $campos_interlacados[$inter7];
      $tabela_filho_exclusao = $campos_interlacados[$inter8];

      $tabela_associativa = $campos_interlacados[$inter9];
      $tabela_associativa_chave_primaria = $campos_interlacados[$inter10];
      $tabela_associativa_nome_campo_principal = $campos_interlacados[$inter11];
      $tabela_associativa_nome_campo_filho = $campos_interlacados[$inter12];



      $sql = " SELECT * FROM " . $tabela_pai;

      if($tabela_pai_exclusao)
      {
        $sql.= " WHERE ativo=1";
      }

      $rs_tabela_pai = mysql_query($sql,$conexao);
      
      echo "<br><br>";

      while($linha_tabela_pai=mysql_fetch_array($rs_tabela_pai))
      {

        $sql_tabela_filho = $tabela_filho . " WHERE " . $tabela_pai_chave_primaria . "=" . $linha_tabela_pai[$tabela_pai_chave_primaria];

        select_edit_interlacado($linha_tabela_pai[$tabela_pai_campo_descricao],$sql_tabela_filho,$tabela_filho_chave_primaria,$tabela_filho_campo_descricao,$tabela_associativa,$tabela_associativa_nome_campo_principal,$tabela_filho_exclusao);

        echo "<br>";
      }

    }



    // FIM CAMPOS INTERLA�ADOS ##################################################















  



    // CAMPOS RELACIONADOS #####################################################



    // preservando vari�veis do sistema original
    $chave_primaria_original = $chave_primaria;
    $sistema_fotos_original = $sistema_fotos;
    $sistema_documentos_original = $sistema_documentos;

    if(!(isset($tipo_sistema_documentos)))
    {
      $tipo_sistema_documentos_original = 1;
    }
    else
    {
      $tipo_sistema_documentos_original = $tipo_sistema_documentos;
    }


    $num_sistemas_relacionados_deste = $numero_sistemas_relacionados;

    for($z=1;$z<=$num_sistemas_relacionados_deste;$z++)
    {
      $sistema_relacionado_deste[$z] = $sistema_relacionado[$z];
    }


    for($y=1;$y<=$num_sistemas_relacionados_deste;$y++)
    {

      // Importando configurações do sistema relacionado
      include("../_configuracoes/" . zerosaesquerda($sistema_relacionado_deste[$y],6) . ".php");

      $tabela_relacionado = $tabela;
      $chave_primaria_relacionado = $chave_primaria;
      $descricao_principal_relacionado = $descricao_principal;
      $sistema_exclusao_relacionado = $sistema_exclusao;
      $numero_campos_relacionados = $numero_campos;
      $codigo_modulo_relacionado = $sistema_relacionado_deste[$y];
	  
      $ordem_padrao_relacionado = $ordem_padrao;
      $campo_ordenacao_padrao_relacionado = $campo_ordenacao_padrao;

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
        $cont10 = $cont_ . "10";
        $cont11 = $cont_ . "11";		
        $cont12 = $cont_ . "12";
		
        $campo_relacionado[$cont1] = $campos[$cont1];
        $campo_relacionado[$cont2] = $campos[$cont2];
        $campo_relacionado[$cont3] = $campos[$cont3];
        $campo_relacionado[$cont4] = $campos[$cont4];
        $campo_relacionado[$cont5] = $campos[$cont5];
        $campo_relacionado[$cont6] = $campos[$cont6];
        $campo_relacionado[$cont7] = $campos[$cont7];
        $campo_relacionado[$cont8] = $campos[$cont8];
        $campo_relacionado[$cont9] = $campos[$cont9];
        $campo_relacionado[$cont10] = $campos[$cont10];

        if(ISSET($campos[$cont11]))
		    {
          $campo_relacionado[$cont11] = $campos[$cont11];
		    }

        if(ISSET($campos[$cont12]))
		    {
          $campo_relacionado[$cont12] = $campos[$cont12];
		    }
      }        





      // EDITAR ##################################################



      $sql = " SELECT * ";
      $sql.= " FROM " . $tabela_relacionado . " ";
      $sql.= " WHERE " . $chave_primaria_original  . "="  . anti_injection($_REQUEST[$chave_primaria_original]);



	  
	  
      if($sistema_exclusao_relacionado==1)
      {
        $sql.= " AND ativo=1";
      }

      $sql.= " ORDER BY " . $tabela_relacionado . "." . $campo_ordenacao_padrao_relacionado . " " . $ordem_padrao_relacionado;
	  
      $rs_relacionados=mysql_query($sql,$conexao);

      echo '<br><br>';

      echo "<div style='width:960px; padding:20px; border:1px solid #bbbbbb; overflow-x:scroll; background-color:#cccccc;'>";
      echo '<a name="ancora_'.$sistema_plural.'"></a>'; // ANCORA PARA OS SISTEMAS RELACIONADOS
      echo '<center><h3>';
      echo $sistema_plural;
      echo '</h3></center><br />
	  ';



      echo '<table border="0" style="text-align:center;" align=center class="preto_8">';


      // Cabe�alho da tabela

      echo '<tr style="font-weight:bold;">';
      for($x=1;$x<=$numero_campos_relacionados;$x++)
      {
        $x_ = (10 + $x);
        $x1 = $x_ . "1";
        $x2 = $x_ . "2";
        $x3 = $x_ . "3";

        if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
        {
          echo '<td>'.$campo_relacionado[$x2].'</td>';
        }
      }

      if(mysql_num_rows($rs_relacionados)>0)
      {
        echo '<td>|___Excluir___|</td>';
      }
      else
      {
        echo '<td>Adicionar</td>';
      }

      if($sistema_fotos==1)
      {
	    echo '<td colspan=2>______Fotos______|</td>';
      }

		
      echo '</tr>';

      // Fim Cabe�alho da tabela

      $indice=0;
	  $indicey=0;
      while($linha_relacionado = mysql_fetch_array($rs_relacionados))
      {
        // esta variavel indiceY serve somente para diferenciar um campo do outro na fun��o select_edit_ajax_relacionado
		$indicey++;
		
        $link_exclusao = "excluir_registro_relacionado.php?" . $chave_primaria_relacionado . "=" . $linha_relacionado[$chave_primaria_relacionado] . "&" . $chave_primaria_original  . "="  . anti_injection($_REQUEST[$chave_primaria_original]) . "&pagina=" . $pagina;
        $link_exclusao.= "&tb=" . $tabela_relacionado;
        $link_exclusao.= "&cp=" . $chave_primaria;
        $link_exclusao.= "&se=" . $sistema_exclusao_relacionado;
        $link_exclusao.= "&cm=" . $codigo_modulo ;
        $link_exclusao.= "&cmr=" . $codigo_modulo_relacionado ;
		
        echo '<input type="hidden" value="' . $linha_relacionado[$chave_primaria_relacionado] . '" name="' . $chave_primaria_relacionado . '[]" />';
        echo '<tr>';


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
          $x9 = $x_ . "9";
          $x10 = $x_ . "10";
          $x11 = $x_ . "11";
          $x12 = $x_ . "12";
		  
          if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
          {

            echo "<td>";

            if($campo_relacionado[$x3]=="chave_estrangeira")
            {
              $sistema_exclusao = 0;
              if($campo_relacionado[$x4]=="0")      
              {
                $sistema_exclusao = 1;
              }

              select_edit_ajax_relacionado($campo_relacionado[$x2],$campo_relacionado[$x6],$campo_relacionado[$x5],$campo_relacionado[$x7],$campo_relacionado[$x1],$sistema_exclusao,$campo_relacionado[$x10],$x,$codigo_modulo_relacionado,$indicey,$campo_relacionado[$x11]);  		      
            }


            if($campo_relacionado[$x3]=="inteiro")
            {
              echo edit_inteiro_relacionado2($campo_relacionado[$x2],$campo_relacionado[$x1],$campo_relacionado[$x4],$campo_relacionado[$x10]);  
            }

            if($campo_relacionado[$x3]=="varchar")
            {
              echo edit_relacionado2($campo_relacionado[$x2],$campo_relacionado[$x1],$campo_relacionado[$x4],$campo_relacionado[$x10]);  
            }

            if($campo_relacionado[$x3]=="moeda")
            {
              $d = edit_moeda_relacionado2($campo_relacionado[$x2],$campo_relacionado[$x1],$campo_relacionado[$x4],$campo_relacionado[$x10]);  
              $d = str_replace("\'", "'", $d);
              echo $d;
            }

            if($campo_relacionado[$x3]=="real")
            {
              $d = edit_real_relacionado2($campo_relacionado[$x2],$campo_relacionado[$x1],$campo_relacionado[$x4],$campo_relacionado[$x10]);  
              $d = str_replace("\'", "'", $d);
              echo $d;
            }

            if($campo_relacionado[$x3]=="logico")
            {
              echo edit_check_relacionado2($campo_relacionado[$x1]);  
            }
			
            if($campo_relacionado[$x3]=="opcao")
            {
              echo edit_check_relacionado2($campo_relacionado[$x1]);  
            }
						
            if(($campo_relacionado[$x3]=="data_int")||($campo_relacionado[$x3]=="data_int_now"))
            {
              echo edit_data_int_relacionado($campo_relacionado[$x1],$campo_relacionado[$x2],$indice);  
              $indice++;
            }

            echo "</td>";
          }
   
        }

        echo '<td><a style="text-decoration:none; font-size:12px; color:#000000;" href="' . $link_exclusao .'#ancora_'.$sistema_plural.'">[excluir]</a></td>
		';

        if($sistema_fotos==1)
        {
          include("editar_dados_relacionado_miniaturas.php");

          $link_gerenciar_foto = "editar_foto.php?codigo_modulo=" . $codigo_modulo_relacionado . "&" . $chave_primaria_relacionado . "=" . $linha_relacionado[$chave_primaria_relacionado];
          echo '<td style="width:300px;"><a target="_blank" style="text-decoration:none; font-size:12px; color:#000000;" href="' . $link_gerenciar_foto . '">[gerenciar foto]</a></td>';
          echo '<td><a target="_blank" style="text-decoration:none; font-size:12px; color:#000000;" href="' . $link_gerenciar_foto . '"><img border=0 height=20 src='.$miniatura.'></a></td>';
        }

        echo '</tr>
		';

      }



      // FIM CAMPOS RELACIONADOS - EDITAR ##################################################









      // CAMPOS RELACIONADOS - INSERIR ##################################################


      echo '<tr>';
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
        $x9 = $x_ . "9";
        $x10 = $x_ . "10";
        $x11 = $x_ . "11";
        $x12 = $x_ . "12";
		
        if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
        {

          echo "<td>";

          if($campo_relacionado[$x3]=="chave_estrangeira")
          {

            $sistema_exclusao = 0;
            if($campo_relacionado[$x4]=="0")      
            {
              $sistema_exclusao = 1;
            }
            select_inserir_ajax_relacionado($campo_relacionado[$x2],$campo_relacionado[$x6],$campo_relacionado[$x5],$campo_relacionado[$x7],$campo_relacionado[$x1],$sistema_exclusao,$campo_relacionado[$x10],$x,$codigo_modulo_relacionado,$indicey);  		      
	  
          }

	  
	  
	  
          if($campo_relacionado[$x3]=="varchar")
          {
            echo input_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
          }

          if($campo_relacionado[$x3]=="inteiro")
          {
            echo input_inteiro_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
          }

          if($campo_relacionado[$x3]=="moeda")
          {
            $d = input_moeda_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
            $d = str_replace("\'", "'", $d);
            echo $d;
          }

          if($campo_relacionado[$x3]=="logico")
          {
            echo input_check_relacionado($campo_relacionado[$x2]);  
          }

          if(($campo_relacionado[$x3]=="data_int")||($campo_relacionado[$x3]=="data_int_now"))
          {
            echo input_data_int_relacionado($campo_relacionado[$x1]."_novo",$campo_relacionado[$x2]);  
          }

          echo "</td>";
        }

      }

      echo '<td>';
      echo '<input type="hidden" name="ancora" value="ancora_'.$sistema_plural.'">'; // ENVIA ANCORA PARA O ALTERAR.PHP
      echo '<input type=submit name="adicionar" value=" + ">';

      echo '</td>';
      echo '</tr>';
      echo '</table><br />';


      // FIM CAMPOS RELACIONADOS - INSERIR ##################################################


      echo "</div>";
    }



    // FIM CAMPOS RELACIONADOS #####################################################







	if(file_exists($ap4))
	{
		include($ap4);
	}






    $permissao = 5;

    if(verifica_usuario2($codigo_modulo, $permissao))
    {




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

      if($mostrar_editar==true)
      {

        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<input class="submit" type="submit" value="Enviar Dados">';
        echo '<br>&nbsp;';
      }
    }

    if($sistema_fotos_original==1)
    {  
      echo '<br><a class="caminho" href="editar_foto.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria_original . '=' . anti_injection($_REQUEST[$chave_primaria_original]) . '"><b>>> Gerenciar Fotos</b></a>';
    }

    if(file_exists($ap7))
    {
      include($ap7);
    }
    else
    {
      if($sistema_documentos_original==1)
      {  

        function listar_pasta($dir,$codigo)
        {
      
          $files = array(); 
          if ($handle = opendir($dir)) 
          {
            while (false !== ($entry = readdir($handle))) 
            {
              if ($entry != "." && $entry != "..") 
              {
                if (is_dir($dir."/".$entry) === true)
                {
                  // echo "DIRECTORY: ".$entry."\n";
                }
                else
                {
                  if(($pos = strpos ($entry, $codigo))===0)
                  {
                    $files[] = $entry;
                  }
                }
              }
            }
            closedir($handle);
          }
      
          return $files;
        }
        echo '<h2 style="text-align:left; padding-left: 10px;">Documentos</h2>';
        echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>';
        echo '<div style="text-align:left;padding-left: 10px;">';


        echo '<br><a class="caminho" href="editar_documento.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria_original . '=' . anti_injection($_REQUEST[$chave_primaria_original]) . '"><b>>> Gerenciar Documentos</b></a>';

        if($tipo_sistema_documentos_original==2)
        {  
          echo '<br><br><a class="caminho" href="../_upload_documentos_lote/formulario.php?up_codigo_modulo=' . $codigo_modulo . '&' .$chave_primaria_original . '=' . anti_injection($_REQUEST[$chave_primaria_original])  . '"><b>>> Enviar Documentos em Lote</b></a><br><br>';


          echo '<font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Arquivos desse Registro:</b></font>';
        
          $codigo_registro = zerosaesquerda($_REQUEST[$chave_primaria],$numero_algarismos_documentos);  

          $lista = listar_pasta("../../" . $pasta_documentos,$codigo_registro);

          foreach ($lista as $key => $nome_arquivo) 
          {

            $arquivo = "../../" . $pasta_documentos . "/" . $nome_arquivo;

            if (file_exists($arquivo))
            {  
              $posicao_inicial = $numero_algarismos_documentos + $numero_algarismos_documentos_indice + 2;
              $nome_arquivo_exibicao = substr($nome_arquivo, $posicao_inicial);

              echo '<br>&nbsp;&nbsp;&nbsp;';

              echo '<a  class=caminho onclick="';
              echo "return confirmLink(this, '\\n****************************\\n\\nTem certeza que deseja\\napagar este arquivo?\\n\\n****************************'";
              echo ')" alt="clique para excluir" href="excluir_documento.php?codigo_modulo=' . $codigo_modulo;
              echo '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria];
              echo '&nome_arquivo=' . $nome_arquivo;
              echo '&pagina=' . $_REQUEST['pagina'] . '">';
              echo '<img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir">';
              echo '</a>';
              echo '&nbsp;';
              echo '<a target="_blank" class=caminho alt="clique para download" href="' . $arquivo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"></a>';
              echo '&nbsp;&nbsp;';
              echo '<font class=caminho>' . $nome_arquivo_exibicao . '</font>' ;
            }

          }
          
        }else{
          echo '<font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Arquivos desse Registro:</b></font>';
     

          $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos] ;

          if (file_exists($nome_arquivo))
          {  
            echo '&nbsp;&nbsp;&nbsp;';
            echo '<a  class=caminho onclick="';
            echo "return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar este arquivo?\n\n****************************'";
            echo '")" alt="clique para excluir" href="excluir_documento.php?codigo_modulo=' . $codigo_modulo;
            echo '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria];
            echo '&nome_arquivo=' . $codigo_registro . "_" . $linha[$nome_campo_documentos];
            echo '&pagina=' . $_REQUEST['pagina'] . '">';
            echo '<img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"></a>';

            echo '&nbsp;';
            echo '<a target="_blank" class=caminho alt="clique para download" href="' . $nome_arquivo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"></a>';
            echo '&nbsp;&nbsp;';

            echo '&nbsp;&nbsp;<font class=caminho>' . $linha[$nome_campo_documentos] . '</font>';
          }  
        }
        echo '</div>';

      }
    }
    
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';

    echo '</div>';


    if(isset($_REQUEST['msg']))
    {
      if($_REQUEST['msg']!="")
      {
        echo "
        ";
        echo "<script language=javascript>";
        echo "alert('" . $_REQUEST['msg'] . "')";
        echo "</script>";
        echo "
        ";
      }
    }

    echo '</body>';
    echo '</html>';




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