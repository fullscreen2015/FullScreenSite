
<?php

	if(isset($_SESSION['logado_fullscren']))
	{
		if($_SESSION['logado_fullscren'] == '1')
		{

			$sql = "SELECT * FROM tabela_avisos_clientes WHERE publicar=1 AND ativo=1";
			$rs_avisos = mysql_query($sql, $conexao);
			while($linha_avisos = mysql_fetch_array($rs_avisos))
			{
				// echo 'teste';
				$array_avisos[] = $linha_avisos['texto_aviso'];
			}

			$sql = "SELECT * FROM tabela_arquivos WHERE publicar=1 AND ativo=1";
			$rs_arquivos = mysql_query($sql, $conexao);
			while($linha_arquivos = mysql_fetch_array($rs_arquivos))
			{
				// echo '2';
				$array_arquivos[] = $linha_arquivos['nome_arquivo'];
				$links_arquivos[] = $linha_arquivos['arquivo'];
				$codigos_arquivo[] = $linha_arquivos['codigo_arquivo'];
			}

			$qtd_aviso = 0;
			if(isset($array_avisos))
			{
				$qtd_aviso = count($array_avisos);
			}

			$qtd_arquivo = 0;
			if(isset($array_arquivos))
			{
				$qtd_arquivo = count($array_arquivos);
			}

			
			$qtd = $qtd_aviso;

			if($qtd_aviso < $qtd_arquivo)
			{
				$qtd = $qtd_arquivo;
			}

			// print_r($array_avisos);
			// print_r($array_arquivos

			$html = '';
		
			if($qtd_arquivo == 0)
			{
				$html.= '<div class="caixa_aviso">
								<p class="titulo_aviso">AVISO</p>
								<p class="texto_aviso">Não existem informa��es novas para este cliente.</p>
							</div>';

			}


			$i = 0;

			while($i < $qtd)
			{


				if(isset($array_avisos[$i]))
				{

					$html.= '<div class="caixa_aviso">
								<p class="titulo_aviso">AVISO</p>
								<p class="texto_aviso">'.$array_avisos[$i].'</p>
							</div>';

				}




				if(isset($array_arquivos[$i]))
				{

					$html.= '<div class="caixa_download">
								<a href="documentos/'.zerosaesquerda($codigos_arquivo[$i],6).'_'.$links_arquivos[$i].'" ><img src="imagens/layout/img_download.png" border="0" class="img_download"/></a>
								<a href="documentos/'.zerosaesquerda($codigos_arquivo[$i],6).'_'.$links_arquivos[$i].'" ><p class="descricao_download">'.$array_arquivos[$i].'</p></a>
								<a href="documentos/'.zerosaesquerda($codigos_arquivo[$i],6).'_'.$links_arquivos[$i].'" >
									<div class="btn_download">
										<p>DOWNLOAD</p>
									</div>
								</a>

							</div>';

				}

				$i++;
			}




?>


<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_area_cliente">ÁREA DO CLIENTE</h1>
		<div class="caixa_linha_down">
			
			<?php
				echo $html;
			?>


		</div>
		<div class="imagem_fundo">
		</div>
	</div>
</div>

<?php
	
		}
		else
		{
			$link_ht = linkht('lo,','realiza_login','Realize o login Full Scren');

		    header("location:".$link_ht."");
		    exit();
		}

	}
	else
	{
		$link_ht = linkht('lo,','realiza_login','Realize o login Full Scren');

      	header("location:".$link_ht."");
      	exit();
	}



?>