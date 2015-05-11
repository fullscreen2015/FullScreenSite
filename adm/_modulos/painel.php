<?php


ob_start();
session_start();



if(ISSET($_SESSION['fw_codigo_usuario']))
{

	include("../../include/sistema_conexao.php"); 
	include("../_include/usuarios_acesso.php");
	include("../../include/sistema_protecao.php"); 
	include("../../include/sistema_zeros.php"); 
		
	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	$codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
  $permissao = 1;

	if(verifica_usuario2($codigo_modulo, $permissao))
	{
	

		include("../../include/sistema_data.php"); 

		$arquivo_configuracao = "../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php";
		if(file_exists($arquivo_configuracao))
		{
			include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 			
		}
		else
		{
			$msg = "Erro: Arquivo de Configura��o " . zerosaesquerda($codigo_modulo,6) . " não encontrado.";
			header("location: ../index.php?msg=" . $msg);
			exit();
		}


      		
		if(!(isset($tipo_sistema_documentos)))
 		{
	  		$tipo_sistema_documentos = 1;
		}

		// Arquivo Personalizado 0 - Antes do topo
		// Arquivo Personalizado 1 - Dentro do SQL de listagem de registros (entre os comandos FROM e WHERE)
		// Arquivo Personalizado 2 - Dentro do SQL de listagem de registros (depois do comando WHERE)
		// Arquivo Personalizado 3 - Dentro do Loop de listagem de registros (antes do TR)
		// Arquivo Personalizado 4 - Dentro do Loop de listagem de registros (Dentro do TD de Opera��es)
		// Arquivo Personalizado 5 - Dentro do Loop de listagem de registros (ap�s o TR)
		// Arquivo Personalizado 6 - Após o Loop de listagem de registros

		$ap0 = "../_personalizados/" . $codigo_modulo6 . "_painel_0.php";
		$ap1 = "../_personalizados/" . $codigo_modulo6 . "_painel_1.php";
		$ap2 = "../_personalizados/" . $codigo_modulo6 . "_painel_2.php";
		$ap3 = "../_personalizados/" . $codigo_modulo6 . "_painel_3.php";
		$ap4 = "../_personalizados/" . $codigo_modulo6 . "_painel_4.php";
		$ap5 = "../_personalizados/" . $codigo_modulo6 . "_painel_5.php";
		$ap6 = "../_personalizados/" . $codigo_modulo6 . "_painel_6.php";
		$ap7 = "../_personalizados/" . $codigo_modulo6 . "_painel_gerenciar_documento.php";

		if(file_exists($ap0))
		{
			include($ap0);
		}



		include("../_include/topo.php"); 
		include("../_include/funcao_selecao.php"); 
		include("../_include/funcao_confirma.php"); 
		include("../_include/funcao_importa_sfr.php"); 
		include("../_include/filtra_usuario.php");
  
  
  
		$mostrar_filtros="";

		if(ISSET($_REQUEST['nome_campo_busca']))
		{
			$nome_campo_busca = $_REQUEST['nome_campo_busca'];
			$mostrar_filtros="ok";
		}
		else
		{
			$nome_campo_busca = "";
		}


		if((ISSET($_REQUEST['nome_campo_ordem']))&&($_REQUEST['nome_campo_ordem']!=""))
		{
			$nome_campo_ordem = $_REQUEST['nome_campo_ordem'];
			$mostrar_filtros="ok";
		}
		else
		{
			$nome_campo_ordem = $campo_ordenacao_padrao;
		}





		if(ISSET($_REQUEST['tipo_ordem']))
		{
			$tipo_ordem = $_REQUEST['tipo_ordem'];
			$mostrar_filtros="ok";
		}
		else
		{
			$tipo_ordem = $ordem_padrao;
		}


		if(ISSET($_REQUEST['expressao_busca']))
		{
			$expressao_busca = $_REQUEST['expressao_busca'];
			$mostrar_filtros="ok";
		}
		else
		{
			$expressao_busca = "";
		}



		if(ISSET($_REQUEST['pagina']))
		{
			$pagina = (int)anti_injection($_REQUEST['pagina']);
		}
		else
		{
			$pagina = "1";
		}


		// Filtro e Ordena��o ::::::::::::::::::::::::::::::::::::://ALTERADO PARA IClusão DE FILTROS ASSOCIATIVOS

		$where="";

		$sql = "SELECT " . $tabela . ".* "; // NOVO PARA FILTROS ASSOCIATIVOS

		
		//FILTRO ASSOCIATIVOS////////////////////////////////////
		$tabelas_associativas = "";
		for($cont=1;$cont<=$numero_campos_associativos;$cont++)
		{
			$cont_ = (10 + $cont);
			$cont1 = $cont_ . "1";
			$cont8 = $cont_ . "8";
			$cont9 = $cont_ . "9";
			
			if(isset($_REQUEST[$campos_associativos[$cont1]])){
				if($_REQUEST[$campos_associativos[$cont1]]!=""){
				/*echo $campos_associativos[$cont1]."<br>";
				echo $campos_associativos[$cont8]."<br><br>";*/

				$sql .= ", ".$campos_associativos[$cont8].".* ";

				$tabelas_associativas .= ", ". $campos_associativos[$cont8];

				if($where=="")
						{
							$where = " WHERE ";
						}
						else
						{
							$where.= " AND ";
						}


				$where .= $campos_associativos[$cont8].".".$campos_associativos[$cont1] ."=". $_REQUEST[$campos_associativos[$cont1]];
				$where .= " AND ";
				$where .= $campos_associativos[$cont8].".".$campos_associativos[$cont9] ."=". $tabela.".".$campos_associativos[$cont9];

				}
			}

			
		}		

		//FIM FILTRO ASSOCIATIVOS ////////////////////////////////
	

		//$sql = "SELECT " . $tabela . ".* FROM " . $tabela; //ORIGINAL

		$sql .= " FROM " . $tabela ."".$tabelas_associativas ; //NOVO PARA FILTROS ASSOCIATIVOS

		
		if(file_exists($ap1))
		{
			include($ap1);
		}





		$publicar=0;

		for($cont=1;$cont<=$numero_campos;$cont++)
		{
			$cont_ = (10 + $cont);
			$cont1 = $cont_ . "1";
			$cont3 = $cont_ . "3";
			$cont5 = $cont_ . "5";

			// verifica se existe o campo "publicar"

			if($campos[$cont1]=="publicar")
			{
				$publicar=1;
			}   


			if($campos[$cont1]==$nome_campo_busca)
			{

				if(ISSET($_REQUEST['expressao_busca']))
				{
					if($where=="")
					{
						$where = " WHERE ";
					}
					else
					{
						$where.= " AND ";
					}




					// Para a pesquisa por data ser eficaz � necessário que a data pesquisada tenha 10 caracteres.
					// Dia e m�s com dois d�gitos, ano com quatro e os três separados por qualquer caractere.
					// Exemplos: 01/01/2012; 01 01 2012; 01-01-2012; 01_01_2012;

					if(($campos[$cont3]=="data_int")||($campos[$cont3]=="data_int_now"))
					{
						$expressao_busca_data = "";
						if (strlen($expressao_busca) == 10)
						{
							for ($indice=6; $indice <= 9; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}
							for ($indice=3; $indice <= 4; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}
							for ($indice=0; $indice <= 1; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}
						}

						$where.= " " . $tabela.".".$campos[$cont1] . " = '" . $expressao_busca_data . "'";
					}




					if($campos[$cont3]=="data_date" or $campos[$cont3]=="data_date_now")
					{
						$expressao_busca_data = "";
						if (strlen($expressao_busca) == 10)
						{
							for ($indice=6; $indice <= 9; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}

							$expressao_busca_data .= "-";

							for ($indice=3; $indice <= 4; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}

							$expressao_busca_data .= "-";

							for ($indice=0; $indice <= 1; $indice++)
							{
								$expressao_busca_data .= $expressao_busca[$indice];
							}

							echo $expressao_busca_data;
						}

						$where.= " " . $tabela.".".$campos[$cont1] . " = '" . $expressao_busca_data . "'";
					}


					if($campos[$cont3]=="logico")
					{
						$expressao = $expressao_busca;

						if(trim(strtolower($expressao_busca))=="sim")
						{
							$expressao = "1";
						}

						if((trim(strtolower($expressao_busca))=="não")||(trim(strtolower($expressao_busca))=="nao"))
						{
							$expressao = "0";
						}

						$where.= " " . $tabela.".".$campos[$cont1] . "='" . $expressao . "'";
					}


					if(($campos[$cont3]=="inteiro")||($campos[$cont3]=="chave_primaria"))
					{
						$where.= " " . $tabela.".".$campos[$cont1] . "='" . $expressao_busca . "'";
					}


					if(($campos[$cont3]=="varchar")||($campos[$cont3]=="blob"))
					{
						$where.= " " . $tabela.".".$campos[$cont1] . " LIKE '%" . $expressao_busca . "%'";
					}
				}
			}		

			if((($campos[$cont3]=="chave_estrangeira")||($campos[$cont3]=="usuario")) && (isset($_REQUEST[$campos[$cont1]]) && ($_REQUEST[$campos[$cont1]]!=""))     )
			{
			
				if ($where=="")
				{
					$where = " WHERE ";
				}
				else
				{
					$where.= " AND ";
				}

				$where.= " " . $tabela.".".$campos[$cont1] . "='" . $_REQUEST[$campos[$cont1]] . "'";
			}


			
		}



		// Se existir o sistema de exclusão por ativa��o, o painel só mostra os registros ativos

		if($sistema_exclusao==1)
		{

			if ($where=="")
			{
				$where = " WHERE ";
			}
			else
			{
				$where.= " AND ";
			}

			$where.=" " . $tabela . ".ativo=1";
		}

		$sql.= $where;



		if(file_exists($ap2))
		{
			include($ap2);
		}


		$sql.= " GROUP BY " . $tabela . "." . $chave_primaria;
		$sql.= " ORDER BY " . $tabela.".".$nome_campo_ordem . " " . $tipo_ordem;

	

		/*$sql2 = $sql;

		echo $sql2."<br>";

		$sql = "";

		echo "<br><br>";

		$sql = "SELECT tabela_ec_produtos_detalhes.*, tabela_ec_ass_produtos_categorias.* FROM tabela_ec_produtos_detalhes, tabela_ec_ass_produtos_categorias WHERE ";
		$sql .= " tabela_ec_ass_produtos_categorias.codigo_categoria = 26 AND tabela_ec_ass_produtos_categorias.codigo_produto = tabela_ec_produtos_detalhes.codigo_produto ";
		$sql .= " AND codigo_fornecedor='1' AND tabela_ec_produtos_detalhes.ativo=1 GROUP BY tabela_ec_produtos_detalhes.codigo_produto ORDER BY descricao_produto";
		*/
		//echo $sql;

		$rs_dados = mysql_query($sql, $conexao);

		barra("Menu Principal","../index.php",$sistema_plural,"","","","","");  


  


		$rabicho_filtro = "";

		reset ($_GET);
		while (list ($key, $val) = each ($_GET)) 
		{
			if($key!="pagina")
			{
				$rabicho_filtro.= "&" . $key . "=" . $val;
			}
		}

		$rabicho_filtro = str_replace(" ","|||",$rabicho_filtro);
  

		include('painel_js.php');
		////////////////////////////////////////
		$rs_1000 = mysql_query($sql, $conexao);
		$rows_1000 = mysql_num_rows($rs_1000);
		/////////////////////////////////////////

		
		if($rows_1000<1000){
		echo '<br><a target="_blank" class="caminho" href="impressao.php?codigo_modulo='.$codigo_modulo.'&sql=' . urlencode($sql) . '"><b>&nbsp;&nbsp;&nbsp;:: Formato de Impress�o</b></a>';
		}else{
		echo "<br><a  class='caminho' href='javascript:alert(\"Impress�o acima de 1000 registros, por favor Exporte os dados em txt ou csv\") , mostar_exportacao(\"painel_exportacao\");'><b>&nbsp;&nbsp;&nbsp;:: Formato de Impress�o</b></a>";
		}
		//EXIBE BOX Exportação
		include('painel_exportacao.php');
		//EXIBE BOX Exportação



		echo '<script type="text/javascript" src="../_js/jquery.preview.js"></script>';


		echo '<form action="painel.php" method="get" style="border:0px; margin:0px;">';
		echo '<input type="hidden" name="pagina" value="' . $pagina . '">';
		echo '<input type="hidden" name="codigo_modulo" value="' . $codigo_modulo . '">';

         
        echo '<br><br>';


		echo '<div id=painel_filtros></div>';  

		if($mostrar_filtros!="")
		{
			// echo '<script language=javascript>';
			// echo "mostrar_div('painel_filtros');";
			// echo '</script>';
		}
		else
		{ 

			echo '<div id=link_painel_filtros><a href="';
			echo "javascript:esconder_div('link_painel_filtros');mostrar_div('painel_filtros');";
			echo '" class="caminho"><b>&nbsp;&nbsp;&nbsp;:: Op��es de Busca, Filtros e Ordena��o</b></a><br><br></div>';


		}


	
		include("../_include/paginacao.php"); 

		echo '<br>';
		echo '</form>';


		$permissao = 3;

		if(verifica_usuario2($codigo_modulo, $permissao))
		{

			echo '<table cellspacing="0" cellpadding="0" width="100%">';
			echo '<tr>';
			echo '<td width="100%" height=30 bgcolor="#333333" align=center>';

			echo '<a class="caminho" href="inserir.php?codigo_modulo=' . $codigo_modulo . '"><b><font color=#dddddd>[Clique aqui para inserir novo(a) ' . $sistema_singular . ']</font></b></a>';


			if($sistema_fotos==1)
			{
				if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==4)||($tipo_sistema_fotos==6))
				{
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					echo '<a class="caminho" href="../_upload_lote/inserir.php?codigo_modulo=' . $codigo_modulo . '"><b><font color=#dddddd>[Envio de fotos em lote]</font></b></a>';
				}
			}

			if($sistema_documentos==1)
			{
				if($tipo_sistema_documentos==1)
				{
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					echo '<a class="caminho" href="../_upload_documentos_lote/inserir.php?up_codigo_modulo=' . $codigo_modulo . '"><b><font color=#dddddd>[Envio de documentos em lote]</font></b></a>';
				}

    		}


			echo '</td></tr></table>';

		}

		echo '<div style="float:left; width:100%; text-align:center; margin:10px 0px 0px 0px; font-size:12px;" id="atualizando"></div>';
		echo '<br><br>';

		echo '<table cellspacing="0" cellpadding="0" width="100%">';

		$j=0;
		while (($linha = mysql_fetch_array($rs_dados)) && ($j < $registros_por_pagina))
		{

			$j++; 


			if(file_exists($ap3))
			{
				include($ap3);
			}

			// verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
			if((isset($campo_usuario))&&($campo_usuario!=""))
			{
				if((isset($tipo_permissao_usuario))&&($tipo_permissao_usuario==1))
				{

					if($linha[$campo_usuario]!=$_SESSION['fw_codigo_usuario'])
					{
						// caso este registro não tenha sido feito pelo usuário logado, a linha não � exibida.
						// o comando continue for�a o Loop a saltar para a seguinte itera��o
						continue;
					}
				}
			}




			echo '<tr>';
			echo '<td colspan=3 height=1 bgcolor=#999999><img src=nada.gif width=1 height=1>';
			echo '</td>';
			echo '</tr>';
			echo '<tr>';

/*
			if($sistema_fotos==1)
			{*/

				if(($exibicao_no_painel==1)||($exibicao_no_painel==2))
				{	
					include("painel_miniaturas.php");
				}
//			}



			echo '<td width=20>';
			echo '<table cellspacing="0" cellpadding="0" width="100%">';
			echo '<tr>';
			echo '<td width="100%" bgcolor="#cccccc" height=26>&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td width="100%" bgcolor="#bbbbbb" height=26>&nbsp;</td>';
			echo '</tr>';
			echo '</table>';
			echo '</td>';

			echo '<td>';
			echo '<table cellspacing="0" cellpadding="0" width="100%">';
			echo '<tr>';

            echo '<td width="100%" bgcolor="#cccccc" height=26>';

            echo '<font class="caminho">';

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
                $cont10 = $cont_ . "10";
                $cont11 = $cont_ . "11";

                if($campos[$cont8]==1) 
                {
                    switch ($campos[$cont3]) 
                    {

						case "blob":

							$valor = $linha[$campos[$cont1]];
							$valor = str_replace("<br>", " / ", $valor);
							$valor = ltrim($valor);

							if(strlen($valor)>80)
							{
								$valor = substr($valor,0,80) . " ...";
							}

							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $valor; 
							break;


						case "data_int":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
							break;


						case "data_int_now":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
							break;


						case "data_date":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdata($linha[$campos[$cont1]]); 
							break;

						case "data_hora":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatahorai($linha[$campos[$cont1]]); 
							break;


						case "hora_now":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
							break;


						case "hora":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
							break;


						case "moeda":
							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . number_format($linha[$campos[$cont1]],2,',','.'); 
							break;



						case "logico":

							if($linha[$campos[$cont1]])
							{
								echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Sim"; 
								$palavra = "Alterar para Não";
								$cod = "0";
							}
							else
							{
								echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Não"; 
								$palavra = "Alterar para Sim";
								$cod = "1";
							}

							echo '&nbsp;';
							echo '<a class="caminho" href="publicar.php?codigo_modulo='.$codigo_modulo.'&cod=' . $cod . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '&campo=' . $campos[$cont1] . '"><img src=../_imagens/alterar.png border=0 alt="'. $palavra .'" title="'. $palavra .'"></a>';

							break;


						case "chave_estrangeira":

							$sql_ce = "SELECT "  . $campos[$cont7] . " FROM " . $campos[$cont6];

							if(substr_count($sql_ce, 'WHERE'))
							{
								$sql_ce.= " AND ";
							}
							else
							{
								$sql_ce.= " WHERE ";
							}

							$sql_ce.=  $campos[$cont5] . "=" . $linha[$campos[$cont1]];
							$rs_ce = mysql_query($sql_ce, $conexao);
							$linha_ce = mysql_fetch_array($rs_ce);


							$campos_para_mostrar = explode(",",$campos[$cont7]);

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


							$largura_select = "100";
							if(isset($campos[$cont11]))
							{
								if(($campos[$cont11]!=0)&&($campos[$cont11]!=""))
								{
									$largura_select = $campos[$cont11];
								}
							}


							$id = $campos[$cont1] . "_" . $linha[$chave_primaria] . "_" . $cont;
							$id2 = "'" . $id . "'";

							echo '<span id="div_' . $id . '">';

							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> ";

							echo '<input style="width:' . $largura_select . 'px;" onClick="javascript:mostrar_select(' . $cont . ',' . $id2 . ',' . $linha[$chave_primaria] . ',' . $linha[$campos[$cont1]] . ');" id="' . $id . '" class="input_painel" type="text" name="' . $id . '" value="' . $valores_para_mostrar . '">';
							echo '</span>';

							break;
						


						case "usuario":
					  
							$sql_ce = "SELECT "  . $campos[$cont7] . " FROM " . $campos[$cont6];

							if(substr_count($sql_ce, 'WHERE'))
							{
								$sql_ce.= " AND ";
							}
							else
							{
								$sql_ce.= " WHERE ";
							}

							$sql_ce.=  $campos[$cont5] . "=" . $linha[$campos[$cont1]];
							$rs_ce = mysql_query($sql_ce, $conexao);
							$linha_ce = mysql_fetch_array($rs_ce);



							$campos_para_mostrar = explode(",",$campos[$cont7]);

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

							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $valores_para_mostrar; 

							break;




						case "varchar":


							$permissao = 5;

							if(verifica_usuario2($codigo_modulo, $permissao))
							{
								if(isset($campos[$cont11]))
								{
									$largura_input = $campos[$cont11];
								}
								else
								{
									$largura_input = $campos[$cont4]*2;
									if(($campos[$cont4]==0)||($campos[$cont4]==""))
									{
										$largura_input = "100";
									}

									if($campos[$cont4]==255)
									{
										$largura_input = "200";
									}
								}

								echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> ";

								$id = $campos[$cont1] . "_" . $linha[$chave_primaria] . "_" . $cont;

								$onchange = "javascript:atualizar(this.value,'".$linha[$chave_primaria]."','" . $campos[$cont1] . "');";

								echo '<input style="width:' . $largura_input . 'px" maxlength="' . $campos[$cont4] . '" onfocus="javascript:css_focus(this);" onblur="javascript:css_blur(this);" onchange="' . $onchange . '" id="' . $id . '" class="input_painel" type="text" name="' . $id . '" value="' . $linha[$campos[$cont1]] . '">';
							}
							else
							{
								echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b>  " . $linha[$campos[$cont1]];
							}
						
							break;



						default:

							echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b>  " . $linha[$campos[$cont1]];
						
							break;

					}

				}

            }  
				
				

            echo '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td width="100%" bgcolor="#bbbbbb" height=26>';
			


			$mostrar_excluir=true;

			// verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
			if((isset($campo_usuario))&&($campo_usuario!=""))
			{
				if((isset($tipo_permissao_usuario))&&(($tipo_permissao_usuario==2)||($tipo_permissao_usuario==3)))
				{
					if($linha[$campo_usuario]!=$_SESSION['codigo_usuario'])
					{
						// caso este registro não tenha sido feito pelo usuário logado, o link "excluir" não deve ser exibido.
						$mostrar_excluir=false;
					}
				}
			}



			$permissao = 7;

			if((verifica_usuario2($codigo_modulo, $permissao))&&($mostrar_excluir==true))
			{
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

					if($campos[$cont3] == 'chave_estrangeira_recursiva')
					{
						$recursivo = 1;
						break;
					}
					else
					{
						$recursivo = 0;
					}

				}

				echo '&nbsp;&nbsp;';

				if($recursivo == 1)
				{
					if($campos[$cont4]=="0")
					{
						$rabicho = 'AND ativo=1 ';
					}

					$sql = "SELECT * FROM ".$tabela." WHERE ".$chave_primaria."_pai = '".$linha[$chave_primaria]."' ".$rabicho."";
					$rs_categoria = mysql_query($sql,$conexao)or die(mysql_error());
					$categoria = mysql_num_rows($rs_categoria);

					if($categoria == 0)
					{  
						if(isset($confirmar_exclusao))
						{
							if($confirmar_exclusao==1)
							{
								$chave = "'".$chave_primaria."'";
								$nome_sistema = "'".$sistema_singular."'";
								echo '<a href="javascript:confirmacao('.$codigo_modulo.','.$pagina.','.$chave.','.$linha[$chave_primaria].','.$nome_sistema.')"';
								echo 'class="caminho"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
								echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
							}
							else
							{
								echo '<a class="caminho" href="excluir_registro.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
             		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
							}
						}
						else
						{
							$chave = "'".$chave_primaria."'";
							$nome_sistema = "'".$sistema_singular."'";
							echo '<a href="javascript:confirmacao('.$codigo_modulo.','.$pagina.','.$chave.','.$linha[$chave_primaria].','.$nome_sistema.')"';
							echo 'class="caminho"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
							echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';		
						}	 
					}

				}
				else
				{
					if(isset($confirmar_exclusao))
					{
						if($confirmar_exclusao==1)
						{
							$chave = "'".$chave_primaria."'";
							$nome_sistema = "'".$sistema_singular."'";
							echo '<a href="javascript:confirmacao('.$codigo_modulo.','.$pagina.','.$chave.','.$linha[$chave_primaria].','.$nome_sistema.')"';
							echo 'class="caminho"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
							echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
						}
						else
						{
							echo '<a class="caminho" href="excluir_registro.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
						}
					}
					else
					{
						$chave = "'".$chave_primaria."'";
						$nome_sistema = "'".$sistema_singular."'";
						echo '<a href="javascript:confirmacao('.$codigo_modulo.','.$pagina.','.$chave.','.$linha[$chave_primaria].','.$nome_sistema.')"';
						echo 'class="caminho"><img src=../_imagens/excluir.png border=0 alt="Excluir" title="Excluir"> Excluir ' . $sistema_singular . '</a>';
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';		
					}					 
						
				}


			}



			$mostrar_editar=true;

			// verifica��o de permiss�o para exibi��o do registro no caso de exist�ncia de campo de usuário na tabela
			if((isset($campo_usuario))&&($campo_usuario!=""))
			{
				if((isset($tipo_permissao_usuario))&&(($tipo_permissao_usuario==2)||($tipo_permissao_usuario==4)))
				{
					if($linha[$campo_usuario]!=$_SESSION['codigo_usuario'])
					{
						// caso este registro não tenha sido feito pelo usuário logado, o link "excluir" não deve ser exibido.
						$mostrar_editar=false;
					}
				}
			}



			$permissao = 5;

			if((verifica_usuario2($codigo_modulo, $permissao))&&($mostrar_editar==true))
			{
				echo '<a class="caminho" href="editar_dados.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/editar.png border=0 alt="Editar Dados" title="Editar Dados"> Editar ' . $sistema_singular . '</a>';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			else
			{
        echo '<a class="caminho" href="editar_dados.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/visualizar.png border=0 alt="Visualizar Dados" title="Visualizar Dados"> Visualizar ' . $sistema_singular . '</a>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}

      if($publicar==1)
      {

      	if($linha['publicar']==0)
        {
					$palavra = "Publicar";
                    $cod = "1";
				}
        else
        {
					$palavra = "Despublicar";
					$cod = "0";
				}

        echo '<a class="caminho" href="publicar.php?codigo_modulo=' . $codigo_modulo . '&cod=' . $cod . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/publicar.png border=0 alt="' . $palavra . '" title="' . $palavra . '"> ' . $palavra . '</a>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      }  

      if($sistema_fotos==1)
      {  
				echo '<a class="caminho" href="editar_foto.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/foto.png border=0 alt="Gerenciar Fotos" title="Gerenciar Fotos"> Gerenciar Fotos</a>';
      	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

        if(($tipo_sistema_fotos==1)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==7))
        {
					echo '<a class="caminho" href="../_upload_lote/formulario.php?codigo_modulo=' . $codigo_modulo . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/foto.png border=0 alt="Enviar Fotos em Lote" title="Enviar Fotos em Lote"> Enviar Fotos em Lote</a>';
        	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
      }

     	if($sistema_documentos==1)
      { 

 				if(!(isset($tipo_sistema_documentos)))
    		{
      		$tipo_sistema_documentos = 1;
    		}


    		$mostrar_download=true;
    		if(file_exists($ap7))
    		{
    		  include($ap7);
    		}
    		else
    		{
    		  echo '<a class="caminho" href="editar_documento.php?codigo_modulo=' . $codigo_modulo . '&pagina=' . $pagina . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/doc.png border=0 alt="Gerenciar Documento" title="Gerenciar Documento"> Gerenciar Documento';
    		}				
    		if($tipo_sistema_documentos==2)   
    		{
    			echo "s";
    			$mostrar_download=false;
    		}
      		echo '</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

			if($tipo_sistema_documentos==2)
			{
	      		echo '<a class="caminho" href="../_upload_documentos_lote/formulario.php?up_codigo_modulo=' . $codigo_modulo . '&' . $chave_primaria . '=' . $linha[$chave_primaria] . '"><img src=../_imagens/doc.png border=0 alt="Enviar Documentos em Lote" title="Enviar Documentos em Lote"> Enviar Documentos em Lote</a>';
    	    	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}



        if($mostrar_download)
        {

         	$nome_arquivo = "../../" . $pasta_documentos . "/" . zerosaesquerda($linha[$chave_primaria],$numero_algarismos_documentos) . "_" . $linha[$nome_campo_documentos] ;

          if (file_exists($nome_arquivo))
          {  
						echo '&nbsp;<a target="_blank" class=caminho alt="clique para download" href="' . $nome_arquivo . '"><img src=../_imagens/download.png border=0 alt="Download do Documento" title="Download do Documento"> Download do Documento</a>';
          }

        }
      }  


      if($exibicao_no_painel==2)
      {  

      	// a variavel $codigo_registro � criada no "_include/painel_miniaturas.php"
				if($codigo_registro>0)
				{
					$link_gerenciar_fotos = "../_modulos/painel.php?codigo_modulo=" . $fotos_sistema_associado . "&".$chave_primaria . "=" . $linha[$chave_primaria];
          $nome_link_gerenciar_fotos = "Gerenciar Fotos";
        }
        else
        {
					$link_gerenciar_fotos = "../_modulos/inserir.php?codigo_modulo=" . $fotos_sistema_associado;
					$nome_link_gerenciar_fotos = "Inserir Foto";
        }

				echo '<a class="caminho" href="' . $link_gerenciar_fotos . '"><img src=../_imagens/foto.png border=0 alt="Gerenciar Fotos" title="Gerenciar Fotos"> ' . $nome_link_gerenciar_fotos . '</a>';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      } 


			
			if(file_exists($ap4))
			{
				include($ap4);
			}
		

			echo '</font></td></tr>';

			echo '</table>';
			echo '</td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td colspan=3 height=1 bgcolor=333333><img src=nada.gif width=1 height=1></td>';
			echo '</tr>';

			echo '<tr><td colspan="3">&nbsp;</td></tr>';

         

			if(file_exists($ap5))
			{
				include($ap5);
			}
			


    }  

    if($j==0)
    {  
			echo '<tr>';
			echo '<td height=20 width="100%" bgcolor="#ff0000">';
			echo '<font class="caminho">&nbsp;&nbsp;&nbsp;<b>Nenhum registro foi encontrado</b></font></td>';
			echo '</tr>';
		}  
		
		echo '</table>';


		$permissao = 3;

		if(verifica_usuario2($codigo_modulo, $permissao))
		{
			echo '<br>';

			echo '<table cellspacing="0" cellpadding="0" width="100%">';
			echo '<tr>';
			echo '<td width="100%" height=30 bgcolor="#333333" align=center>';
			echo '<a class="caminho" href="inserir.php?codigo_modulo=' . $codigo_modulo . '"><b><font color=#dddddd>:: Clique aqui para inserir novo(a) ' . $sistema_singular . '</font></b></a></td>';
			echo '</tr>';
			echo '</table>';


		}


		if(file_exists($ap6))
		{
			include($ap6);
		}
		


		if($mostrar_filtros!="")
		{
			echo '<script language=javascript>';
			echo "mostrar_div('painel_filtros');";
			echo '</script>';
		}

		echo '</body></html>';
		
	}
	
	else
	{
		if(ISSET($_SERVER['HTTP_REFERER']))
		{
			$url = $_SERVER['HTTP_REFERER'];
		}
		else
		{
			$url = "../";
		}
		header("Location: " . $url);  
	}


}
else
{
	header("Location: ../_sistema/php_manutencao_login.php");  
}
ob_end_flush();

?>