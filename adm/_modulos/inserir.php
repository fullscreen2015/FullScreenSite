<?php

ob_start();
session_start(); 
  
if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
{
	
	include("../../include/sistema_conexao.php"); 
	include("../../include/sistema_zeros.php"); 
	include("../_include/usuarios_acesso.php");
	include("../../include/sistema_protecao.php"); 
	
	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	$codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
	
  $permissao = 3;

	if(verifica_usuario2($codigo_modulo, $permissao))
	{

	
		$sql_modulo = " SELECT texto_sistema ";
		$sql_modulo.= " FROM tabela_adm_sistemas ";
		$sql_modulo.= " WHERE codigo_sistema=" . $codigo_modulo;


		$rs_modulo = mysql_query($sql_modulo,$conexao);
		$linha_modulo = mysql_fetch_array($rs_modulo);



		// Arquivo Personalizado 1 - Antes do Loop de Campos
		// Arquivo Personalizado 2 - Dentro do Loop de Campos (antes de mostrar o campo)
		// Arquivo Personalizado 3 - Dentro do Loop de Campos (ap�s mostrar o campo)
		// Arquivo Personalizado 4 - Após o Loop de Campos

	
		$ap1 = "../_personalizados/" . $codigo_modulo6 . "_inserir_1.php";
		$ap2 = "../_personalizados/" . $codigo_modulo6 . "_inserir_2.php";
		$ap3 = "../_personalizados/" . $codigo_modulo6 . "_inserir_3.php";
		$ap4 = "../_personalizados/" . $codigo_modulo6 . "_inserir_4.php";

	
	
	
	

		include("../_include/topo.php"); 


		include("../_include/funcao_form.php"); 
		include("../_include/funcao_form_relacionado.php"); 

		include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 



		barra("Menu Principal","../index.php",$sistema_plural,"painel.php?codigo_modulo=" . $codigo_modulo,"Inserir " . $sistema_singular,"","","");  


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


		echo '<form action="gravar.php"  enctype="multipart/form-data" name="frmCadastro" id="frmCadastro" method="post" onsubmit="return validar(';
		echo "'frmCadastro');";
		echo '">';
		
		echo '<input type="hidden" name="codigo_modulo" value="' . $codigo_modulo . '">';

		echo '<table cellspacing="0" cellpadding="0" width="780">';
		echo '<tr>';
		echo '<td width="730" bgcolor="#dddddd" align="center">';


		// CAMPOS NORMAIS ##################################################


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

      $help14 = "";
      if(ISSET($campos[$cont14]))
      {
        $help14 = $campos[$cont14];
      }

      		if($campos[$cont3]=="nao_editavel")
			{
				echo "<br>";
				input3($campos[$cont2],$campos[$cont1],$campos[$cont4],$tabela,$campos[$cont10],$help14);  
			}

			if($campos[$cont3]=="varchar")
			{
				echo "<br>";
				input3($campos[$cont2],$campos[$cont1],$campos[$cont4],$tabela,$campos[$cont10],$help14);  
			}

			if($campos[$cont3]=="senha")
			{
				echo "<br>";
				input_senha($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
			}
			
			if($campos[$cont3]=="senha_criptografada")
			{
				echo "<br>";
				input_senha_md5($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
			}
 
			if($campos[$cont3]=="inteiro")        
			{
				echo "<br>";
				input_inteiro($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
			}

			if($campos[$cont3]=="moeda")        
			{
				echo "<br>";
				input_moeda($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
			}

			if($campos[$cont3]=="real")        
			{
				echo "<br>";
				input_real($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
			}

			if($campos[$cont3]=="logico")
			{
				echo "<br>";
				check2($campos[$cont2],$campos[$cont1],$help14);  
			}


			// estudar se esta opção est� funcionando			
			if($campos[$cont3]=="opcao")
			{
				echo "<br>";
				radio($campos[$cont2],$campos[$cont1],$help14);  
			}
			

			if(($campos[$cont3]=="blob")||($campos[$cont3]=="blob_html"))
			{
				echo "<br><br>";
				textarea2($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
			}

			if($campos[$cont3]=="editor_html")
			{
				echo "<br><br>";
				editor($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
			}


			//Campo de hora que mostra a hora atual sem permitir a mudan�a do usuário 
			if($campos[$cont3]=="hora_now_fixo")      
			{
				echo "<br>";
				hora_now_fixo($campos[$cont2],$campos[$cont1],$help14);  
			}

			if($campos[$cont3]=="hora_now")      
			{
				echo "<br>";
				hora_now($campos[$cont2],$campos[$cont1],$help14);  
			}

			if($campos[$cont3]=="hora")      
			{
				echo "<br>";
				hora($campos[$cont2],$campos[$cont1],$help14);  
			}

			if(($campos[$cont3]=="data_date")||($campos[$cont3]=="data_int"))
			{
				echo "<br>";
				data2($campos[$cont2],$campos[$cont1],$campos[$cont10],$help14);  
			}
			
			//Campo de hora que mostra a hora atual sem permitir a mudan�a do usuário			
			if($campos[$cont3]=="data_now_fixo")
			{
				echo "<br>";
				data_now_fixo($campos[$cont2],$campos[$cont1],$help14);  
			}

			if(($campos[$cont3]=="data_int_now")||($campos[$cont3]=="data_date_now"))
			{
				echo "<br>";
				data_now($campos[$cont2],$campos[$cont1],$help14);  
			}
	
			if($campos[$cont3]=="data_hora")      
			{
				data_hora_inserir($campos[$cont2],$campos[$cont1],$help14);  
			}
	

			if($campos[$cont3]=="usuario")      
			{
	
				$sistema_exclusao = 0;
				if($campos[$cont4]=="0")
				{
					$sistema_exclusao = 1;
				}

				echo "<br><br>";
				select_usuario($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$help14);
			}

			if($campos[$cont3]=="chave_estrangeira")      
			{

				$sistema_exclusao = 0;
				if($campos[$cont4]=="0")
				{
					$sistema_exclusao = 1;
				}

				echo "<br><br>";
				select2($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$help14);
			}



			if($campos[$cont3]=="chave_estrangeira_recursiva")      
			{

				$sistema_exclusao = 0;
				if($campos[$cont4]=="0")
				{
					$sistema_exclusao = 1;
				}

				echo "<br><br>";
				select_recursivo($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$help14);
			}




			if($campos[$cont3]=="chave_associativa")
			{
				echo "<br><br>";
				select_multi2($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$sistema_exclusao,$help14);
			}


			if(file_exists($ap3))
			{
				include($ap3);
			}

		}


		// FIM CAMPOS NORMAIS ##################################################



















		// CAMPOS ASSOCIATIVOS ##################################################



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


			select_multi2($campos_associativos[$conta2],$campos_associativos[$conta6],$campos_associativos[$conta5],$campos_associativos[$conta7],$sistema_exclusao,$help14);
		}



		// FIM CAMPOS ASSOCIATIVOS ##############################################


















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
			$inter13 = $inter_ . "13";




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

			$obrigatorio = $campos_interlacados[$inter10];

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

				select2($linha_tabela_pai[$tabela_pai_campo_descricao],$sql_tabela_filho,$tabela_filho_chave_primaria,$tabela_filho_campo_descricao,$tabela_associativa_nome_campo_filho . "[]",$tabela_filho_exclusao,$obrigatorio,$help14);

				echo "<br>";
			}

		}



		// FIM CAMPOS INTERLA�ADOS ##################################################





































		// CAMPOS RELACIONADOS - PREPARA��O ##################################################




		// CAMPOS RELACIONADOS #####################################################


		// preservando vari�veis do sistema original
		$chave_primaria_original = $chave_primaria;


		$codigo_atributos = "";
		$chamada_javascript = "";


		$num_sistemas_relacionados_deste = $numero_sistemas_relacionados;

		for($z=1;$z<=$num_sistemas_relacionados_deste;$z++)
		{
			$sistema_relacionado_deste[$z] = $sistema_relacionado[$z];
		}



		for($y=1;$y<=$num_sistemas_relacionados_deste;$y++)
		{

			$tabela_atributos = "";


			// Importando configurações do sistema relacionado

			include("../_configuracoes/" . zerosaesquerda($sistema_relacionado_deste[$y],6) . ".php");

			$tabela_relacionado = $tabela;
			$chave_primaria_relacionado = $chave_primaria;
			$descricao_principal_relacionado = $descricao_principal;
			$sistema_fotos_relacionado = $sistema_fotos;


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




			$tabela_atributos.= '<table border="0" style="text-align:center;" align=center class="preto_8">';


			// Cabe�alho da tabela

			$tabela_atributos.= '<tr style="font-weight:bold;">';
			for($x=1;$x<=$numero_campos_relacionados;$x++)
			{
				$x_ = (10 + $x);
				$x1 = $x_ . "1";
				$x2 = $x_ . "2";
				$x3 = $x_ . "3";

				if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
				{
					$tabela_atributos.= '<td>'.$campo_relacionado[$x2].'</td>';
				}
			}
			$tabela_atributos.= '</tr>';

			// Fim Cabe�alho da tabela










			// CAMPOS RELACIONADOS - INSERIR ##################################################


			$tabela_atributos.= '<tr>';
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


				if(($campo_relacionado[$x1]!=$chave_primaria_original)&&($campo_relacionado[$x3]!="chave_primaria"))
				{

					$tabela_atributos.= "<td>";

					if($campo_relacionado[$x3]=="chave_estrangeira")
					{

						$sistema_exclusao = 0;
						if($campo_relacionado[$x4]=="0")      
						{
							$sistema_exclusao = 1;
						}

						$tabela_atributos.= select_relacionado($campo_relacionado[$x2],$campo_relacionado[$x6],$campo_relacionado[$x5],$campo_relacionado[$x7],$sistema_exclusao,$campo_relacionado[$x1]."_novo");  
					}

					if($campo_relacionado[$x3]=="varchar")
					{
						$tabela_atributos.= input_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
					}

					if($campo_relacionado[$x3]=="inteiro")
					{
						$tabela_atributos.= input_inteiro_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
					}

					if($campo_relacionado[$x3]=="moeda")
					{
						$tabela_atributos.= input_moeda_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
					}

					if($campo_relacionado[$x3]=="real")
					{
						$tabela_atributos.= input_real_relacionado($campo_relacionado[$x2],$campo_relacionado[$x1]."_novo",$campo_relacionado[$x4]);  
					}

					if($campo_relacionado[$x3]=="logico")
					{
						$tabela_atributos.= input_check_relacionado($campo_relacionado[$x1]."_novo");  
					}


					if($campo_relacionado[$x3]=="data_int")
					{
						$tabela_atributos.= input_data_int_relacionado($campo_relacionado[$x1]."_novo",$campo_relacionado[$x2]);
					}

					$tabela_atributos.= "</td>";
				}

			}

			// FIM CAMPOS RELACIONADOS - INSERIR ##################################################

  
			if($sistema_fotos_relacionado==1)
			{
				$tabela_atributos.= "<td><input type=file name=foto_relacionado_upload_" . $y . "[]></td>";
			}


			$tabela_atributos = str_replace("\n"," ",$tabela_atributos);
			$tabela_atributos = str_replace("\r"," ",$tabela_atributos);


?>

<script type="text/javascript">

  
  function atributos<? echo $y; ?>(cont)
  {
    var contador = cont + 1;
    var tabela_atributos = '';
    tabela_atributos = '<?php echo $tabela_atributos; ?>';
    var valores_atuais = document.getElementById('atributos<? echo $y; ?>').outerHTML;
    document.getElementById('atributos<? echo $y; ?>').outerHTML  =  tabela_atributos + '<td><a style="text-decoration:none;" href="javascript:atributos<? echo $y; ?>('+contador+');" ><font class="preto_8" ><b>[+]</b></font></a></td></tr></table>' + valores_atuais;

  }
  
  

</script>


<?

			echo '<br /><br /><center><font class="preto_8"><b>- - - - - - - - - - - - - - - - - - - - -</b></font><br /><br />';
			echo '<a name="ancora_'.$sistema_plural.'"></a>'; // ANCORA PARA OS SISTEMAS RELACIONADOS
			echo $sistema_plural;
			echo '<br /><br /></center>';

			echo '<div id="atributos'.$y.'"></div>';


			$chamada_javascript.= '<script>atributos'.$y.'(0);</script>';

		}


		// FIM CAMPOS RELACIONADOS ##################################################








		if(file_exists($ap4))
		{
			include($ap4);
		}




		echo '<br />';
		echo '<br />';
		echo '<br />';
		echo '<input class="submit" type="submit" value="Enviar Dados">';
		echo '<br>&nbsp;';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>&nbsp;</td>';
		echo '</tr>';
		echo '</table>';

		echo '</form>';

		echo '</div>';


		echo $chamada_javascript; 

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

ob_end_flush();
  
?>